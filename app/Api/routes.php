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
        //用户公司管理
        Route::post('api/company','CompanyController@store');
        Route::get('api/company','CompanyController@index');
        //用户名片管理
        Route::post('api/userInfo','UserController@store');
        Route::get('api/userInfo','UserController@index');
        //用户简历管理
        Route::post('api/resume','ResumeController@baseInfo');
        Route::get('api/resume','ResumeController@showBaseInfo');
        Route::post('api/resume/wish','ResumeController@wishInfo');
        Route::get('api/resume/wish','ResumeController@showWishInfo');
        Route::post('api/resume/work','ResumeController@workInfo');
        Route::get('api/resume/work','ResumeController@showWorkInfo');
        Route::get('api/resume/detail','ResumeController@index');
    });
});