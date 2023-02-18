<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});





//Route::get('/login-google', [\App\Http\Controllers\SocialAuthController::class, 'redirectToProvider'])->name('google.login');

//Route::post('/auth/google/cabllback', [\App\Http\Controllers\SocialAuthController::class, 'handlecallback'])->name('google.fogin.callback');
//Route::middleware('auth')->group(function () {
//    Route::get('/home', [\App\Http\Controllers\SocialAuthController::class, 'index'])->name('home');
//
//});
Route::get('login/google', [\App\Http\Controllers\SocialAuthController::class, 'redirectToGoogle']);
Route::get('login/google/callback', [\App\Http\Controllers\SocialAuthController::class, 'handleGoogleCallback']);


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
