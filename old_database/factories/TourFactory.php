<?php

namespace Database\Factories;

use App\Models\Language;
use App\Models\Tour;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory
 */
class TourFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $languageObj = Language::factory()->makeOne();

        return [
//        'header_pic',
//        'thumbnail_pic',
//        'language_id',
            'title'             =>  $this->faker->sentence(6),
            'slug'              =>  $this->faker->slug,
            'short_summary'     =>  $this->faker->realText(8),
            'location_id'       =>  $languageObj->id,
            'group_size'        =>  $this->faker->randomElement(['8-12', '10-12', '15-20']),
            'accommodation'     =>  $this->faker->randomElement(['Ecolodge', '3-Star Hotel', '4-Star Hotel', '5-Star Hotel']),
            'meals'             =>  $this->faker->randomElement(['4 Breakfast, 2 lunch, and 1 dinner', '14 Breakfast', 'Two Breakfast, One dinner, Two lunch']),
            'transport'         =>  $this->faker->randomElement(['Charter van or bus', 'Airport transport for arrival and departure']),
            'days'              =>  $this->faker->biasedNumberBetween(1,8),
            'nights'            =>  $this->faker->biasedNumberBetween(1,8),
            'price'             =>  $this->faker->biasedNumberBetween(20,400),
            'skills'            =>  $this->faker->randomElement(['Business Analysis', 'Digital Marketing', 'Leadership', 'Language Courses', 'Management']),
            'tour_overview'     =>  $this->faker->realText(200),
//        'highlights',
//        'itinerary',
//        'includes',
//        'excludes',
            'gallery'           =>  '',
            'map'               =>  '',
            'certificates'      =>  '',
//        'terms_and_conditions',
            'dates'             =>  '',
//        'comments',
            'tour_brochure'     =>  ''
        ];
    }
}
