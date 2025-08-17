<?php

namespace App\Http\Controllers\Application\v1\ClientApp;

use App\Enums\GroupStatusEnum;
use App\Enums\GroupUserStatusEnum;
use App\Http\Controllers\Controller;
use App\Http\Resources\Application\v1\ClientApp\SkillsResource;
use App\Http\Resources\Application\v1\ClientApp\TourCategoryCollection;
use App\Http\Resources\Application\v1\ClientApp\TourDetailsResource;
use App\Http\Resources\Application\v1\ClientApp\TourResource;

use App\Models\Group;
use App\Models\Language;
use App\Models\Skill;
use App\Models\Tour;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use League\Flysystem\UnableToSetVisibility;
use League\Flysystem\UnableToWriteFile;
use stdClass;

class TourController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection|\Illuminate\Support\Collection
     */
    public function index()
    {
        $collection = collect();
        $userObj = auth()->user();

        // User Booked Tours
        $bookedTours = $userObj->Groups()->get();
        $filtered = $bookedTours->filter(function ($item, $key) {
            return $item->pivot->status === GroupUserStatusEnum::booked;
        })->all();

        $collection->put("Your Booked tours", TourResource::collection($filtered));
        $bookedObj = new stdClass();
        $bookedObj->info = "Your Booked tours";
        $bookedObj->data = TourResource::collection($filtered);

        // User Recommendation by AI
        $recommendedTours = Group::where("status", "=", GroupStatusEnum::registration)->where("language_id", "=", Language::where("slug", "=", app()->getLocale())->first()->id)->inRandomOrder()->limit(rand(3,6))->get();
        $collection->put("For You", TourResource::collection($recommendedTours));
        $recommendedObj = new stdClass();
        $recommendedObj->info = "For You";
        $recommendedObj->data = TourResource::collection($recommendedTours);


        // This week
        $thisWeekTour = Group::whereBetween('end_registration_date', [Carbon::now(), Carbon::now()->endOfWeek()])->inRandomOrder()->where("language_id", "=", Language::where("slug", "=", app()->getLocale())->first()->id)->limit(rand(3,6))->get();
        $thisWeekTourObj = new stdClass();
        $thisWeekTourObj->info = "This Week";
        $thisWeekTourObj->data = TourResource::collection($thisWeekTour);

        // This Month
        $thisMonthTour = Group::whereBetween('end_registration_date', [Carbon::now()->endOfWeek(), Carbon::now()->endOfMonth()])->where("language_id", "=", Language::where("slug", "=", app()->getLocale())->first()->id)->inRandomOrder()->limit(rand(3,6))->get();
        $thisMonthTourObj = new stdClass();
        $thisMonthTourObj->info = "This Month";
        $thisMonthTourObj->data = TourResource::collection($thisMonthTour);

        // Skills
//        $skills = Skill::where("language_id", "=", Language::where("slug", "=", app()->getLocale())->first()->id)->get();
//        $skillsObj = new stdClass();
//        $skillsObj->info = "Categories";
//        $skillsObj->data = TourResource::collection($skills);


        return TourCategoryCollection::collection(array($bookedObj, $recommendedObj, $thisWeekTourObj, $thisMonthTourObj));

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
    public function uploadFileToCloud(Request $request)
    {
//        dd(Storage::disk('gcs')->allFiles());
            $file = $request->file('file');
//            $filename = time() . "-" . auth()->user()->id . "-" . (auth()->user()->fname ?? "") . "-" . (auth()->user()->lname ?? "") . "." . $file->extension();
            $filename = time() . "." . $file->extension();
//            $storeFile = $file->storeAs("test", $file_name, "gcs");
            $disk = Storage::put("/public/tmp-files/{$filename}", file_get_contents($file));
            dd($disk);
            $fetchFile = $disk->url($storeFile);


        return response()->json([
            'data' => $fetchFile,
        ], 201);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param Tour $tour
     *
     * @return TourDetailsResource
     */
    public function show(Tour $tour)
    {
        return new TourDetailsResource($tour);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
