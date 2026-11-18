<?php

namespace App\Http\Controllers\Application\v1\ClientApp;

use App\Http\Controllers\Controller;
use App\Http\Resources\Application\v1\ClientApp\PostDetailsResource;
use App\Http\Resources\Application\v1\ClientApp\PostsPageResource;
use App\Models\User;
use Illuminate\Http\Request;

class PostsPageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        $followingUsers = auth()->user()->following()->with("userPosts")->get();
        $posts = $followingUsers->map(function (User $author) {
            $posts = $author->userPosts;

            // Preserve the original per-author query for ties in its created_at sort.
            $timestamps = $posts->countBy(fn ($post) => $post->getRawOriginal('created_at'));

            return $timestamps->count() < $posts->count() ? $author->userPosts()->get() : $posts;
        })->flatten();
        return PostDetailsResource::collection($posts);
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
    public function destroy($id)
    {
        //
    }
}
