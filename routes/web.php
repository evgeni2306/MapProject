<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
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
$_SESSION['MainX']= 56.838285;
$_SESSION['MainY'] = 60.603442;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/map', function () {
    return view('map');
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



