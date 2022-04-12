<?php
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AddPointController;
use App\Http\Controllers\AddRouteController;
use App\Http\Controllers\AddPcommentController;
use App\Http\Controllers\PointPageController;
use App\Http\Controllers\GetAllController;
use App\Http\Controllers\SocialController;
use App\Http\Controllers\UpdateUserController;
use App\Http\Controllers\UpdatePointController;
use App\Http\Controllers\GetProfileController;
use App\Http\Controllers\UploadRouteController;


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

Route::get('/form', function () {
    return view('form');
})->name('form');
Route::post('/form', [UploadRouteController::class, 'Test'])->name('formput');

//Роуты для авторизованных
Route::middleware('auth')->group(function () {

    Route::get('/edit', function () {
        return view('settings');
    })->name('edit');
    Route::get('/profile', [GetProfileController::class, 'GetMyProfile'])->name('myprofile');

    Route::post('/map', [AddPointController::class, 'AddPoint'])->name('AddPoint');
    Route::post('/edit', [UpdateUserController::class, 'UpdateUser'])->name('PageEditor');
    Route::post('/addPcomment', [AddPcommentController::class, 'AddPcomment'])->name('AddPcomment');
    Route::get('/editpoint={idd}', [UpdatePointController::class, 'GetUpdatePoint'])->name('GetUpdatePoint');
    Route::post('/editpoint={idd}', [UpdatePointController::class, 'UpdatePoint'])->name('UpdatePoint');
    Route::post('/Route', [AddRouteController::class,'AddRoute'])->name('Addroute');
    Route::get('/logout', function () {
        session_destroy();
        Auth::logout();
        return redirect('/map');
    })->name('logout');

});
Route::get('/point={idd}', [PointPageController::class, 'GetCurrentPoint']);
//Роуты для неавторизованных
Route::get('/registration', function () {
    if(Auth::check()){
        return  redirect('/map');
    }
    return view('registration');

})->name('registration');
Route::post('/registration', [RegisterController::class, 'save'])->name('registration');
Route::get('/login', function () {
    if(Auth::check()){
        return  redirect('/map');
    }
    return view('login');
})->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::get('auth/google', [SocialController::class, 'googleredirect'])->name('google');
Route::get('auth/google/callback', [SocialController::class, 'loginwithgoogle']);
Route::get('auth/vkontakte', [SocialController::class, 'vkontakteredirect'])->name('vkontakte');
Route::get('auth/vkontakte/callback', [SocialController::class, 'loginwithvkontakte']);


//Роуты для всех юзеров
Route::get('/', function () {
    return redirect(route('map'));
});

Route::get('/map', [GetAllController::class, 'GetPoints'])->name('map');


Route::fallback(function(){
return redirect(route('map'));
});





