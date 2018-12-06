<?php


Route::group([
    'namespace' => 'App\Api\Controllers',
    'middleware' => ['api']
], function () {
    Route::post('/auth/login', 'AuthController@login');
    Route::post('/auth/logout', 'AuthController@logout');
    Route::post('/auth/refresh', 'AuthController@refresh');

    Route::group([
        'middleware'=>['auth:api']
    ],function(){
        Route::post('api/attestation','SchoolAttController@attestation');
        Route::post('api/company','CompanyController@store');
    });
});