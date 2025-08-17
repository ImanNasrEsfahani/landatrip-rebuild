<?php

namespace App\Http\Requests\Api\TeacherPanel;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTeacherEducationRequest extends FormRequest
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
            "id"         => ["max:150"],
            "title"      => ["required", "max:150"],
            "university" => ["required", "max:250"],
            "level"      => ["required", "max:150"],
            "from"       => ["required", "max:150"],
            "to"         => ["max:150"],
            //"status"         => ["required", "max:150"]
        ];
    }
}
