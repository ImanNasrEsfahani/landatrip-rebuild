<?php

namespace App\Http\Requests\Api\TeacherPanel;

use Illuminate\Foundation\Http\FormRequest;

class StoreTeacherTourRequest extends FormRequest
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
            "title"                   => ["required", "min:3", "max:250"],
            "subtitle"                => ["required", "min:3", "max:250"],
            "tour_overview"           => ["required", "min:3", "max:250"],
            "location_id"             => ["required", "min:1", "max:4"],
            "transport"               => ["required", "min:3", "max:20"],
            "short_summary"           => ["required", "min:3", "max:250"],
            "evaluation_type"         => ["required", "min:3", "max:250"],
            "min_score"               => [],
            "age"                     => ["array"],
            "skills.*"                => ["required", "min:3", "max:25"],
            "highlights.*.title"       => ["required", "min:3", "max:25"],
            "includes.*.title"         => ["required", "min:3", "max:25"],
            "excludes.*.title"         => ["required", "min:3", "max:25"],
            "itineraries.*.title" => ["required", "min:3", "max:25"],
            "itineraries.*.description"  => ["required", "min:3", "max:25"],
            "itineraries.*.start"     => [],
            "itineraries.*.end"       => [],
        ];
    }
}
