<?php

namespace Database\Seeders;

use App\Models\Airlines;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AirlinesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $airlines = [
            ["company_name" =>
                 "Singapore Airlines",
             "icao"         => "SQ",
             "image"        => "Singapore Airlines.png"

            ],

            ["company_name" =>
                 "Qatar Airways",
             "icao"         => "QR",
             "image"        => "Qatar Airways.png"

            ],

            ["company_name" =>
                 "ANA All Nippon Airways",
             "icao"         => "NH",
             "image"        => "ANA All Nippon Airways.png"

            ],

            [

                "company_name" =>
                    "Emirates",
                "icao"         => "EK",
                "image"        => "Emirates.png"

            ],

            ["company_name" =>
                 "Japan Airlines",
             "icao"         => "JL",
             "image"        => "Japan Airlines.png"

            ],

            [

                "company_name" =>
                    "Turkish Airlines",
                "icao"         => "TK",
                "image"        => "Turkish Airlines.png"

            ],

            ["company_name" =>
                 "Air France",
             "icao"         => "AF",
             "image"        => "Air France.png"

            ],

            [

                "company_name" =>
                    "Cathay Pacific Airways",
                "icao"         => "CX",
                "image"        => "Cathay Pacific Airways.png"

            ],

            ["company_name" =>
                 "EVA Air",
             "icao"         => "BR",
             "image"        => "EVA Air.png"

            ],

            [

                "company_name" =>
                    "Korean Air",
                "icao"         => "KE",
                "image"        => "Korean Air.png"

            ],

            ["company_name" =>
                 "Hainan Airlines",
             "icao"         => "HU",
             "image"        => "Hainan Airlines.png"

            ],

            [

                "company_name" => "Swiss International Air Lines",
                "icao"         => "LX",
                "image"        => "Swiss International Air Lines .png"],

            [
                "company_name" => "Etihad Airways",
                "icao"         => "EY",
                "image"        => "Etihad Airways.png"

            ],

            [

                "company_name" => "Iberia",
                "icao"         => "IB",
                "image"        => "Iberia.png"

            ],

            ["company_name" => "Fiji Airways",
             "icao"         => "FJ",
             "image"        => "Fiji Airways.png"

            ],

            [

                "company_name" => "Vistara",
                "icao"         => "UK",
                "image"        => "Vistara.png"

            ],

            ["company_name" => "Qantas Airways",
             "icao"         => "QF",
             "image"        => "Qantas Airways.png"

            ],

            [

                "company_name" => "British Airways",
                "icao"         => "BA",
                "image"        => "British Airways.png"

            ],

            ["company_name" => "Air New Zealand",
             "icao"         => "NZ",
             "image"        => "Air New Zealand.png"

            ],

            [

                "company_name" => "Delta Air Lines",
                "icao"         => "DL",
                "image"        => "Delta Air Lines.png"

            ],

            ["company_name" => "United Airlines",
             "icao"         => "UA",
             "image"        => "United Airlines.png"

            ],

            [

                "company_name" => "American Airlines",
                "icao"         => "AA",
                "image"        => "American Airlines.png"

            ],

            ["company_name" => "Lufthansa",
             "icao"         => "LH",
             "image"        => "Lufthansa.png"

            ],

            [

                "company_name" => "Air Canada",
                "icao"         => "AC",
                "image"        => "Air Canada.png"

            ],

            ["company_name" => "KLM Royal Dutch Airlines",
             "icao"         => "KL",
             "image"        => "KLM Royal Dutch Airlines.png"

            ],

            [

                "company_name" => "Scandinavian Airlines",
                "icao"         => "SK",
                "image"        => "Scandinavian Airlines.png"

            ],

            [

                "company_name" => "Norwegian Air Shuttle",
                "icao"         => "DY",
                "image"        => "Norwegian Air Shuttle.png"

            ],

            ["company_name" => "Air China",
             "icao"         => "CA",
             "image"        => "Air China.png"],

            ["company_name" => "Asiana Airlines",
             "icao"         => "OZ",
             "image"        => "Asiana Airlines.png"],

            ["company_name" => "China Southern Airlines",
             "icao"         => "CZ",
             "image"        => "China Southern Airlines.png"],

            ["company_name" => "China Eastern Airlines",
             "icao"         => "MU",
             "image"        => "China Eastern Airlines.png"],

            ["company_name" => "JetBlue Airways",
             "icao"         => "B6",
             "image"        => "JetBlue Airways.png"],

            ["company_name" => "AirAsia",
             "icao"         => "AK",
             "image"        => "AirAsia.png"],

            ["company_name" => "easyJet",
             "icao"         => "U2",
             "image"        => "easyJet.png"],

            ["company_name" => "Southwest Airlines",
             "icao"         => "WN",
             "image"        => "Southwest Airlines.png"],

            ["company_name" => "Ryanair",
             "icao"         => "FR",
             "image"        => "Ryanair.png"],

            ["company_name" => "flydubai",
             "icao"         => "FZ",
             "image"        => "flydubai.png"],

            ["company_name" => "Air Transat",
             "icao"         => "TS",
             "image"        => "Air Transat.png"],

            ["company_name" => "Hawaiian Airlines",
             "icao"         => "HA",
             "image"        => "Hawaiian Airlines.png"],

            ["company_name" => "Alaska Airlines",
             "icao"         => "AS",
             "image"        => "Alaska Airlines.png"],

            ["company_name" => "Philippine Airlines",
             "icao"         => "PR",
             "image"        => "Philippine Airlines.png"],

            ["company_name" => "Air India",
             "icao"         => "AI",
             "image"        => "Air India.png"],

            ["company_name" => "Spirit Airlines",
             "icao"         => "NK",
             "image"        => "Spirit Airlines.png"],

            ["company_name" => "Saudia",
             "icao"         => "SV",
             "image"        => "Saudia.png"],

            ["company_name" => "Aeromexico",
             "icao"         => "AM",
             "image"        => "Aeromexico.png"],

            ["company_name" => "Air Seychelles",
             "icao"         => "HM",
             "image"        => "Air Seychelles.png"],

            ["company_name" => "Copa Airlines",
             "icao"         => "CM",
             "image"        => "Copa Airlines.png"],

            ["company_name" => "Air Baltic",
             "icao"         => "BT",
             "image"        => "Air Baltic.png"],

            ["company_name" => "Royal Air Maroc",
             "icao"         => "AT",
             "image"        => "Royal Air Maroc.png"],

            ["company_name" => "Avianca",
             "icao"         => "AV",
             "image"        => "Avianca.png"],

            ["company_name" => "LOT Polish Airlines",
             "icao"         => "LO",
             "image"        => "LOT Polish Airlines.png"],

            ["company_name" => "TAP Air Portugal",
             "icao"         => "TP",
             "image"        => "TAP Air Portugal.png"],

            ["company_name" => "Brussels Airlines",
             "icao"         => "SN",
             "image"        => "Brussels Airlines.png"],

            ["company_name" => "Austrian Airlines",
             "icao"         => "OS",
             "image"        => "Austrian Airlines.png"],

            ["company_name" => "Sun Country Airlines",
             "icao"         => "SY",
             "image"        => "Sun Country Airlines.png"],

            ["company_name" => "XiamenAir",
             "icao"         => "MF",
             "image"        => "XiamenAir.png"],

            ["company_name" => "Air Malta",
             "icao"         => "KM",
             "image"        => "Air Malta.png"],

            ["company_name" => "Aeroflot",
             "icao"         => "SU",
             "image"        => "Aeroflot.png"],

            ["company_name" => "Virgin Australia",
             "icao"         => "VA",
             "image"        => "Virgin Australia.png"],

            ["company_name" => "Air Mauritius",
             "icao"         => "MK",
             "image"        => "Air Mauritius.png"],

            ["company_name" => "Icelandair",
             "icao"         => "FI",
             "image"        => "Icelandair.png"],

            ["company_name" => "Volaris",
             "icao"         => "Y4",
             "image"        => "Volaris.png"],

            ["company_name" => "Garuda Indonesia",
             "icao"         => "GA",
             "image"        => "Garuda Indonesia.png"],

            ["company_name" => "China Airlines",
             "icao"         => "CI",
             "image"        => "China Airlines.png"],

            ["company_name" => "Kenya Airways",
             "icao"         => "KQ",
             "image"        => "Kenya Airways.png"],

            ["company_name" => "Bangkok Airways",
             "icao"         => "PG",
             "image"        => "Bangkok Airways.png"],

            ["company_name" => "El Al",
             "icao"         => "LY",
             "image"        => "El Al.png"],

            ["company_name" => "Air Serbia",
             "icao"         => "JU",
             "image"        => "Air Serbia.png"],

            ["company_name" => "TUI fly",
             "icao"         => "X3",
             "image"        => "TUI fly.png"],

            ["company_name" => "LATAM Airlines",
             "icao"         => "LA",
             "image"        => "LATAM Airlines.png"],

            ["company_name" => "Jet2.com",
             "icao"         => "EXS",
             "image"        => "Jet2.com.png"],

            ["company_name" => "Royal Jordanian",
             "icao"         => "RJ",
             "image"        => "Royal Jordanian.png"],

            ["company_name" => "Air Astana",
             "icao"         => "KC",
             "image"        => "Air Astana.png"],

            ["company_name" => "Air Arabia",
             "icao"         => "G9",
             "image"        => "Air Arabia.png"],

            ["company_name" => "Flynas",
             "icao"         => "XY",
             "image"        => "Flynas.png"],

            ["company_name" => "Rossiya Airlines",
             "icao"         => "FV",
             "image"        => "Rossiya Airlines.png"],

            ["company_name" => "Luxair",
             "icao"         => "LG",
             "image"        => "Luxair.png"],

            ["company_name" => "Air New Zealand",
             "icao"         => "NZ",
             "image"        => "Air New Zealand.png"],

            ["company_name" => "Jazeera Airways",
             "icao"         => "J9",
             "image"        => "Jazeera Airways.png"],

            ["company_name" => "All Nippon Airways",
             "icao"         => "NH",
             "image"        => "All Nippon Airways.png"],

            ["company_name" => "LEVEL",
             "icao"         => "AN",
             "image"        => "LEVEL.png"],

            ["company_name" => "Wizz Air",
             "icao"         => "W6",
             "image"        => "Wizz Air.png"],

            ["company_name" => "Condor Airlines",
             "icao"         => "DE",
             "image"        => "Condor Airlines.png"],

            ["company_name" => "Uzbekistan Airways",
             "icao"         => "HY",
             "image"        => "Uzbekistan Airways.png"],

            ["company_name" => "Ukraine International Airlines",
             "icao"         => "PS",
             "image"        => "Ukraine International Airlines.png"],

            ["company_name" => "Pegasus Airlines",
             "icao"         => "PC",
             "image"        => "Pegasus Airlines.png"],

            ["company_name" => "Etihad Airways",
             "icao"         => "EY",
             "image"        => "Etihad Airways.png"],

            ["company_name" => "Alitalia",
             "icao"         => "AZ",
             "image"        => "Alitalia.png"],

            ["company_name" => "Eurowings",
             "icao"         => "EW",
             "image"        => "Eurowings.png"],

            ["company_name" => "Hong Kong Airlines",
             "icao"         => "HX",
             "image"        => "Hong Kong Airlines.png"],

            ["company_name" => "LOT Polish Airlines",
             "icao"         => "LO",
             "image"        => "LOT Polish Airlines.png"],

        ];
        foreach ($airlines as $airline) {
            Airlines::create($airline);
        }

    }
}




