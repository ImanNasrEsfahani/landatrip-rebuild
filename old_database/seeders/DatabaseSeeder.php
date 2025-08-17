<?php

namespace Database\Seeders;

use App\Models\ArticleCategory;
use App\Models\GroupRequirementType;
use App\Models\PrivacyPolicy;
use App\Models\UserPrivacy;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
//    use WithoutModelEvents;

    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run ()
    {
        $this->call([
            LanguageSeeder::class,

            RegionSeeder::class,
            AirportSeeder::class,
            AirlinesSeeder::class,
            SettingSeeder::class,
            UserVerificationScoreSeeder::class,
            LaratrustSeeder::class,
            SocialMediaSeeder::class,
            CurrencySeeder::class,
            UserSeeder::class,
            ArticleCategorySeeder::class,
            AgreementSeeder::class,
            CouponSeeder::class,
            LocationsSeeder::class,
            SkillsSeeder::class,
            CommunitySeeder::class,
//            CommunicationSeeder::class,
            CertificationSeeder::class,

            GroupRequirementTypeSeeder::class,
            TourSeeder::class,
            GroupSeeder::class,

            UserCertificateSeeder::class,

            PrivacyPolicySeeder::class,
            UserPrivacySeeder::class,

            TicketSeeder::class,
            BadgeLevelSeeder::class,
        ]);

    }
}
