<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserRatingResource;
use App\Models\Group;
use App\Models\User;
use App\Models\UserRating;
use App\Http\Requests\StoreUserRatingRequest;
use App\Http\Requests\UpdateUserRatingRequest;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class UserRatingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index(Group $group)
    {
        return UserRatingResource::collection($group->users()->where("user_id", "<>", auth()->user()->id)->get());
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
     * @param StoreUserRatingRequest $request
     * @param Group $group
     * @param User $user
     * @return bool
     */
    public function store(StoreUserRatingRequest $request, Group $group)
    {
        foreach ($request->validated()["users"] as $item) {
            $userRatingObj = UserRating::where([
                ["group_id", "=", $group->id],
                ["user_id", "=", auth()->user()->id],
                ["user_rated_id", "=", $item['user_rated_id']]
            ])->first();

            if(!$userRatingObj) {
                $userRatingObj = new UserRating([
                    'user_id' => auth()->user()->id,
                    'group_id' => $group->id,
                    'user_rated_id' => $item['user_rated_id'],
                ]);
                $userRatingObj->save();
            }
        }
        return true;
    }

    /**
     * Display the specified resource.
     *
     * @param UserRating $userRating
     * @return Response
     */
    public function show(UserRating $userRating)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param UserRating $userRating
     * @return Response
     */
    public function edit(UserRating $userRating)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateUserRatingRequest $request
     * @param UserRating $userRating
     * @return Response
     */
    public function update(UpdateUserRatingRequest $request, UserRating $userRating)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param UserRating $userRating
     * @return Response
     */
    public function destroy(UserRating $userRating)
    {
        //
    }
}
