<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreNewsletterRequest extends FormRequest
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
            "newsletter_email" => ['required', 'unique:newsletters', 'max:255', 'email'],
            "name"             => ['prohibited'],
            //"recaptcha"     =>  ['required', 'string', 'max:100']
        ];
    }

    /**
     * Dispaly Name for fields
     * @return string[]
     */
    public function attributes ()
    {
        return [
            'newsletter_email' => 'email',
        ];
    }
}
