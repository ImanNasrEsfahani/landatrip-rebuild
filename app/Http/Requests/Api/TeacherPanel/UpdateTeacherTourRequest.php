<?php

namespace App\Http\Requests\Api\TeacherPanel;

use App\Models\Tour;
use App\Models\TourItinerary;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateTeacherTourRequest extends FormRequest
{
    public function authorize(): bool
    {
        $tour = $this->route('tour');
        return $tour instanceof Tour && $this->user()?->id === $tour->user_id;
    }

    public function rules(): array
    {
        $rules = (new StoreTeacherTourRequest)->rules();
        foreach ($rules as $field => &$constraints) {
            if (!str_contains($field, '.')) {
                $constraints = array_values(array_filter($constraints, fn ($rule) => !in_array($rule, ['required', 'sometimes'], true)));
                array_unshift($constraints, 'sometimes');
            }
        }
        unset($constraints);
        foreach (['age.0', 'age.1'] as $field) $rules[$field][0] = 'required_with:age';
        $rules['language_id'] = ['sometimes', 'required', 'integer', 'exists:languages,id'];
        $rules['certification_id'] = ['sometimes', 'nullable', Rule::prohibitedIf(fn () =>
            $this->filled('certification_id') || ($this->exists('certification_id') && $this->route('tour')->certification_id !== null))];
        $rules['itineraries'] = ['sometimes', 'array', 'max:50'];
        $rules['itineraries.*'] = ['array'];
        $rules['itineraries.*.id'] = ['nullable', 'integer', 'min:1', 'distinct',
            Rule::exists('tour_itineraries', 'id')->where('tour_id', $this->route('tour')->id)];
        foreach (['title', 'description', 'start', 'end'] as $field) $rules['itineraries.*.'.$field][0] = 'sometimes';
        $rules['itineraries.*.end'] = ['sometimes', 'integer', 'min:1', 'max:50'];
        return $rules;
    }

    public function withValidator($validator): void
    {
        $validator->after(function ($validator) {
            if ($validator->errors()->isNotEmpty()) return;
            if ($this->exists('certification_id') && $this->route('tour')->certification_id !== null) {
                $validator->errors()->add('certification_id', 'Certificate changes require verified ownership and issuance eligibility.');
                return;
            }
            $items = $this->input('itineraries', []);
            $existing = TourItinerary::where('tour_id', $this->route('tour')->id)
                ->whereIn('id', array_filter(array_column($items, 'id')))->get()->keyBy('id');
            foreach ($items as $index => $item) {
                if (empty($item['id'])) {
                    foreach (['title', 'description', 'start', 'end'] as $field) {
                        if (!array_key_exists($field, $item)) $validator->errors()->add("itineraries.$index.$field", 'New itinerary entries require this field.');
                    }
                }
                if (empty($item['id']) || array_key_exists('start', $item) || array_key_exists('end', $item)) {
                    $row = $existing->get($item['id'] ?? null);
                    $start = $item['start'] ?? $row?->start;
                    $end = $item['end'] ?? $row?->end;
                    if ($start === null || $end === null || (int) $end < (int) $start) {
                        $validator->errors()->add("itineraries.$index.end", 'Provide a complete day range ending on or after its start.');
                    }
                }
            }
        });
    }
}
