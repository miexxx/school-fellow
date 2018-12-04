<?php

Admin::registerAdminRoutes();

Route::group([
    'namespace' => 'App\Admin\Controllers',
    'prefix' => 'admin',
    'middleware' => ['web', 'admin']
], function () {
    Route::get('/', 'HomeController@index')->name('admin::main');
});