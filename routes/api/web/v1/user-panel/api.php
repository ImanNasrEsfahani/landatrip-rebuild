<?php

use App\Http\Controllers\Api\BookingController;
use App\Http\Controllers\Api\UserPanel\ConversationController;
use App\Http\Controllers\Api\UserPanel\CountryListController;
use App\Http\Controllers\Api\UserPanel\FindCitiesController;
use App\Http\Controllers\Api\UserPanel\ActivityController;
use App\Http\Controllers\Api\APIFileUploadController;
use App\Http\Controllers\Api\UserPanel\GroupController;
use App\Http\Controllers\Api\UserPanel\InvoiceController;
use App\Http\Controllers\Api\UserPanel\UserAgreementController;
use App\Http\Controllers\Api\UserPanel\UserCertificateController;
use App\Http\Controllers\Api\UserPanel\UserController;
use App\Http\Controllers\Api\UserPanel\UserCouponController;
use App\Http\Controllers\Api\UserPanel\UserDocumentController;
use App\Http\Controllers\Api\UserPanel\UserEducationBackgroundController;
use App\Http\Controllers\Api\UserPanel\UserImageProfileController;
use App\Http\Controllers\Api\UserPanel\UserImageProfileTemporaryController;
use App\Http\Controllers\Api\UserPanel\UserPrivacyController;
use App\Http\Controllers\Api\UserPanel\UserSocialMediaController;
use App\Http\Controllers\Api\UserPanel\UserTicketController;
use App\Http\Controllers\Api\UserPanel\UserTicketRecordController;
use App\Http\Controllers\Api\UserPanel\UserWorkExperienceController;
use App\Http\Controllers\BadgeController;
use App\Actions\Fortify\UpdateUserPassword;
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
//User
Route::middleware(['auth:sanctum', 'panel.role:user'])->name("api.web.v1.user-panel.")->group(function () {

    Route::get("user-info", [UserController::class, "userInfo"])->name("user-general-info");

    // Account Info
    Route::prefix('account-info')->name("account-info.")->group(function () {

        Route::apiResource("details", UserController::class)->only(["index"]);
        Route::apiResource('profile-image', UserImageProfileController::class)->only("store","destroy");

        Route::put("details", [UserController::class, "update"])->name("details-update");

        Route::apiResource("educational-background", UserEducationBackgroundController::class)->only(["index", "store", "update", "destroy","show"]);

        Route::apiResource("work-experience", UserWorkExperienceController::class)->only(["index", "store", "update", "destroy" ,"show"]);

        Route::apiResource("documents", UserDocumentController::class)->only(["index", "store", "update", "destroy"]);

        Route::apiResource("agreements", UserAgreementController::class)->only(["index", "show", "update"]);

        Route::put("change-password/{user:slug}", [UpdateUserPassword::class, "update"])->name("change-password");

        Route::apiResource("social-media", UserSocialMediaController::class)->only(["index", "store", "update", "destroy"]);

        Route::apiResource("user-privacy", UserPrivacyController::class)->only(["index","update" ]);

        Route::put("user-privacy",[UserPrivacyController::class,"update"])->name("update");

        Route::apiResource("country", CountryListController::class)->only("index");

        Route::get("country/{country:slug}", [FindCitiesController::class, "show"])->name("find.cities");
    });
    Route::apiResource("conversation" , ConversationController::class)->only("index","store","show","update");

    Route::get("conversation/role/{role}",[ConversationController::class,"tabs"])->name("tabs");

    Route::post("search", [ConversationController::class, "search"])->name("search");

    Route::apiResource("badge" , BadgeController::class)->only(["index"]);

    Route::apiResource("groups", GroupController::class)->only(["index"]);

    Route::apiResource("activities", ActivityController::class)->only(["index"]);

    Route::apiResource("invoices", InvoiceController::class)->only(["index", "show"]);

    Route::apiResource("coupons", UserCouponController::class)->only(["index"]);

    Route::apiResource("certificate",UserCertificateController::class)->only("index");

    Route::apiResource("country", CountryListController::class)->only("index");

    Route::get("country/{country:slug}", [FindCitiesController::class, "show"])->name("find.cities");

    Route::post("book", [BookingController::class, 'originSearch'])->name("originSearch");

    // Ticket and sub ticket routes
    Route::apiResource("ticket", UserTicketController::class)->only(["index", "show", "store"]);
    Route::name("ticket.")->prefix("ticket")->group(function () {
        // Ticket Page
        Route::post("{ticket}/rating", [UserTicketController::class, "ratingTicketRatingStore"])->name("rating.update");
        Route::post("{ticket}/closing", [UserTicketController::class, "closeTicketByUser"])->name("closing.update");

        // Ticket Detail Page
        Route::apiResource("{ticket}/record", UserTicketRecordController::class)->only(["index", "store"]);
    });
    // Store in temporary files
    Route::apiResource("temporary-file",UserImageProfileTemporaryController::class)->only("store");
});
