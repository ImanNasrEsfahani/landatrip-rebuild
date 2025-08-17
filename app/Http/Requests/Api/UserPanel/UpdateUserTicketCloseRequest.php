<?php

namespace App\Http\Requests\Api\UserPanel;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserTicketCloseRequest extends FormRequest
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
            "rate"           =>["required","min:1", "max:5"],
            "feedback"       =>["min:2", "max:450", "nullable"]
        ];
    }
}
