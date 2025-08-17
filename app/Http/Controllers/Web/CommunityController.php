<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Web\StoreCommunityRequest;
use App\Http\Requests\Api\Web\UpdateCommunityRequest;
use App\Http\Requests\Api\Web\UpdateCommunityUserRequest;
use App\Models\Community;
use App\Models\Language;
use App\Models\Tour;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

class CommunityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return void
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return void
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\Api\Web\\App\Http\Requests\Api\Web\Web\StoreCommunityRequest $request
     * @return void
     */
    public function store(StoreCommunityRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param Community $community
     * @return View
     */
    public function show(Community $community): View
    {
        $lang = Language::where('slug', App::getLocale())->first();

        $relatedCommunities = Community::where('id', '<>', $community->id)->get();
        $relatedTours = Tour::whereBelongsTo($lang)->inRandomOrder()->get();

        return view('community.community')->with('community', $community)->with('relatedCommunities', $relatedCommunities)->with('relatedTours', $relatedTours);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Community $community
     * @return void
     */
    public function edit(Community $community)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateCommunityRequest $request
     * @param Community $community
     * @return void
     */
    public function update(UpdateCommunityRequest $request, Community $community)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Community $community
     * @return void
     */
    public function destroy(Community $community)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Community $community
     * @return RedirectResponse
     */
    public function follow(UpdateCommunityUserRequest $request, Community $community): RedirectResponse
    {
        $community->users()->attach(Auth::user());
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Community $community
     * @return RedirectResponse
     */
    public function unfollow(Community $community): RedirectResponse
    {
        $community->users()->detach(Auth::user());
        return redirect()->back();
    }
}
