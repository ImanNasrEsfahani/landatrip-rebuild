<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Group;
use App\Models\Language;
use App\Models\Location;
use App\Models\Skill;
use App\Models\Tour;
use App\Models\TourComment;
use Carbon\Carbon;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\App;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View|Response
     */
    public function index()
    {
        $lang = Language::where('slug', App::getLocale())->first();

        $locations = Location::whereBelongsTo($lang)->get();
        $skills = Skill::whereBelongsTo($lang)->get();
        $articles = Article::whereBelongsTo($lang)->inRandomOrder()->limit(3)->get();
        $tours = Tour::whereBelongsTo($lang)->approved()->inRandomOrder()->limit(4)->get();
        $tours = $tours->count() <= 3 ? [] : $tours;

        $comments = TourComment::whereBelongsTo($lang)->get()->count() > 5 ? TourComment::whereBelongsTo($lang)->get()->random(5) : [];
//        dd(Group::whereBelongsTo($lang)->where("end_registration_date", ">=", Carbon::now())->get());
        $upComingTours = Group::whereBelongsTo($lang)->where("end_registration_date", ">=", Carbon::now())->get();
//        dd($upComingTours);
        $upComingTours = $upComingTours->count() < 4 ? [] : $upComingTours;

        return view("home-page.home-page")->with('locations', $locations)
            ->with('skills', $skills)->with('tours', $tours)
            ->with('comments', $comments)->with('upComingTours', $upComingTours)->with('articles', $articles);
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
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
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
