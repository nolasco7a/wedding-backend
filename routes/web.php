<?php

use App\Http\Controllers\EmailController;
use App\Http\Controllers\GiftController;
use App\Http\Controllers\GuestController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('admin/login');
});


Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
    Route::get("/guest resume", [GuestController::class, 'guestResume'])->name("guestResume");
    Route::get('/send_invitation/{id}', [EmailController::class, 'sendInvitation'])->name("sendInvitation");
    Route::get('/send_invitation_all', [EmailController::class, 'sendInvitationAll'])->name("sendInvitationAll");
    Route::get('/send_invitation_pending', [EmailController::class, 'sendPendingInvitations'])->name("sendPendingInvitations");
    Route::get('/gift resume', [GiftController::class, 'giftResume'])->name("giftResume");
});

Route::get('/confirm_invitation/{id}', [GuestController::class, 'confirmInvitation'])->name("confirmInvitation");
