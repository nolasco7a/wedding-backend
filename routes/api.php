<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\ViewDataController;
use App\Http\Controllers\GiftController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\SquadController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

/* Get guests */
Route::get('/guests', [GuestController::class, 'getGuests']);

/* Get childrens of parents */
Route::get('/guests/children', [GuestController::class, 'getChildOfParents']);

/* Changue status of guest */
Route::post('/guests/change_status', [GuestController::class, 'changueStatusGuest']);

/* Get data views */
Route::get('/home_data', [ViewDataController::class, 'getHomeData']);

/* Get gifts list */
Route::get('/gifts', [GiftController::class, 'getGifts']);

/*  Pick gift */
Route::post('/gifts/pick', [GiftController::class, 'pickGift']);

/* Send invitations */
Route::post('/send_invitation', [EmailController::class, 'sendInvitation']);

/* test send email */
Route::get('/email', [EmailController::class, 'sendEmail']);

/* get images of carousel */
Route::get('/slider', [ViewDataController::class, 'getSlider']);

/* created new guest */
Route::post('create_guest', [GuestController::class, 'createNewGuests']);

/* get bride squad */
Route::get('/bride_squad', [SquadController::class, 'getBrideSquad']);

/* get groom squad */
Route::get('/groom_squad', [SquadController::class, 'getGroomSquad']);
