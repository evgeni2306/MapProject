<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/map', function () {
    return view('map');
})->name('map');
Route::get('/login', function () {
    return view('login');
})->name('login');


Route::get('/registration', function () {
    return view('registration');
})->name('registration');

Route::get('/unauthorizedmap', function () {
    return view('unauthorizedmap');
})->name('unauthorizedmap');

Route::get('/editpoints', function () {
    return view('editpoints');
})->name('editpoints');

Route::get('/settings', function () {
    return view('settings');
})->name('settings');

Route::get('/pointpersonal', function () {
    return view('pointpersonal');
})->name('pointpersonal');

Route::get('/profile', function () {
    return view('profile');
})->name('profile');

Route::get('/routepersonal', function () {
    return view('routepersonal');
})->name('routepersonal');

Route::get('/loadroute', function () {
    return view('loadroute');
})->name('loadroute');

Route::get('/editroutes', function () {
    return view('editroutes');
})->name('editroutes');

Route::get('/addroute', function () {
    return view('addroute');
})->name('addroute');

Route::get('/select', function () {
    return view('select');
})->name('select');