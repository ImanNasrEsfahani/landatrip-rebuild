<?php

namespace App\Http\Controllers\Api;

use Amadeus\Amadeus;
use App\Http\Controllers\Controller;
use App\Http\Requests\AmadeusAirportSearchRequest;
use App\Http\Requests\FlightBookingRequest;
use App\Http\Requests\HotelDetailsRequest;
use App\Http\Resources\AmadeusResource;
use App\Http\Resources\AmadeusSearchResource;
use App\Http\Resources\FlightDetailsResource;
use App\Http\Resources\HotelDetailsResource;
use App\Http\Resources\HotelResource;
use App\Http\Resources\Teacher\FindCitiesResource;
use App\Models\City;
use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Cache;
use GuzzleHttp\Client;


class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Amadeus\Resources\Destination[]|\Amadeus\Resources\FlightOffer[]
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public function hotel(AmadeusAirportSearchRequest $request)
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return AnonymousResourceCollection
     */
    public function store(FlightBookingRequest $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return AnonymousResourceCollection
     */
    public function show(Country $country)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function originSearch(Request $request)
    {
        $amadeus = Amadeus::builder()->build();
        return AmadeusSearchResource::collection($amadeus->getReferenceData()->getLocations()->get(["keyword" => "$request->keyword", "subType" => "CITY"]));
    }

    public function destinationSearch(Request $request)
    {
        $amadeus = Amadeus::builder()->build();
        return AmadeusSearchResource::collection($amadeus->getReferenceData()->getLocations()->get(["keyword" => $request->keyword, "subType" => "CITY"]));
    }

    public function flightBooking(FlightBookingRequest $request)
    {
        $amadeus = Amadeus::builder()->build();
        return AmadeusResource::collection($amadeus->getShopping()->getFlightOffers()->get($request->validated()));
    }
    public function flightDetails(Request $request)
    {
        $amadeus = Amadeus::builder()->build();
        $flightOffers = $request->input(["value"]);
        $body = json_encode([
            "data" => [
                "type" => "flight-offers-pricing",
                "flightOffers" => [$flightOffers]
            ]
        ]);
        return new FlightDetailsResource($amadeus->getShopping()->getFlightOffers()->getPricing()->post($body));
    }

    public function hotelOffers(Request $request)
    {
        $amadeus = Amadeus::builder()->build();
        return HotelResource::collection($amadeus->getReferenceData()->getLocations()->getHotels()->getByCity()->get(["cityCode"=>$request->input("cityCode")]));
    }

    public function hotelDetails(HotelDetailsRequest $request)
    {
        $amadeus = Amadeus::builder()->build();
        return HotelDetailsResource::collection($amadeus->getShopping()->getHotelOffers()->get($request->validated()));
    }


    public function googleApi()
    {
        $client = new Client();
        $apiKey = 'AIzaSyBro7Mv__QwKTI8BXIGtDZP6Q6cAIjKMUM';
        $placeId = 'ChIJGyD_--Zx5kcRVR9P2KquU0A';

        $response = $client->get("https://maps.googleapis.com/maps/api/place/details/json", [
            'query' => [
                'place_id' => $placeId,
                'key' => $apiKey,
                'fields' => 'photos'
            ]
        ]);

        $placeDetails = json_decode($response->getBody(), true);
        $photos = [];
        $map = "";
        if (!empty($placeDetails['result']['photos'])) {
            foreach ($placeDetails['result']['photos'] as $photo) {
                $photoReference = $photo['photo_reference'];
                $photoResponse = $client->get("https://maps.googleapis.com/maps/api/place/photo", [
                    'query' => [
                        'photoreference' => $photoReference,
                        'key' => $apiKey,
                        'maxwidth' => 400
                    ],
                    'stream' => true
                ]);
                // Since an actual image is binary data, you might want to encode it if you're outputting as JSON
                $photos[] = $photoResponse->getBody()->getMetadata()["uri"];
                $map = $photo["html_attributions"];
            }
        }
        return response([$photos,$map]);
    }
}
