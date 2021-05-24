<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasksTable extends Migration
{
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('name',50);
            $table->text('text');
            $table->integer('time');
            $table->integer('fact_time');
            $table->integer('price');
            $table->integer('limit');
            $table->integer('importance');
            $table->boolean('is_active')->default(1);
            $table->foreignId('status_id')->default(1);
            $table->foreignId('project_id');
            $table->foreignId('company_id');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tasks');
    }
}
