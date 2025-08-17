<?php

namespace App\Http\Requests;

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
            //"user_id",
            //"assigned_agent_id",
            "title"    => ["required", "min:3", "max:150"],
            "priority" => ["required", "min:3", "max:150"],
//            "status"   => ["required", "min:3", "max:150"]
        ];
    }
}
