<?php

Admin::registerAdminRoutes();

Route::group([
    'namespace' => 'App\Admin\Controllers',
    'prefix' => 'admin',
    'as' => 'admin::',
    'middleware' => ['web', 'admin']
], function () {
    Route::get('/', 'HomeController@index')->name('main');
    Route::post('/upload_image', 'UploadController@uploadImage')->name('upload.upload_image');

    Route::group([
        'namespace'=>'User'
    ],function(){
        Route::resource('members','UserController');
    });

    Route::group([
        'namespace'=>'UserSchool'
    ],function(){
        Route::resource('userSchools','UserSchoolController');
        Route::post('userSchools/success/{userSchool}','UserSchoolController@success');
        Route::post('userSchools/reject/{userSchool}','UserSchoolController@reject');
    });

    Route::group([
        'namespace'=>'Action'
    ],function(){
        Route::resource('actions','ActionController');
        Route::post('actions/success/{action}','ActionController@success');
        Route::post('actions/reject/{action}','ActionController@reject');
    });

    Route::group([
        'namespace'=>'Base'
    ],function(){
        Route::get('base/index','BaseController@feedbackIndex')->name('feedbacks.index');
        Route::delete('base/index/{feedback}','BaseController@feedbackDestory')->name('feedbacks.destroy');
        Route::get('base/content/{feedback}','BaseController@feedbackContent')->name('feedbacks.content');
        Route::get('base/about/index','BaseController@about')->name('about.index');
        Route::post('base/about/store','BaseController@aboutStore')->name('about.store');
    });
});