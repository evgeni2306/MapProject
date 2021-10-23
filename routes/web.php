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
});
Route::get('/login', function () {
    return view('login');
})->name('login');


Route::get('/registration', function () {
    return view('registration');
})->name('registration');

Route::get('/unauthorizedmap', function () {
    return view('unauthorizedmap');
});

