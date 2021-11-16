<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SocialController;
session_start();
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
    return view('welcome');
});



    Route::view('/private','private')->middleware('auth')->name('private');

    Route::get('/login', function () {
        if (Auth::check()){
            return redirect(route('private'));
        }
        return view('login');
    })->name('login');

    Route::post('/login',[LoginController::class,'login']);


    Route::get('/logout',function (){
        session_destroy();
        Auth::logout();
        return redirect('/login');
    });

    Route::get('/registration', function () {
        if (Auth::check()){
            return redirect(route('private'));
        }
        return view('registration');
    })->name('registration');

    Route::post('/registration',[RegisterController::class,'save']);

    Route::get('/auth/google',[SocialController::class,'googleRedirect'])->name('auth.google');
    Route::get('/auth/google/callback',[SocialController::class,'loginWithGoogle']);

    Route::get('/auth/vk',[SocialController::class,'vkRedirect'])->name('auth.vk');
    Route::get('/auth/vk/callback',[SocialController::class,'loginWithVk']);

