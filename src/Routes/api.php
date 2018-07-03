<?php
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['prefix' => 'api', 'middleware' => 'api', 'namespace' => 'Laracore\Core\App\Http\Controllers\Api', 'as' => 'api.'], function () {
    Route::post('upload', ['as' => 'upload', 'uses' => 'UploadController@index']);
});
