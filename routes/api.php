<?php

use App\Http\Controllers\Api\APIFileUploadController;
use App\Http\Controllers\Api\PrivateDocumentDownloadController;
use App\Http\Controllers\Api\BookingController;
use App\Http\Controllers\Api\TestCheckoutController;
use App\Http\Controllers\Api\UserFollowController;
use App\Http\Controllers\Api\UserGroupPostController;
use App\Http\Controllers\Api\UserPostCommentLikeController;
use App\Http\Controllers\Api\UserPostCommentReplyLikeController;
use App\Http\Controllers\Api\UserPostLikeController;
use App\Http\Controllers\UserRatingController;
use App\Http\Controllers\Web\ActivityController;
use App\Http\Controllers\Web\BookingProcessApiController;
use App\Http\Controllers\Web\BookingProcessController;
use App\Http\Controllers\Web\GroupController;
use App\Http\Controllers\Web\GroupPostController;
use App\Http\Controllers\Web\GroupTutorController;
use App\Http\Controllers\Web\TourCardsController;
use App\Http\Controllers\Web\TourCommentLikeController;
use App\Http\Controllers\Web\TourCommentReplyController;
use App\Http\Controllers\Web\TourCommentReplyLikeController;
use App\Http\Controllers\Web\UserPostCommentController;
use App\Http\Controllers\Web\UserPostController;
use App\Models\Tour;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Api Routes
|--------------------------------------------------------------------------
|
| Here is where you can register Api routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your Api!
|
*/


Route::name("api.public.")->group(function () {

    // The service guard still applies if a route cache built locally is reused elsewhere.
    if (app()->environment(['local', 'testing'])) {
        Route::post('__e2e/checkout/callback', [TestCheckoutController::class, 'callback']);
        Route::middleware('auth:sanctum')->prefix('__e2e/checkout')->group(function () {
            Route::post('groups/{group}/quote', [TestCheckoutController::class, 'quote']);
            Route::post('groups/{group}/invoices', [TestCheckoutController::class, 'create']);
            Route::get('invoices/{invoice}', [TestCheckoutController::class, 'show']);
            Route::post('invoices/{invoice}/initiate', [TestCheckoutController::class, 'initiate']);
            Route::post('invoices/{invoice}/expire-for-test', [TestCheckoutController::class, 'expire']);
        });
    }

    Route::apiResource('card/tour',TourCardsController::class)->only('show');

    Route::get('tour/{tour:slug}/group/{group:slug}/step1', [BookingProcessController::class, "step1"])->name("step1");
    //Booking Process
    Route::prefix("booking")->group(function (){

        Route::apiResource("tour/{tour}/group", BookingProcessApiController::class)->only('show');
        Route::get("search", [BookingProcessApiController::class, "search"])->name("search");

    });



    Route::middleware('auth:sanctum')->group(function (){
        // Panels are in their folders
        // Please add only common api routes here.

        Route::get('mobile-uploads/{temporaryFile}/download', \App\Http\Controllers\Api\MobileUploadDownloadController::class)
            ->whereNumber('temporaryFile')->name('mobile-uploads.download');

        Route::get('ticket-attachments/{image}/download', \App\Http\Controllers\Api\TicketAttachmentDownloadController::class)
            ->name('ticket-attachments.download');

        Route::get('documents/{userDocument}/download', PrivateDocumentDownloadController::class)
            ->whereNumber('userDocument')
            ->middleware('can:downloadPrivate,userDocument')
            ->name('documents.download');

        Route::post('origin-search', [BookingController::class, 'originSearch'])->name("origin-search");

        Route::post('destination-search', [BookingController::class, 'destinationSearch'])->name("destination-search");

        Route::post('flight-booking', [BookingController::class, 'flightBooking'])->name("flight-booking");

        Route::post('flight-details', [BookingController::class, 'flightDetails'])->name("flight-details");

        Route::post("hotel-offers", [BookingController::class, 'hotelOffers'])->name("hotel-offers");

        Route::post("hotel-details", [BookingController::class, 'hotelDetails'])->name("hotel-details");

        // Tour Comment
        Route::post("tour/comment/{tourComment:id}/reply", [TourCommentReplyController::class, "store"])->name('TourCommentReply');
        Route::post('tour/comment/{tourComment:id}/like', [TourCommentLikeController::class, 'like'])->name('TourCommentLike');
        Route::post('tour/comment/{tourComment:id}/dislike', [TourCommentLikeController::class, 'dislike'])->name('TourCommentDislike');
        Route::post('tour/comment/reply/{tourCommentReply:id}/like', [TourCommentReplyLikeController::class, 'like'])->name('TourCommentReplyLike');
        Route::post('tour/comment/reply/{tourCommentReply:id}/dislike', [TourCommentReplyLikeController::class, 'dislike'])->name('TourCommentReplyDislike');

        Route::get("group/{group:slug}",[UserGroupPostController::class,"show"])->name("group-posts.show");
        Route::post("group/{group:slug}",[UserGroupPostController::class,"store"])->name("group-posts.store");
        Route::get("group/{group:slug}/tutor",[GroupTutorController::class,"index"])->name("group-tutor");
        Route::get("group/{group:slug}/user/{user}/rating",[UserRatingController::class,'index'])->name('group.user.rating.index');
        Route::post("group/{group:slug}/user/{user}/rating",[UserRatingController::class,'store'])->name('group.user.rating.store');


        Route::get("files/upload", [APIFileUploadController::class, "index"])->name("file-upload.load");
        Route::get("files/upload", [APIFileUploadController::class, "show"])->name("file-upload.restore");
        Route::post("files/upload/temp-store", [APIFileUploadController::class, "tempStore"])->name("file-upload.temp.process");
        //Route::post("files/upload", [APIFileUploadController::class, "store"])->name("file-upload.process");
        Route::delete("files/upload", [APIFileUploadController::class, "destroy"])->name("file-upload.revert");

        Route::post("user/{user}/post/{post}/like", [UserPostLikeController::class,"store"])->name("UserPostLike");
        Route::delete("user/{user}/post/{post}/like", [UserPostLikeController::class,"destroy"])->name("UserPostUnLike");

        Route::post("user/{user}/post/{post}/comment/{comment}/like",[UserPostCommentLikeController::class,"store"])->name("UserPostCommentLike");
        Route::delete("user/{user}/post/{post}/comment/{comment}/Unlike",[UserPostCommentLikeController::class,"destroy"])->name("UserPostCommentUnLike");

        Route::post("user/{user}/post/{post}/comment/{comment}/reply/{reply}/like",[UserPostCommentReplyLikeController::class,"store"])->name("UserPostCommentReplyLike");
        Route::delete("user/{user}/post/{post}/comment/{comment}/reply/{reply}/unlike",[UserPostCommentReplyLikeController::class,"destroy"])->name("UserPostCommentReplyUnLike");

        Route::post("user/{user}/follow", [UserFollowController::class,"store"])->name("UserFollow");
        Route::delete("user/{user}/unfollow", [UserFollowController::class,"destroy"])->name("UserUnfollow");

        Route::post("user/{user}/post/{post}/",[UserPostCommentController::class,"store"])->name("userPostComment");
        Route::post("user/{user}/post/",[UserPostController::class,"store"])->name("userNewPost");

        Route::post("user/{user}/header/",[APIFileUploadController::class,"header"])->name("userHaeder");
        Route::apiResource("temporary-file",APIFileUploadController::class)->only(["store", "destroy"]);

        //  Group
        Route::resource('group/{group:slug}/post', GroupPostController::class, ['as' => 'group'])->only('store');
    });

});



Route::get("activity/{activity:id}", [ActivityController::class, "update"])->name("update.activity.ip.response");


