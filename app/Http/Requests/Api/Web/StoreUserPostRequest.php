<?php

namespace App\Http\Requests\Api\Web;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserPostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            //'user_id',
            'title'         =>  ["required", "max:255"],
            'location'      =>  ["required", "max:150"],
            'image'         =>  ["required", "mimes:jpeg,jpg,png,gif", "max:1000000"]
        ];
    }
}
