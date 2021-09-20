<?php

use App\Http\Controllers\Auth\VerificationApiController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes(['verify' => true]);

//Route::get('profile', function () {
//    // Only verified users may enter...
//})->middleware('verified');

Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('email/resend', [VerificationApiController::class, 'resend'])->name('verificationapi.resend');
Route::get('email/verify/{id}', [VerificationApiController::class, 'verify'])->name('verificationapi.verify');
Route::get('/email/verify/{id}/{hash}', [VerificationApiController::class, 'verify'])
     ->middleware(['auth', 'signed'])->name('verification.verify');


Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

//Route::get('/profile', function () {
//    // This route can only be accessed by confirmed users...
//})->middleware('verified');
