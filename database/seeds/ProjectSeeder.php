<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProjectSeeder extends Seeder
{
    public function run()
    {
        DB::table('projects')->insert([
            'name' => 'Таск Трекер',
            'budget' => 100,
            'text' => 'Разработка сайта Таск Трекер',
            'code' => Str::random(50),
            'company_id' => 1,
        ]);

        DB::table('projects')->insert([
            'name' => 'ХТК',
            'budget' => 75000,
            'text' => 'Разработка сайта ХТК',
            'code' => Str::random(50),
            'company_id' => 1,
        ]);

        DB::table('projects')->insert([
            'name' => 'Серебряный шар (приложение)',
            'budget' => 70000,
            'text' => 'Разработка приложения Серебряный шар',
            'code' => Str::random(50),
            'company_id' => 1,
        ]);
    }
}
