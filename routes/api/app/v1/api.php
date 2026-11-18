<?php

use App\Http\Controllers\Api\UserFollowController;
use App\Http\Controllers\Application\LoginController;
use App\Http\Controllers\Application\SignUpController;
use App\Http\Controllers\Application\v1\ClientApp\CommentPostController;
use App\Http\Controllers\Application\v1\ClientApp\CouponsController;
use App\Http\Controllers\Application\v1\ClientApp\ExploreController;
use App\Http\Controllers\Application\v1\ClientApp\FirebaseTokenController;
use App\Http\Controllers\Application\v1\ClientApp\FollowerListController;
use App\Http\Controllers\Application\v1\ClientApp\FollowingListController;
use App\Http\Controllers\Application\v1\ClientApp\InvoicesController;
use App\Http\Controllers\Application\v1\ClientApp\LikeCommentController;
use App\Http\Controllers\Application\v1\ClientApp\LikeCommentRepliesController;
use App\Http\Controllers\Application\v1\ClientApp\PostDetailsController;
use App\Http\Controllers\Application\v1\ClientApp\PostSaveController;
use App\Http\Controllers\Application\v1\ClientApp\PostsPageController;
use App\Http\Controllers\Application\v1\ClientApp\ProfileController;
use App\Http\Controllers\Application\v1\ClientApp\ProfileInfoController;
use App\Http\Controllers\Application\v1\ClientApp\ProfilePostController;
use App\Http\Controllers\Application\v1\ClientApp\ReplyCommentPost;
use App\Http\Controllers\Application\v1\ClientApp\SearchController;
use App\Http\Controllers\Application\v1\ClientApp\ShowUsersProfileController;
use App\Http\Controllers\Application\v1\ClientApp\ShowUsersProfileInfoController;
use App\Http\Controllers\Application\v1\ClientApp\ShowUsersProfilePostController;
use App\Http\Controllers\Application\v1\ClientApp\TicketRecordsController;
use App\Http\Controllers\Application\v1\ClientApp\TicketsController;
use App\Http\Controllers\Application\v1\ClientApp\TourController;
use App\Http\Controllers\Application\v1\ClientApp\UserPostLikeController;
use App\Http\Controllers\Application\v1\ClientApp\UserSavedPostController;
use App\Http\Controllers\Application\v1\TestController;
use http\Client\Request;
use Illuminate\Support\Facades\Route;

Route::name("api.app.v1.")->middleware("api")->group(function () {

    Route::post("test", function(Request $request) {
        dd("test route");
    });

    Route::post("login", [LoginController::class, "login"]);

    Route::post("sign-up", [SignUpController::class, "create"]);

    Route::get("error/400",function (){
        return response()->json("Bad request", 400);
    });
    Route::get("error/401",function (){
        return response()->json("Unauthorised", 401);
    });
    Route::get("error/403",function (){
        return response()->json("Forbidden", 403);
    });
    Route::get("error/404",function (){
        return response()->json("Not Found", 404);
    });
    Route::get("error/405",function (){
        return response()->json("Request Timeout", 405);
    });
    Route::get("error/413",function (){
        return response()->json("Request Entity Too Large", 413);
    });
    Route::get("error/422",function (){
        return response()->json("Bad Response", 422);
    });
    Route::get("error/429",function (){
        return response()->json("Too Many Requests", 429);
    });
    Route::get("error/431",function (){
        return response()->json("Request Header Fields Too Large", 431);
    });
    Route::get("error/500",function (){
        return response()->json("Internal Server Error", 500);
    });
    Route::post("file-upload",[TourController::class, "uploadFileToCloud"])->middleware('auth:sanctum');

    Route::get('/example', function (Illuminate\Http\Request $request) {
        // You can now use the $request object here
        return $request;
    });

    // Authenticated routes
    Route::middleware('auth:sanctum')->group(static function() {
        Route::post("logout", [LoginController::class, "logout"]);
        Route::get("get", [TestController::class,"index"])->name("amin");
        Route::get("user-profile/{user}",[ShowUsersProfileController::class, "show"]);
        Route::get("user-profile/info/{user}",[ShowUsersProfileInfoController::class, "show"]);
        Route::get("user-profile/post/{user}",[ShowUsersProfilePostController::class, "show"]);
        Route::get("user",[ProfileController::class, "show"])->name("show");
        Route::get("user-info",[ProfileInfoController::class, "show"])->name("show");
        Route::get("user-post",[ProfilePostController::class, "show"])->name("show");
        Route::get("post/{post}",[PostDetailsController::class, "show"])->name("post_detail");
        Route::apiResource("tour",TourController::class)->only(["index", "show"]);
        Route::get("tickets",[TicketsController::class, "index"]);
        Route::get("ticket/{ticket}",[TicketRecordsController::class, "index"]);
        Route::get("invoice",[InvoicesController::class, "index"])->name("index");
        Route::get("follower-list/{user:slug}",[FollowerListController::class, "show"]);
        Route::get("following-list/{user:slug}",[FollowingListController::class, "show"]);
        Route::get("coupons",[CouponsController::class, "index"])->name("index");
        Route::get("feed",[PostsPageController::class, "index"])->name("index");
        Route::get("explore",[ExploreController::class, "index"])->name("index");
        Route::get("search",[SearchController::class, "index"])->name("index");
        Route::post("post/{post}/like", [UserPostLikeController::class, "store"]);
        Route::delete("post/{post}/dislike", [UserPostLikeController::class, "destroy"]);
        Route::post('profile/{user:slug}/follow', [UserFollowController::class, "store"]);
        Route::delete('profile/{user:slug}/unfollow', [UserFollowController::class, "destroy"]);
        Route::post('firebase-token', [FirebaseTokenController::class, "update"]);
        Route::post('comment-post/{post:id}', [CommentPostController::class, "store"]);
        Route::post('reply-comment/{comment:id}', [ReplyCommentPost::class, "store"]);
        Route::post('like-comment/{comment:id}',[LikeCommentController::class, "store"]);
        Route::delete('dislike-comment/{comment:id}',[LikeCommentController::class, "destroy"]);
        Route::post('like-replies/{commentReply:id}', [LikeCommentRepliesController::class, "store"]);
        Route::delete('dis-like-replies/{commentReply:id}', [LikeCommentRepliesController::class, "destroy"]);
        Route::post("post-saved/{post:id}",[PostSaveController::class, "store"]);
        Route::delete("post-unsaved/{post:id}",[PostSaveController::class, "destroy"]);
        Route::get("saved-posts",[UserSavedPostController::class, "index"])->name("index");


    });
});
