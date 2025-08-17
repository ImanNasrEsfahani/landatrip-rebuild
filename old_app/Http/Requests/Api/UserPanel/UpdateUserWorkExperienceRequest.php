<?php

namespace App\Http\Requests\Api\UserPanel;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class UpdateUserWorkExperienceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize ()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules ()
    {
        return [
            "id"           => ["max:250"],
            "company_name" => ["required", "max:250"],
            "position"     => ["required", "max:150"],
            "from"         => ["numeric", "required", "min:1900", "max:" . Carbon::now()->year],
            "to"           => ["nullable", "numeric", "min:1900", "max:" . Carbon::now()->year]
        ];
    }
}
