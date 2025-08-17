<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Web\StoreUserPostRequest;
use App\Http\Requests\Api\Web\UpdateUserPostRequest;
use App\Models\Image;
use App\Models\User;
use App\Models\UserPost;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;

class UserPostController extends Controller
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
     * @param StoreUserPostRequest $request
     * @return RedirectResponse
     */
    public function store(User $user, StoreUserPostRequest $request)
    {
        $userPost = new UserPost($request->validated());
        $userPost->user()->associate($user);
        $userPost->save();

        $imageName = time() . '.' . $request->validated("image")->extension();
        $request->image->storeAs('/public/posts/', $imageName);
        $imageObj = new Image([
            "url"           =>  $imageName,
            "image_type"    =>  "content",
            "alt"           =>  $userPost->location . " " . $user->fname . " " . $user->lname
        ]);
        $userPost->images()->save($imageObj);

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param UserPost $userPost
     * @return Response
     */
    public function show(UserPost $userPost)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param UserPost $userPost
     * @return Response
     */
    public function edit(UserPost $userPost)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\Api\UserPanel\UpdateUserPostRequest $request
     * @param UserPost $userPost
     * @return Response
     */
    public function update(UpdateUserPostRequest $request, UserPost $userPost)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param UserPost $userPost
     * @return Response
     */
    public function destroy(UserPost $userPost)
    {
        //
    }
}
