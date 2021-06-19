<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTaskTimerTable extends Migration
{
    public function up()
    {
        Schema::create('task_timer', function (Blueprint $table) {
            $table->id();
            $table->integer('time');
            $table->foreignId('user_id');
            $table->foreignId('task_id');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('task_timer');
    }
}
