<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Resources\BookingProcessApiResource;
use App\Http\Resources\BookingProcessUserSearchResource;
use App\Models\Group;
use App\Models\Tour;
use App\Models\User;
use Illuminate\Http\Request;

class BookingProcessApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return BookingProcessApiResource
     */
    public function show(Tour $tour, Group $group)
    {
        abort_unless($group->tour_id === $tour->id, 404);
        abort_unless($group->public, 404);
        return new BookingProcessApiResource($group->load(['priceItems.currency', 'tour.city.country']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function search(Request $request)
    {
        return  BookingProcessUserSearchResource::collection(User::where('fname', 'like', '%' . $request->get('search') . '%')->orWhere('lname', 'like', '%' . $request->get('search') . '%')->get());
    }
}
