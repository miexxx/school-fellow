<?php

Admin::registerAdminRoutes();

Route::group([
    'namespace' => 'App\Admin\Controllers',
    'prefix' => 'admin',
    'as' => 'admin::',
    'middleware' => ['web', 'admin']
], function () {
    Route::get('/', 'HomeController@index')->name('main');

    Route::group([
        'namespace'=>'User'
    ],function(){
        Route::resource('members','UserController');
    });

    Route::group([
        'namespace'=>'UserSchool'
    ],function(){
        Route::resource('userSchools','UserSchoolController');
    });


});