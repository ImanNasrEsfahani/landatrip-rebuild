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

class E2eSeeder extends Seeder
{
    public function run(): void
    {
        if (config('database.default') !== 'mysql' || config('database.connections.mysql.database') !== 'landatrip_e2e') {
            throw new RuntimeException('E2E fixtures require the disposable landatrip_e2e MySQL database.');
        }

        $password = env('E2E_TEST_PASSWORD');
        if (! is_string($password) || strlen($password) < 16) {
            throw new RuntimeException('Provide a temporary E2E_TEST_PASSWORD of at least 16 characters.');
        }

        DB::transaction(function () use ($password): void {
            $language = Language::firstOrCreate(['slug' => 'en'], [
                'title' => 'English', 'preferred_currencies' => [],
            ]);

            foreach (['user', 'teacher', 'agent', 'manager', 'admin'] as $roleName) {
                $role = Role::firstOrCreate(['name' => $roleName], ['display_name' => ucfirst($roleName)]);
                $user = User::withoutEvents(fn () => User::firstOrCreate(
                    ['email' => "e2e-{$roleName}@example.invalid"],
                    [
                        'fname' => 'E2E', 'lname' => ucfirst($roleName),
                        'slug' => "e2e-{$roleName}",
                        'email_verified_at' => now(),
                        'password' => Hash::make($password),
                    ]
                ));
                if (! $user->hasRole($roleName)) {
                    $user->addRole($role);
                }
            }

            $regionId = DB::table('regions')->insertGetId(['name' => 'E2E Region', 'slug' => 'e2e-region']);
            $countryId = DB::table('countries')->insertGetId([
                'name' => 'E2E Country', 'code' => 'XX', 'phone' => '+000',
                'slug' => 'e2e-country', 'region_id' => $regionId,
            ]);
            $cityId = DB::table('cities')->insertGetId([
                'name' => 'E2E City', 'latitude' => '0', 'longitude' => '0',
                'slug' => 'e2e-city', 'country_id' => $countryId,
            ]);
            DB::table('users')->where('email', 'like', 'e2e-%@example.invalid')->update(['location' => (string) $cityId]);
            $tourId = (string) Str::ulid();
            DB::table('tours')->insert([
                'id' => $tourId, 'user_id' => User::where('slug', 'e2e-teacher')->value('id'),
                'certification_id' => (string) Str::ulid(), 'teacher_name' => 'E2E Teacher',
                'language_id' => $language->id, 'title' => 'E2E Sample Tour',
                'slug' => 'e2e-sample-tour', 'short_summary' => 'A disposable test tour',
                'city_id' => $cityId, 'tour_overview' => 'A disposable browser test tour.',
                'status' => 2,
            ]);
            $group = Group::withoutEvents(fn () => Group::create([
                'language_id' => $language->id, 'tour_id' => $tourId,
                'title' => 'E2E Sample Group', 'slug' => 'e2e-sample-group',
                'start_registration_date' => now()->subDay()->toDateString(),
                'end_registration_date' => now()->addMonth()->toDateString(),
                'start_date_tour' => now()->addMonths(2)->toDateString(),
                'end_date_tour' => now()->addMonths(2)->addDays(3)->toDateString(),
                'days' => 3, 'nights' => 2, 'min_capacity' => 1, 'max_capacity' => 8,
            ]));
            $currencyId = DB::table('currencies')->insertGetId([
                'name' => 'USD', 'symbol' => '$', 'flag' => 'fixture',
            ]);
            DB::table('group_price_items')->insert([
                'group_id' => $group->id, 'currency_id' => $currencyId,
                'title' => 'Sample stored item', 'amount' => 125,
                'created_at' => now(), 'updated_at' => now(),
            ]);
        });
    }
}
