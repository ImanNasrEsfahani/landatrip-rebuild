<?php

namespace App\Http\Requests\Api\Application\V1\ClientApp;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserInfoProfileRequest extends FormRequest
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
    public function rules():array
    {

        return [
           "fname"=>["required","min:3","max:30"],
            "lname"=>["required","min:3","max:30"],
            "sex"=>["required", "min:0", "max:3", "numeric"],
            "location"=>["required","min:3","max:30"],

        ];
    }
}
