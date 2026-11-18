<?php

namespace App\Services;

use App\Enums\TourStatusEnums;
use App\Models\Language;
use App\Models\Tour;
use App\Models\TourExclude;
use App\Models\TourHighlight;
use App\Models\TourInclude;
use App\Models\TourItinerary;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class TeacherTourCreation
{
    public function create(User $teacher, array $data): bool
    {
        $language = Language::where('slug', app()->getLocale())->first();
        if ($language === null) {
            throw ValidationException::withMessages(['language' => 'The configured tour language is unavailable.']);
        }

        return DB::transaction(function () use ($teacher, $data, $language) {
            $tour = new Tour();
            $tour->forceFill(collect($data)->only([
                'title', 'subtitle', 'short_summary', 'tour_overview', 'transport', 'evaluation_type', 'min_score', 'skills',
            ])->all());
            $tour->user()->associate($teacher);
            $tour->teacher_name = $teacher->name;
            $tour->city_id = $data['location_id'];
            $tour->language_id = $language->id;
            $tour->status = TourStatusEnums::pending;
            $tour->certification_id = null;
            $tour->min_age = $data['age'][0];
            $tour->max_age = $data['age'][1];
            $tour->days = max(array_column($data['itineraries'], 'end'));
            $tour->nights = $tour->days - 1;
            $tour->saveOrFail();

            foreach (['highlights' => TourHighlight::class, 'includes' => TourInclude::class, 'excludes' => TourExclude::class] as $key => $model) {
                foreach ($data[$key] ?? [] as $item) {
                    $record = new $model(['title' => $item['title']]);
                    $record->tour()->associate($tour);
                    $record->saveOrFail();
                }
            }
            $itineraries = collect($data['itineraries'])->sortBy([
                ['start', 'asc'], ['end', 'asc'],
            ]);
            foreach ($itineraries as $item) {
                $record = new TourItinerary(collect($item)->only(['title', 'description', 'start', 'end'])->all());
                $record->tour()->associate($tour);
                $record->saveOrFail();
            }
            return true;
        });
    }
}
