<?php

namespace App\Http\Requests\Api\TeacherPanel;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreTeacherTourRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user() !== null;
    }

    public function rules(): array
    {
        return [
            // No ownership/issuance eligibility mapping exists for global templates yet.
            'certification_id' => ['nullable', Rule::prohibitedIf(fn () => $this->filled('certification_id'))],
            'title' => ['required', 'string', 'min:3', 'max:250'],
            'subtitle' => ['required', 'string', 'min:3', 'max:250'],
            'tour_overview' => ['required', 'string', 'min:3', 'max:250'],
            // The active city autocomplete sends its city ID under this legacy key.
            'location_id' => ['required', 'integer', 'min:1', 'exists:cities,id'],
            'transport' => ['nullable', 'string', 'min:3', 'max:20'],
            'short_summary' => ['required', 'string', 'min:3', 'max:250'],
            'evaluation_type' => ['required', Rule::in(['noEvaluation', 'finalInterview', 'project', 'paperBased'])],
            'min_score' => ['nullable', 'string', 'max:250'],
            'age' => ['required', 'array', 'size:2'],
            'age.0' => ['required', 'integer', 'min:1', 'max:99'],
            'age.1' => ['required', 'integer', 'gte:age.0', 'max:99'],
            'skills' => ['sometimes', 'array', 'max:50'],
            'skills.*' => ['required', 'string', 'min:3', 'max:25'],
            'highlights' => ['sometimes', 'array', 'max:50'],
            'highlights.*.title' => ['required', 'string', 'min:3', 'max:25'],
            'includes' => ['sometimes', 'array', 'max:50'],
            'includes.*.title' => ['required', 'string', 'min:3', 'max:25'],
            'excludes' => ['sometimes', 'array', 'max:50'],
            'excludes.*.title' => ['required', 'string', 'min:3', 'max:25'],
            'itineraries' => ['required', 'array', 'min:1', 'max:50'],
            'itineraries.*.title' => ['required', 'string', 'min:3', 'max:25'],
            'itineraries.*.description' => ['required', 'string', 'min:3', 'max:25'],
            'itineraries.*.start' => ['required', 'integer', 'min:1', 'max:50'],
            'itineraries.*.end' => ['required', 'integer', 'gte:itineraries.*.start', 'max:50'],
        ];
    }
}
