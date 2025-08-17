<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreGroupPostRequest;
use App\Http\Resources\UserGroupPostResource;
use App\Models\Group;
use App\Models\GroupPost;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class UserGroupPostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index()
    {
       //
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
     * @param Group $group
     * @param StoreGroupPostRequest $validation
     * @return RedirectResponse
     */
    public function store(Group $group, StoreGroupPostRequest $validation)
    {
        $groupPost = new GroupPost($validation->validated());
        $groupPost->user()->associate(auth()->user());
        $group->groupPosts()->save($groupPost);
        return $groupPost;
    }

    /**
     * Display the specified resource.
     *
     * @param Group $group
     *
     * @return AnonymousResourceCollection
     */
    public function show(Group $group)
    {
        return UserGroupPostResource::collection($group->groupPosts()->get());
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
