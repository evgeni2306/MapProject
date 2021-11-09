<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AddPointController;
use App\Http\Controllers\AddPcommentController;
use App\Http\Controllers\PointPageController;
use App\Http\Controllers\GetAllController;

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
   return redirect(route('map'));
});

Route::get('/registration', function () {
//    if (Auth::check()) {
//        return redirect(route('private'));
//    }
    return view('registration');
})->name('registration');

Route::post('/registration', [RegisterController::class, 'save'])->name('registration');

Route::get('/login', function () {
//    if (Auth::check()) {
//        return redirect(route('private'));
//    }
    return view('login');
})->name('login');
Route::post('/login', [LoginController::class, 'login']);


Route::get('/logout', function () {
    session_destroy();
    Auth::logout();
    return redirect('/map');
})->name('logout');


Route::get('/map', function () {
    return view('map');
})->name('map');
Route::post('/map', [AddPointController::class, 'AddPoint'])->name('AddPoint');
Route::get('/map', [GetAllController::class, 'GetPoints'])->name('map');

Route::get('/point={idd}', [PointPageController::class, 'GetCurrentPoint']);





Route::post('/addPcomment', [AddPcommentController::class, 'AddPcomment'])->name('AddPcomment');
Route::get('/mypage', function () {
    return view('mypage');
});
//Route::get('/map', function () {
//    return view('map');
//})->name('map');

Route::get('/entrance', function () {
    return view('entrance');
});

