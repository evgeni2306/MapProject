<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AddPointController;
use App\Http\Controllers\AddRouteController;
use App\Http\Controllers\PcommentActionController;
use App\Http\Controllers\PointPageController;
use App\Http\Controllers\RoutePageController;
use App\Http\Controllers\GetMapController;
use App\Http\Controllers\SocialAuthController;
use App\Http\Controllers\UpdateUserController;
use App\Http\Controllers\UpdatePointController;
use App\Http\Controllers\GetProfileController;
use App\Http\Controllers\UploadRouteController;
use App\Http\Controllers\RcommentActionController;
use App\Http\Controllers\UpdateRouteController;
use App\Classes\RoutePageClass;

use Illuminate\Support\Facades\Artisan;


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

Route::get('/test', function () {
    return view('editroutes');
});
Artisan::call('storage:link');

//Роуты для авторизованных
Route::middleware('auth')->group(function () {

    //---связанные с юзером---//

    Route::get('/search', function () {
        return view('search');
    });
    Route::get('/edit', [UpdateUserController::class, 'GetSettingsPage'])->name('edit');
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

//    Route::get('/editroute', function () {
//        return view('editroutes');
//    })->name('editroute');

    Route::get('/editroute={idd}', [UpdateRouteController::class, 'GetUpdateRoute'])->name('GetUpdateRoute');
    Route::post('/editroute={idd}', [UpdateRouteController::class, 'UpdateRoute'])->name('UpdateRoute');
    Route::post('/Addrouteredir', [AddRouteController::class, 'Redirect'])->name('Addrouteredir');//редирект на страницу добавления
    Route::post('/Addroute', [AddRouteController::class, 'AddRoute'])->name('Addroute');//добавление
    Route::post('/addRcomment', [RcommentActionController::class, 'AddRcomment'])->name('AddRcomment');
    Route::get('/deleteRcomment={idd}', [RcommentActionController::class, 'DeleteRcomment'])->name('DeleteRcomment');
    Route::post('/updateRcomment', [RcommentActionController::class, 'UpdateRcomment'])->name('UpdateRcomment');
    //----------------------------//


    //---связанные с точкой---//
    Route::post('/Addpoint', [AddPointController::class, 'AddPoint'])->name('AddPoint');
    Route::get('/editpoint={idd}', [UpdatePointController::class, 'GetUpdatePoint'])->name('GetUpdatePoint');
    Route::post('/editpoint={idd}', [UpdatePointController::class, 'UpdatePoint'])->name('UpdatePoint');
    Route::get('/deletePcomment={idd}', [PcommentActionController::class, 'DeletePcomment'])->name('DeletePcomment');
    Route::post('/addPcomment', [PcommentActionController::class, 'AddPcomment'])->name('AddPcomment');
    Route::post('/updatePcomment', [PcommentActionController::class, 'UpdatePcomment'])->name('UpdatePcomment');
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


Route::get('auth/google', [SocialAuthController::class, 'googleredirect'])->name('google');
Route::get('auth/google/callback', [SocialAuthController::class, 'loginwithgoogle']);
Route::get('auth/vkontakte', [SocialAuthController::class, 'vkontakteredirect'])->name('vkontakte');
Route::get('auth/vkontakte/callback', [SocialAuthController::class, 'loginwithvkontakte']);


//Роуты для всех юзеров
Route::get('/profile={idd}', [GetProfileController::class, 'GetProfile'])->name('profile');
Route::get('/point={idd}', [PointPageController::class, 'GetCurrentPoint'])->name('getpointpage');
Route::get('/route={idd}', [RoutePageController::class, 'GetCurrentRoute'])->name('getroutepage');
Route::get('/DrawRoute={idd}', [GetMapController::class,'GetRouteToDraw'])->name('DrawRoute');
Route::get('/map', [GetMapController::class, 'GetAll'])->name('map');


Route::fallback(function () {
    return redirect(route('map'));
});





