<?php

namespace App\Http\Requests\Api\UserPanel;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserSocialMediaRequest extends FormRequest
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
            "social_media_id"     =>  ['required'],
            "address"   =>  ['required',"max:300", "min:10"]
        ];
    }
}
