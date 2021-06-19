<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRolesTasksTable extends Migration
{
    public function up()
    {
        Schema::create('roles_tasks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('role_id');
            $table->foreignId('task_id');
            $table->foreignId('user_id');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('roles_tasks');
    }
}
