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
| laracore 各个模块绑定 vue
|--------------------------------------------------------------------------
*/
Route::group(['middleware' => 'web'], function () {
    Route::get('/{model}/{vue_capture?}', function ($model) {
        return view('core::index', [ 'model' => $model ]);
    })->where('vue_capture', '[\/\w\.-]*');
});
