<?php

namespace App\Http\Requests\Api\TeacherPanel;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTeacherSocialMediaRequest extends FormRequest
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
    public function rules(): array
    {
        return [
            "twitter"       => ["min:3", "max:250", "nullable"],
            "instagram"     => ["min:3", "max:250", "nullable"],
            "facebook"      => ["min:3", "max:250", "nullable"],
            "linkedin"      => ["min:3", "max:250", "nullable"]
        ];
    }
}
