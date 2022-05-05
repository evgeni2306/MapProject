<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AddPointController;
use App\Http\Controllers\AddRouteController;
use App\Http\Controllers\AddPcommentController;
use App\Http\Controllers\PointPageController;
use App\Http\Controllers\RoutePageController;
use App\Http\Controllers\GetAllController;
use App\Http\Controllers\SocialController;
use App\Http\Controllers\UpdateUserController;
use App\Http\Controllers\UpdatePointController;
use App\Http\Controllers\GetProfileController;
use App\Http\Controllers\UploadRouteController;
use App\Http\Controllers\AddRcommentController;
use App\Classes\RoutePageClass;


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


//Роуты для авторизованных
Route::middleware('auth')->group(function () {

    //---связанные с юзером---//
    Route::get('/profile', [GetProfileController::class, 'GetMyProfile'])->name('myprofile');
    Route::get('/edit', function () {
        return view('settings');
    })->name('edit');
    Route::post('/edit', [UpdateUserController::class, 'UpdateUser'])->name('PageEditor');
    Route::get('/logout', function () {
        session_destroy();
        Auth::logout();
        return redirect('/map');
    })->name('logout');
    //-------------------------//



    //---связанные с маршрутами---//
    Route::get('/loadroute', function () {
        return view('loadroute');
    })->name('loadroute');
    Route::post('/loadroute', [UploadRouteController::class, 'UploadRoute'])->name('loadroute');

    Route::get('/editroute', function () {
        return view('editroutes');
    })->name('editroute');

//    Route::get('/editroute={idd}', [)->name();
//    Route::post('/editroute={idd}', [])->name();

    Route::post('/Addrouteredir', [AddRouteController::class, 'Redirect'])->name('Addrouteredir');//редирект на страницу добавления
    Route::post('/Addroute', [AddRouteController::class, 'AddRoute'])->name('Addroute');//добавление
    Route::post('/addRcomment', [AddRcommentController::class, 'AddRcomment'])->name('AddRcomment');
    //----------------------------//


    //---связанные с точкой---//
    Route::post('/Addpoint', [AddPointController::class, 'AddPoint'])->name('AddPoint');
    Route::get('/editpoint={idd}', [UpdatePointController::class, 'GetUpdatePoint'])->name('GetUpdatePoint');
    Route::post('/editpoint={idd}', [UpdatePointController::class, 'UpdatePoint'])->name('UpdatePoint');
    Route::post('/addPcomment', [AddPcommentController::class, 'AddPcomment'])->name('AddPcomment');
    //------------------------//
});


//Роуты для неавторизованных
Route::get('/registration', function () {
    if (Auth::check()) {
        return redirect('/map');
    }
    return view('registration');

})->name('registration');
Route::post('/registration', [RegisterController::class, 'save'])->name('registration');

Route::get('/login', function () {
    if (Auth::check()) {
        return redirect('/map');
    }
    return view('login');
})->name('login');
Route::post('/login', [LoginController::class, 'login']);

Route::get('auth/google', [SocialController::class, 'googleredirect'])->name('google');
Route::get('auth/google/callback', [SocialController::class, 'loginwithgoogle']);
Route::get('auth/vkontakte', [SocialController::class, 'vkontakteredirect'])->name('vkontakte');
Route::get('auth/vkontakte/callback', [SocialController::class, 'loginwithvkontakte']);


//Роуты для всех юзеров
Route::get('/point={idd}', [PointPageController::class, 'GetCurrentPoint'])->name('getpointpage');
Route::get('/route={idd}', [RoutePageController::class, 'GetCurrentRoute'])->name('getroutepage');

Route::get('/map', [GetAllController::class, 'GetAll'])->name('map');


Route::fallback(function () {
    return redirect(route('map'));
});





