<?php

namespace Database\Seeders;

use App\Models\Group;
use App\Models\Language;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use RuntimeException;

class StagingDemoSeeder extends Seeder
{
    public function run(): void
    {
        if (! app()->environment('staging')
            || config('database.default') !== 'mysql'
            || config('database.connections.mysql.database') !== 'landatrip_staging'
            || config('database.connections.mysql.username') !== 'landatrip_staging'
            || DB::selectOne('SELECT DATABASE() AS name')->name !== 'landatrip_staging'
            || env('STAGING_DEMO_SEED') !== 'yes') {
            throw new RuntimeException('Demo seeding requires explicit consent and the isolated staging database.');
        }
        if (DB::table('users')->where('email', 'not like', 'staging-%@example.invalid')->exists()) {
            throw new RuntimeException('Refusing to seed a database containing non-demo users.');
        }
        foreach (['admin', 'manager', 'teacher', 'agent', 'user'] as $role) {
            $password = env('STAGING_DEMO_PASSWORD_'.strtoupper($role));
            if (! is_string($password) || strlen($password) < 24) {
                throw new RuntimeException("A random 24+ character password is required for {$role}.");
            }
        }
        DB::transaction(function (): void {
            $language = Language::firstOrCreate(['slug' => 'en'], ['title' => 'English', 'preferred_currencies' => []]);
            foreach (['admin', 'manager', 'teacher', 'agent', 'user'] as $roleName) {
                $role = Role::firstOrCreate(['name' => $roleName], ['display_name' => ucfirst($roleName)]);
                $user = User::withoutEvents(fn () => User::firstOrCreate(
                    ['email' => "staging-{$roleName}@example.invalid"],
                    ['fname' => 'Staging', 'lname' => ucfirst($roleName), 'slug' => "staging-{$roleName}",
                        'email_verified_at' => now(),
                        'password' => Hash::make(env('STAGING_DEMO_PASSWORD_'.strtoupper($roleName)))]
                ));
                if (! $user->hasRole($roleName)) {
                    $user->addRole($role);
                }
            }
            $region = DB::table('regions')->where('slug', 'staging-region')->value('id')
                ?? DB::table('regions')->insertGetId(['name' => 'Staging Region', 'slug' => 'staging-region']);
            $country = DB::table('countries')->where('slug', 'staging-country')->value('id')
                ?? DB::table('countries')->insertGetId(['name' => 'Staging Country', 'code' => 'ZZ',
                    'phone' => '+000', 'slug' => 'staging-country', 'region_id' => $region]);
            $city = DB::table('cities')->where('slug', 'staging-city')->value('id')
                ?? DB::table('cities')->insertGetId(['name' => 'Staging City', 'latitude' => '0',
                    'longitude' => '0', 'slug' => 'staging-city', 'country_id' => $country]);
            DB::table('users')->where('email', 'like', 'staging-%@example.invalid')->update(['location' => (string) $city]);
            $tourId = DB::table('tours')->where('slug', 'staging-sample-tour')->value('id');
            if (! $tourId) {
                $tourId = (string) Str::ulid();
                DB::table('tours')->insert(['id' => $tourId,
                    'user_id' => User::where('slug', 'staging-teacher')->value('id'),
                    'certification_id' => (string) Str::ulid(), 'teacher_name' => 'Staging Teacher',
                    'language_id' => $language->id, 'title' => 'Staging Sample Tour',
                    'slug' => 'staging-sample-tour', 'short_summary' => 'Synthetic tour for staging.',
                    'city_id' => $city, 'tour_overview' => 'This is a synthetic browser test tour.', 'status' => 2]);
            }
            if (! DB::table('groups')->where('slug', 'staging-sample-group')->exists()) {
                Group::withoutEvents(fn () => Group::create([
                    'language_id' => $language->id, 'tour_id' => $tourId,
                    'title' => 'Staging Sample Group', 'slug' => 'staging-sample-group',
                    'start_registration_date' => now()->subDay()->toDateString(),
                    'end_registration_date' => now()->addMonth()->toDateString(),
                    'start_date_tour' => now()->addMonths(2)->toDateString(),
                    'end_date_tour' => now()->addMonths(2)->addDays(3)->toDateString(),
                    'days' => 3, 'nights' => 2, 'min_capacity' => 1, 'max_capacity' => 8]));
            }
        });
    }
}
