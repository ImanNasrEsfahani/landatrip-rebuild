<?php

namespace App\Http\Resources;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class HotelResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $json = json_decode($this->resource, true);
//        $hotelName = $json["name"];
//        $lat = $json["geoCode"]["latitude"];
//        $lng = $json["geoCode"]["longitude"];
//        $latLng = $lat . "," . $lng;
//        $googleKey = config('services.google.places_api_key');
//        $client = new Client();
//
//        $response = $client->request('GET', 'https://maps.googleapis.com/maps/api/place/textsearch/json', [
//            'headers' => ['Accept' => 'application/json'],
//            'query' => [
//                'location' => $latLng,
//                'query' => $hotelName,
//                'radius' => 10,
//                'key' => $googleKey
//            ]
//        ]);
//
//        $jsonResponse = json_decode($response->getBody(), true);
//        $placeId = $jsonResponse['results'][0]['place_id'] ?? null;
//
//        $response = $client->get("https://maps.googleapis.com/maps/api/place/details/json", [
//            'query' => [
//                'place_id' => $placeId,
//                'key' => $googleKey,
//                'fields' => 'photos'
//            ]
//        ]);
//
//        $placeDetails = json_decode($response->getBody(), true);
//        $photos = [];
//        $map = "";
//        if (!empty($placeDetails['result']['photos'])) {
//                $photoReference = $placeDetails['result']['photos'][0]['photo_reference'];
//            $photoResponse = $client->get("https://maps.googleapis.com/maps/api/place/photo", [
//                    'query' => [
//                        'photoreference' => $photoReference,
//                        'key' => $googleKey,
//                        'maxwidth' => 400
//                    ],
//                    'stream' => true
//                ]);
//                // Since an actual image is binary data, you might want to encode it if you're outputting as JSON
//                $photos[] = $photoResponse->getBody()->getMetadata()["uri"];
//                $map = $placeDetails['result']['photos'][0]["html_attributions"];
//        }
//        $image = response([$photos,$map]);
        return [
            "hotels"    =>  $json,
            "data"      =>  "https://media.istockphoto.com/id/104731717/photo/luxury-resort.jpg?s=612x612&w=0&k=20&c=cODMSPbYyrn1FHake1xYz9M8r15iOfGz9Aosy9Db7mI="
        ];
    }
}
