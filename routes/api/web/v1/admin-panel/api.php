<?php

use App\Http\Controllers\Api\AdminPanel\AgreementController;
use App\Http\Controllers\Api\AdminPanel\GroupController;
use App\Http\Controllers\Api\AdminPanel\InvoiceController;
use App\Http\Controllers\Api\AdminPanel\PaymentController;
use App\Http\Controllers\Api\AdminPanel\TicketController;
use App\Http\Controllers\Api\AdminPanel\TicketRecordController;
use App\Http\Controllers\Api\AdminPanel\UserController;
use App\Http\Controllers\Api\AdminPanel\UserDocumentController;
use App\Http\Controllers\Api\AdminPanel\TourController;
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
//َAdmin
Route::middleware(['auth:sanctum', 'panel.role:admin'])->name("api.web.v1.admin-panel.")->group(function () {

    Route::get("user-info", [UserController::class, "userInfo"])->name("user-general-info");


    // Tickets
    Route::apiResource("tickets", TicketController::class)->only(["store", "show", "update"]);
    Route::apiResource("tickets/{ticket:id}/record", TicketRecordController::class)->only(["index", "store"]);
    Route::post("tickets/{ticket}/assign-me", [TicketController::class, "assignMe"])->name("ticket.assignMe");

    Route::prefix("ticket")->name("ticket.")->group(function () {
        Route::get("open", [TicketController::class, "open"])->name("open");
        Route::post("{ticket}/closing", [TicketController::class, "closeTicket"])->name("closing.update");

        Route::get("archived", [TicketController::class, "archived"])->name("archived");
        Route::post("search", [TicketController::class, "search"])->name("search");
        Route::get("unassigned", [TicketController::class, "unassigned"])->name("unassigned");
        //Route::post("search", function () {})->name("search");
    });

    // Payments
    Route::prefix("payment")->name("payment.")->group(function () {
        Route::apiResource("", PaymentController::class)->only(["index", "update"]);
    });

    // Invoices
    Route::prefix("invoice")->name("invoice.")->group(function () {
        Route::apiResource("", InvoiceController::class)->only(["index", "update"]);
    });

    // Tours
    Route::prefix("tour")->name("tour.")->group(function () {
        Route::apiResource("", TourController::class)->only(["index", "update"]);
    });

    // Groups
    Route::prefix("group")->name("group.")->group(function () {
        Route::apiResource("", GroupController::class)->only(["index", "update"]);
        Route::get("archived", [GroupController::class, "archived"])->name("archived");
    });

    // Agreements
    Route::prefix("agreement")->name("agreement.")->group(function () {
        Route::apiResource("agreement", AgreementController::class)->only(["index", "store", "show", "update"]);
    });

    // Verification
    Route::prefix("verification")->name("verification.")->group(function () {
        Route::apiResource("document", UserDocumentController::class)->only(["index", "update"]);
    });

});
