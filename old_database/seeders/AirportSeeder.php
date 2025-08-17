<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;



class AirportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $airportNASeeder = new AirportNASeeder();
        $airportNASeeder->run();

        $airportSASeeder = new AirportSASeeder();
        $airportSASeeder->run();

        $AirportAFSeeder = new AirportAFSeeder();
        $AirportAFSeeder->run();

        $AirportASSeeder = new AirportASSeeder();
        $AirportASSeeder->run();

        $AirportEUSeeder = new AirportEUSeeder();
        $AirportEUSeeder->run();

        $AirportOCSeeder = new AirportOCSeeder();
        $AirportOCSeeder->run();

    }
}
