<?php

use App\Http\Controllers\Api\TeacherPanel\CountryListController;
use App\Http\Controllers\Api\TeacherPanel\FindCitiesController;
use App\Http\Controllers\Api\TeacherPanel\GroupController;
use App\Http\Controllers\Api\TeacherPanel\LocationController;
use App\Http\Controllers\Api\TeacherPanel\TourController;
use App\Http\Controllers\Api\TeacherPanel\UserAgreementController;
use App\Http\Controllers\Api\TeacherPanel\UserChangePasswordController;
use App\Http\Controllers\Api\TeacherPanel\UserController;
use App\Http\Controllers\Api\TeacherPanel\UserDocumentController;
use App\Http\Controllers\Api\TeacherPanel\UserEducationBackgroundController;
use App\Http\Controllers\Api\TeacherPanel\UserSocialMediaController;
use App\Http\Controllers\Api\TeacherPanel\UserTicketController;
use App\Http\Controllers\Api\TeacherPanel\UserTicketRecordController;
use App\Http\Controllers\Api\TeacherPanel\UserWorkExperienceController;
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

// Teacher panel
Route::middleware('auth:sanctum')->name("api.web.v1.teacher-panel.")->group(function () {

    Route::get("user-info", [UserController::class, "userInfo"])->name("user-general-info");

    // Teacher Panel
    Route::prefix('account-info')->name("account-info.")->group(function () {

        Route::apiResource("details", UserController::class)->only(["index"]);
        Route::put("details", [UserController::class, "update"])->name("details.update");

        Route::apiResource("educational-background", UserEducationBackgroundController::class)->only(["index", "store", "update", "destroy"]);

        Route::apiResource("work-experience", UserWorkExperienceController::class)->only(["index", "store", "update", "destroy"]);

        Route::apiResource("documents", UserDocumentController::class)->only(["index", "store", "update", "destroy"]);

        Route::apiResource("agreements", UserAgreementController::class)->only(["index", "show", "update"]);

        Route::apiResource("social-media", UserSocialMediaController::class)->only("index");
        Route::put("social-media", [UserSocialMediaController::class, "update"])->name("social-media.update");

        Route::put("change-password", [UserChangePasswordController::class, "update"])->name("change-password");

    });

    //Route::post("account/contact-info/change-password", [APIUserUserController::class, "userChangePasswordUpdate"])->name("user.change-password.update");


    Route::apiResource("groups", GroupController::class)->only(["index"]);
    Route::apiResource("tours", TourController::class)->only(["index", "store", "show", "update"]);
    Route::apiResource("locations", LocationController::class)->only(["index"]);

//    Route::apiResource("activities", ActivityController::class)->only(["index"]);
//    Route::apiResource("invoices", InvoiceController::class)->only(["index", "show"]);
//    Route::apiResource("coupons", UserCouponController::class)->only(["index"]);

    Route::apiResource("country", CountryListController::class)->only("index");
    Route::get("country/{country:slug}", [FindCitiesController::class, "show"])->name("find.cities");

    // Ticket and sub ticket routes
    Route::apiResource("ticket", UserTicketController::class)->only(["index", "show", "store"]);
    Route::name("ticket.")->prefix("ticket")->group(function () {
        // Ticket Page
        Route::post("{ticket}/closing", [UserTicketController::class, "closeTicketByUser"])->name("closing.update");

        // Ticket Detail Page
        Route::apiResource("{ticket}/record", UserTicketRecordController::class)->only(["index", "store"]);
    });
});
