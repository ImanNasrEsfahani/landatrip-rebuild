<?php

namespace App\Http\Controllers\Application\v1\ClientApp;

use App\Http\Controllers\Controller;
use App\Models\UserPost;
use App\Models\UserPostMassageSave;
use App\Models\UserPostSave;
use http\Env\Response;
use Illuminate\Http\Request;

class PostSaveController extends Controller
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
     * @return bool
     */
    public function store(UserPost $post)
    {
       if (!($post->usersPostSaved()->where("user_id","=",auth()->user()->id)->count())) {
           $postMassageSave = new UserPostSave();
           $postMassageSave->user()->associate(auth()->user());
           $postMassageSave->userPost()->associate($post);
           Return $postMassageSave->save();
       }
       return response()->json("this post has been saved",402);
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
    public function destroy(UserPost $post)
    {
        if ($post->usersPostSaved()->where("user_id","=",auth()->user()->id)->first()) {
            return $post->usersPostSaved()->where("user_id","=",auth()->user()->id)->first()->delete();
        }
        return response()->json("this post has been unsaved",402);
    }
}
