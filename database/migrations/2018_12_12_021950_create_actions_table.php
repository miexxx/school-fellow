<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('actions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->unsignedInteger('type');
            $table->unsignedInteger('user_id');
            $table->string('pay');
            $table->string('province');
            $table->string('city');
            $table->string('adr_detail');
            $table->text('content');
            $table->unsignedInteger('status')->default(1);
            $table->timestamp('begin_time')->nullable();
            $table->timestamp('over_time')->nullable();
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
        Schema::dropIfExists('actions');
    }
}
