<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResumeWorksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resume_works', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_resume_id');
            $table->string('name');
            $table->string('position');
            $table->string('begin_time');
            $table->string('leave_reason');
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
        Schema::dropIfExists('resume_works');
    }
}
