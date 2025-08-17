<?php

namespace App\Http\Controllers\Application\v1\ClientApp;

use App\Http\Controllers\Controller;
use App\Models\Following;
use App\Models\User;
use Illuminate\Http\Request;

class UserFollowController extends Controller
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
    public function store(User $user)
    {
        if(!(Following::where("follower_id", '=', auth()->user()->id)->where("followed_id", '=', $user->id)->count() > 0)){
            $userFollowingObj = new Following();
            $userFollowingObj->followerUser()->associate(auth()->user());
            $userFollowingObj->followedUser()->associate($user);
            return $userFollowingObj->save();
        }
        return abort(402,"oh noooo");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
    public function destroy(User $user)
    {
        $followingObj = Following::where("follower_id", "=", auth()->user()->id)->where("followed_id", "=", $user->id)->first();
        if($followingObj) {
            return $followingObj->delete();
        }
        return abort(404, "This object cannot found");
    }
}
