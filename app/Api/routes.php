<?php


Route::group([
    'namespace' => 'App\Api\Controllers',
    'middleware' => ['api']
], function () {
    Route::post('/auth/login', 'AuthController@login');
    Route::post('/auth/logout', 'AuthController@logout');
    Route::post('/auth/refresh', 'AuthController@refresh');
});