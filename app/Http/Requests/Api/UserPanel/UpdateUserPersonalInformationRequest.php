<?php

namespace App\Http\Requests\Api\UserPanel;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserPersonalInformationRequest extends FormRequest
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
            "fname"           => ["required", "min:3", "max:30"],
            "lname"           => ["required", "min:3", "max:30"],
            "title"           => ["required", "min:3", "max:30"],
            "birthday"        => ["required", "min:10", "max:10"],
            "phone_number"    => ["required", "min:11", "max:14"],
            "slug"            => ["required", "min:5", "max:150"],
            "sex"             => ["required", "min:0", "max:3", "numeric"],
            "about_me"        => ["required", "min:20", "max:550"],
            "profile_picture" => ["nullable", "integer", "min:1"]
        ];
    }
}
