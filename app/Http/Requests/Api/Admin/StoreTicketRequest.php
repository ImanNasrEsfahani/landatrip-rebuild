<?php

namespace App\Http\Requests\Api\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreTicketRequest extends FormRequest
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
            "users"    => ["required", "array","min:1", "max:30"],
            "title"    => ["required", "min:5", "max:30"],
            "priority"    => ["required", "min:0", "max:2"],
            "message" => ["required", "min:5"],
        ];
    }
}
