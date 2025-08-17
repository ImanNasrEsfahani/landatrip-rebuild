<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreGroupRequest extends FormRequest
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
            $this->title    =>  ["required", "min:3", "max:150"],
            $this->location    =>  ["required", "min:3", "max:150"],
            $this->start_date    =>  ["required", "date"],
            $this->end_date    =>  ["required", "date"],
            $this->starting_location    =>  ["required"],
            $this->ending_location    =>  ["required"],
            $this->capacity    =>  ["required", "numeric", "min:1", "max:100"],
            $this->last_registration_date    =>  ["required", "min:3", "max:150"],
            $this->public    =>  ["boolean"],
        ];
    }
}
