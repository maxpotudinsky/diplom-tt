<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRolesTable extends Migration
{
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50);
            $table->boolean('is_active')->default(1);
            $table->string('code', 50);
        });
    }

    public function down()
    {
        Schema::dropIfExists('roles');
    }
}
