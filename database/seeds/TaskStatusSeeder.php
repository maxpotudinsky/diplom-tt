<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TaskStatusSeeder extends Seeder
{
    public function run()
    {
        DB::table('task_status')->insert([
            'name' => 'Бэклог',
            'code' => Str::random(50),
        ]);

        DB::table('task_status')->insert([
            'name' => 'В работе',
            'code' => Str::random(50),
        ]);

        DB::table('task_status')->insert([
            'name' => 'Проверка',
            'code' => Str::random(50),
        ]);

        DB::table('task_status')->insert([
            'name' => 'Готово',
            'code' => Str::random(50),
        ]);

        DB::table('task_status')->insert([
            'name' => 'Архив',
            'code' => Str::random(50),
        ]);
    }
}
