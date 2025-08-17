<?php

namespace App\Http\Requests\Api\Application\v1\ClientApp;

use Illuminate\Foundation\Http\FormRequest;

class StoreCommentPost extends FormRequest
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
            "comment"=>["required","min:3","max:250"],
        ];
    }
}
