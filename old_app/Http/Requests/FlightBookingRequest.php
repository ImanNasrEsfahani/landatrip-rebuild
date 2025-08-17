<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FlightBookingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            "originLocationCode"      => ["required", "min:2"],
            "destinationLocationCode" => ["required", "min:2"],
            "departureDate"           => ["required", "date"],
            "returnDate"              => ["date"],
            "adults"                  => ["min:1"],
            "children"                => ["min:1"],
            "travelClass"             => ["required", "min:3"],
//            "oneWay"                  => ["min:1","bool"]
        ];
    }
}
