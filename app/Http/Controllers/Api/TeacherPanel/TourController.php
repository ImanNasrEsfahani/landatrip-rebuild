<?php

namespace App\Http\Controllers\Api\TeacherPanel;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\TeacherPanel\StoreTeacherTourRequest;
use App\Http\Resources\Teacher\TeacherShowTourGroupResource;
use App\Http\Resources\Teacher\TeacherTourResource;
use App\Models\Tour;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class TourController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index(Request $request)
    {
        return TeacherTourResource::collection(auth()->user()->tours()->paginate($request->input('pageSize')));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     *
     * @return bool
     */
    public function store(StoreTeacherTourRequest $request)
    {
        return app(\App\Services\TeacherTourCreation::class)->create($request->user(), $request->validated());
    }

    /**
     * Display the specified resource.
     *
     * @param Tour $tour
     *
     * @return AnonymousResourceCollection
     */
    public function show(Tour $tour)
    {
        abort_unless(auth()->user()->tours()->whereKey($tour->getKey())->exists(), 403);
        return TeacherShowTourGroupResource::collection($tour->groups()->get());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Tour $tour
     *
     * @return Response
     */
    public function edit(Tour $tour)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Tour    $tour
     *
     * @return Response
     */
    public function update(\App\Http\Requests\Api\TeacherPanel\UpdateTeacherTourRequest $request, Tour $tour)
    {
        return app(\App\Services\TeacherTourEditing::class)->update($request->user(), $tour, $request->validated());
    }

    public function editData(Tour $tour)
    {
        abort_unless($tour->user_id === auth()->id(), 403);
        return response()->json(['data' => [
            'id' => $tour->id, 'title' => $tour->title, 'subtitle' => $tour->subtitle,
            'short_summary' => $tour->short_summary, 'tour_overview' => $tour->tour_overview,
            'location_id' => $tour->city_id, 'location' => $tour->city?->name, 'language_id' => $tour->language_id,
            'certification_id' => $tour->certification_id, 'age' => [$tour->min_age, $tour->max_age],
            'itineraries' => $tour->tourItineraries()->get()->sortBy(fn ($row) => (int) $row->start)->values()
                ->map(fn ($row) => collect($row)->only(['id', 'title', 'description', 'start', 'end'])),
        ]]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Tour $tour
     *
     * @return Response
     */
    public function destroy(Tour $tour)
    {
        //
    }
}
