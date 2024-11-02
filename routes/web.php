<?php

namespace App\Http\Controllers\FileUploadController;
use Illuminate\Http\Request;
use App\Http\Controllers\FileUploadController;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\loginController;
use \App\Http\Controllers\AuthController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use \App\Http\Controllers\regisnController;
use \App\Http\Controllers\ProfileController;


Route::get('/', function () {
    return view('index');
})->name('index');

Route::post('/store', [FileUploadController::class, 'store'])->name('store');
Route::get('login/google', [LoginController::class, 'redirectToGoogle']);
Route::get('login/google/callback', [LoginController::class, 'handleGoogleCallback']);
Route::prefix('/profile')->group(function () {
    Route::get('/', [ProfileController::class, 'index'])->name('profile');
    Route::get('/{id}', [ProfileController::class, 'getFileByUserId'])->name('list-file');
});
Route::prefix('/login')->group(function () {
    Route::get('/', [loginController::class, 'index'])->name('login');
    Route::get('/regisn-new', [regisnController::class, 'regisn_new'])->name('direction-regisn');
    Route::post('/regisn', [regisnController::class, 'register'])->name('regisn');
    Route::post('/login', [loginController::class, 'login'])->name('login-auth');
   // Route::get('/regisnAuth', [AuthController::class, 'regisnAuth'])->name('regisnAuth');
});
Route::post('/logout', [loginController::class, 'logout'])->name('logout');
Route::get('/email/verify', function () {
    return view('verify-mail');
})->middleware('auth')->name('verification.notice');


Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
 
    return redirect('/');
})->middleware(['auth', 'signed'])->name('verification.verify');

 
Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
 
    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');