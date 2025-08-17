<?php

namespace Database\Seeders;

use App\Models\SocialMedia;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SocialMediaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            [
                'title' => 'Instagram',
                'path'  => 'instagram.svg',
                'icon'  => 'fa-instagram',
            ],
            [
                'title' => 'Twitter',
                'path'  => 'twitter.svg',
                'icon'  => 'fa-twitter',
            ],
            [
                'title' => 'Linkedin',
                'path'  => 'linkedin.svg',
                'icon'  => 'fa-linkedin',
            ],
            [
                'title' => 'Facebook',
                'path'  => 'facebook.svg',
                'icon'  => 'fa-facebook',
            ],
            [
                'title' => 'Youtube',
                'path'  => 'youtube.svg',
                'icon'  => 'fa-youtube',
            ],
            [
                'title' => 'WhatsApp',
                'path'  => 'whatsapp.svg',
                'icon'  => 'fa-whatsapp',
            ],
            [
                'title' => 'Telegram',
                'path'  => 'telegram.svg',
                'icon'  => 'fa-telegram',
            ],
            [
                'title' => 'Email',
                'path'  => 'email.svg',
                'icon'  => 'fa-envelope',
            ]
        ];
        SocialMedia::insert($items);

    }
}
