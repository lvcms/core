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
/*
|--------------------------------------------------------------------------
| lvcms 各个模块绑定 vue
|--------------------------------------------------------------------------
*/
Route::group(['middleware' => 'web'], function () {
    Route::get('/{package}/{vue_capture?}', function ($package) {
        return view('core::index', [ 'package' => $package ]);
    })->where(['vue_capture' => '[\/\w\.-]*']);
});
