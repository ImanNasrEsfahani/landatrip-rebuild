<?php

namespace App\Services;

use App\Models\Tour;
use App\Models\TourExclude;
use App\Models\TourHighlight;
use App\Models\TourInclude;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class TeacherTourEditing
{
    public function update(User $teacher, Tour $tour, array $data): bool
    {
        return DB::transaction(function () use ($teacher, $tour, $data) {
            $locked = Tour::whereKey($tour->id)->lockForUpdate()->firstOrFail();
            abort_unless($locked->user_id === $teacher->id, 403);
            $locked->forceFill(collect($data)->only(['title', 'subtitle', 'short_summary', 'tour_overview', 'transport', 'evaluation_type', 'min_score', 'skills'])->all());
            if (array_key_exists('location_id', $data)) $locked->city_id = $data['location_id'];
            if (array_key_exists('language_id', $data)) $locked->language_id = $data['language_id'];
            if (array_key_exists('age', $data)) {
                $locked->min_age = $data['age'][0];
                $locked->max_age = $data['age'][1];
            }
            $locked->saveOrFail();
            foreach (['highlights' => TourHighlight::class, 'includes' => TourInclude::class, 'excludes' => TourExclude::class] as $key => $model) {
                foreach ($data[$key] ?? [] as $item) {
                    $model::firstOrCreate(['tour_id' => $locked->id, 'title' => $item['title']]);
                }
            }
            $durationChanged = false;
            foreach ($data['itineraries'] ?? [] as $index => $item) {
                $row = empty($item['id']) ? $locked->tourItineraries()->make()
                    : $locked->tourItineraries()->whereKey($item['id'])->lockForUpdate()->firstOrFail();
                $rangeChanged = !$row->exists || array_key_exists('start', $item) || array_key_exists('end', $item);
                $row->fill(collect($item)->only(['title', 'description', 'start', 'end'])->all());
                if ($rangeChanged && ($row->start === null || $row->end === null || (int) $row->end < (int) $row->start)) {
                    throw ValidationException::withMessages(["itineraries.$index.end" => 'Invalid day range.']);
                }
                $row->saveOrFail();
                $durationChanged = $durationChanged || $rangeChanged;
            }
            if ($durationChanged) {
                $locked->days = $locked->tourItineraries()->get()->max(fn ($row) => (int) $row->end);
                $locked->nights = $locked->days - 1;
                $locked->saveOrFail();
            }
            return true;
        });
    }
}
