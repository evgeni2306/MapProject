<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AddPointController;
use App\Http\Controllers\AddPcommentController;
use App\Http\Controllers\PointPageController;
use App\Http\Controllers\GetAllController;
use App\Http\Controllers\UpdateUserController;
use App\Http\Controllers\SocialController;
use App\Http\Controllers\UpdatePointController;
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
//$_SESSION['MainX']= 56.838285;
//$_SESSION['MainY'] = 60.603442;
//$_SESSION['Points']=Point::all();

Route::get('/', function () {
    return view('test');
});

Route::get('/registration', function () {
    if (Auth::check()) {
        return redirect(route('map'));
    }
    return view('registration');
})->name('registration');

Route::post('/registration', [RegisterController::class, 'save']);

Route::get('/login', function () {
    if (Auth::check()) {
        return redirect(route('map'));
    }
    return view('login');
})->name('login');
Route::post('/login', [LoginController::class, 'login']);


Route::get('/logout', function () {
    session_destroy();
    Auth::logout();
    return redirect('/login');
});

Route::get('/test', function () {
    return view('test');
})->name('test');

Route::get('/map', function () {
    return view('map');
})->name('map');
Route::post('/map', [AddPointController::class, 'AddPoint'])->name('AddPoint');
Route::get('/map', [GetAllController::class, 'GetPoints'])->name('map');

Route::get('/point={idd}', [PointPageController::class, 'GetCurrentPoint']);

Route::post('/change/userinfo',[UpdateUserController::class,'UpdateUser']);
Route::get('/change/userinfo',[UpdateUserController::class,'GetUserFields'])->name('userinfo');

Route::get('auth/google',[SocialController::class,'googleredirect'])->name('google');
Route::get('auth/google/callback',[SocialController::class,'loginwithgoogle']);

Route::get('auth/vkontakte',[SocialController::class,'vkontakteredirect'])->name('vkontakte');
Route::get('auth/vkontakte/callback',[SocialController::class,'loginwithvkontakte']);

Route::post('/addPcomment', [AddPcommentController::class, 'AddPcomment'])->name('AddPcomment');

Route::get('/changepoint={id}',[UpdatePointController::class, 'GetPointInfo']);
Route::post('/changepoint={id}',[UpdatePointController::class, 'ChangePointInfo']);
