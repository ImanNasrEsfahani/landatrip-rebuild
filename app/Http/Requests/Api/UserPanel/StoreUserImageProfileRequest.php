<?php

namespace App\Http\Requests\Api\UserPanel;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserImageProfileRequest extends FormRequest
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
            "url" => ["image", "mimes:jpg,png,jpeg", "max:2048"]
        ];
    }
}
