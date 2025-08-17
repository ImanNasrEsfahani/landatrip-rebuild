<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreGroupTutorRequest;
use App\Http\Requests\UpdateGroupTutorRequest;
use App\Http\Resources\GroupTutorResource;
use App\Models\Group;
use App\Models\GroupTutor;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class GroupTutorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index(Group $group)
    {
        return GroupTutorResource::collection($group->groupTutors()->get());
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
     * @param StoreGroupTutorRequest $request
     * @return Response
     */
    public function store(StoreGroupTutorRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param GroupTutor $groupTutor
     * @return Response
     */
    public function show(GroupTutor $groupTutor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param GroupTutor $groupTutor
     * @return Response
     */
    public function edit(GroupTutor $groupTutor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateGroupTutorRequest $request
     * @param GroupTutor $groupTutor
     * @return Response
     */
    public function update(UpdateGroupTutorRequest $request, GroupTutor $groupTutor)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param GroupTutor $groupTutor
     * @return Response
     */
    public function destroy(GroupTutor $groupTutor)
    {
        //
    }
}
