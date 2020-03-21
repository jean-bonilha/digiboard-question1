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

Route::resource('people','PersonController');

Route::post('image-upload', 'ImageUploadController@imageUploadPost')->name('image.upload.post');

Route::get('/recognize', 'RecognizeController@show');

Route::get('/models/{model}', 'RecognizeController@model');

Route::get('/weights/{weight}', 'RecognizeController@weight');

