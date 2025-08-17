<?php

use App\Http\Controllers\Api\AgentPanel\AgentController;
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

// Agent panel
Route::middleware('auth:sanctum')->name("api.web.v1.agent-panel.")->group(function () {
    Route::get("agent-info",[AgentController::class,"userInfo"])->name("agent-info");
    Route::get("agent-info-header",[AgentController::class,"index"])->name("agent-info-header");
});
