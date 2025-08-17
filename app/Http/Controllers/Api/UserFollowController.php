<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Following;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserFollowController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
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
     * @param User $user
     *
     * @return bool
     */
    public function store(User $user)
    {
        if (!($user->id === auth()->user()->id)) {
            if (!(Following::where("follower_id", '=', auth()->user()->id)->where("followed_id", '=', $user->id)->count() > 0)) {
                $userFollowingObj = new Following();
                $userFollowingObj->followerUser()->associate(auth()->user());
                $userFollowingObj->followedUser()->associate($user);
                return $userFollowingObj->save();
            }
            return response()->json("This User has been followed", 402);
        }
        return response()->json("You can't follow your self", 402);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int                      $id
     *
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param User $user
     *
     * @return Response
     */
    public function destroy(User $user)
    {
        if (!($user->id === auth()->user()->id)) {
            $followingObj = Following::where("follower_id", "=", auth()->user()->id)->where("followed_id", "=", $user->id)->first();
            if ($followingObj) {
                return $followingObj->delete();
            }
            return response()->json("This User has been Unfollowed", 402);
        }
        return response()->json("You can't Unfollow your self", 402);

    }
}
