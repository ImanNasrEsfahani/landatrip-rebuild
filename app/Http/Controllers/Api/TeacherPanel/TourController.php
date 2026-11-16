<?php

namespace App\Http\Controllers\Api\TeacherPanel;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\TeacherPanel\StoreTeacherTourRequest;
use App\Http\Resources\Teacher\TeacherShowTourGroupResource;
use App\Http\Resources\Teacher\TeacherTourResource;
use App\Models\Tour;
use App\Models\TourHighlight;
use App\Models\TourInclude;
use App\Models\TourItinerary;
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
        $tourObj = new Tour($request->validated());
        $tourObj->language_id = 1;
        $tourObj->user()->associate(auth()->user());
        unset($tourObj["highlights"], $tourObj["includes"], $tourObj["excludes"], $tourObj["itineraries"], $tourObj["age"]);
        $tourObj->min_age = $request->validated("age")[0];
        $tourObj->max_age = $request->validated("age")[1];
        $temp = $request->validated("itineraries");
        $tourObj->days = end($temp)['end'];
        $tourObj->nights = end($temp)['end'] - 1;
        $tourObj->save();

        foreach ($request->validated("highlights") as $highlight) {
            $highlightObj = new TourHighlight($highlight);
            $highlightObj->tour()->associate($tourObj);
            $highlightObj->save();
        }

        foreach ($request->validated("includes") as $includes) {
            $includesObj = new TourInclude($includes);
            $includesObj->tour()->associate($tourObj);
            $includesObj->save();
        }

        foreach ($request->validated("excludes") as $excludes) {
            $excludesObj = new TourInclude($excludes);
            $excludesObj->tour()->associate($tourObj);
            $excludesObj->save();
        }

        foreach ($request->validated("itineraries") as $itineraries) {
            $itinerariesObj = new TourItinerary($itineraries);
            $itinerariesObj->tour()->associate($tourObj);
            return $itinerariesObj->save();
        }

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
    public function update(Request $request, Tour $tour)
    {
        dd("Tour update");
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
