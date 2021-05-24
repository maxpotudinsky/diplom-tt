<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class RoleSeeder extends Seeder
{
    public function run()
    {
        DB::table('roles')->insert([
            'name' => 'Постановщик',
            'code' => Str::random(50),
        ]);

        DB::table('roles')->insert([
            'name' => 'Исполнитель',
            'code' => Str::random(50),
        ]);

        DB::table('roles')->insert([
            'name' => 'Заказчик',
            'code' => Str::random(50),
        ]);
    }
}
