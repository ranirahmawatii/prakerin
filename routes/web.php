<?php

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

Route::get('/about-us', function () {
    return view('frontend.about-us');
});

Route::get('/catagory', function () {
    return view('frontend.catagory');
});



Route::get('/single-post', function () {
    return view('frontend.single-post');
});



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/admin',function() {
    return view('layouts.back');
});

Route::resource('kategori', 'KategoriController');
Route::resource('tag', 'tagController');
Route::resource('artikel', 'artikelController');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
