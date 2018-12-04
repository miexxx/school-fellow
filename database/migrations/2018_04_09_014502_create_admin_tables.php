<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $connection = config('admin.database.connection') ?: config('database.default');

        Schema::connection($connection)->create(config('admin.database.administrator.table'), function (Blueprint $table) {
            $table->increments('id');
            $table->string('username', 190)->unique();
            $table->string('password', 60);
            $table->string('name');
            $table->string('avatar')->nullable();
            $table->string('remember_token', 100)->nullable();
            $table->unsignedTinyInteger('state')->default(1);
            $table->timestamps();
        });

        Schema::connection($connection)->create(config('admin.database.role.table'), function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 50)->unique();
            $table->string('slug', 50);
            $table->timestamps();
        });

        Schema::connection($connection)->create(config('admin.database.permission.table'), function (Blueprint $table) {
            $table->increments('id');
            $table->string('module', 50);
            $table->string('name', 50);
            $table->string('method');
            $table->string('uri');
            $table->string('action')->unique();
            $table->string('route_name', 50);
            $table->timestamps();
        });

        Schema::connection($connection)->create(config('admin.database.menu.table'), function (Blueprint $table) {
            $table->increments('id');
            $table->integer('parent_id')->default(0);
            $table->integer('order')->default(0);
            $table->string('title', 50);
            $table->string('icon', 50);
            $table->unsignedInteger('permission_id')->nullable();
            $table->string('uri', 50)->nullable();
            $table->timestamps();
        });

        Schema::connection($connection)->create(config('admin.database.role_user.table'), function (Blueprint $table) {
            $table->integer('role_id');
            $table->integer('user_id');
            $table->index(['role_id', 'user_id']);
            $table->timestamps();
        });

        Schema::connection($connection)->create(config('admin.database.role_permission.table'), function (Blueprint $table) {
            $table->integer('role_id');
            $table->integer('permission_id');
            $table->index(['role_id', 'permission_id']);
            $table->timestamps();
        });

        Schema::connection($connection)->create(config('admin.database.operation_log.table'), function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('path');
            $table->string('method', 10);
            $table->string('ip', 15);
            $table->text('input');
            $table->index('user_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $connection = config('admin.database.connection') ?: config('database.default');

        Schema::connection($connection)->dropIfExists(config('admin.database.administrator.table'));
        Schema::connection($connection)->dropIfExists(config('admin.database.role.table'));
        Schema::connection($connection)->dropIfExists(config('admin.database.permission.table'));
        Schema::connection($connection)->dropIfExists(config('admin.database.menu.table'));
        Schema::connection($connection)->dropIfExists(config('admin.database.role_user.table'));
        Schema::connection($connection)->dropIfExists(config('admin.database.role_permission.table'));
        Schema::connection($connection)->dropIfExists(config('admin.database.operation_log.table'));
    }
}
