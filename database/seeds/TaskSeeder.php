<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class TaskSeeder extends Seeder
{
    public function run()
    {
        DB::table('tasks')->insert([
            'name' => 'Создание списка задач в виде канбан',
            'text' => 'Задача организации, в особенности же сложившаяся структура организации представляет собой интересный эксперимент проверки новых предложений.',
            'time' => 1,
            'fact_time' => 1,
            'price' => 1,
            'limit' => 1,
            'importance' => 100,
            'status_id' => 2,
            'project_id' => 1,
            'company_id' => 1,
            'created_at' => Carbon::now(),
        ]);

        DB::table('tasks')->insert([
            'name' => 'Реализовать переключение вида задач',
            'text' => 'Таким образом начало повседневной работы по формированию позиции способствует подготовки и реализации форм развития.',
            'time' => 1,
            'fact_time' => 1,
            'price' => 1,
            'limit' => 1,
            'importance' => 100,
            'project_id' => 1,
            'company_id' => 1,
            'created_at' => Carbon::now(),
        ]);

        DB::table('tasks')->insert([
            'name' => 'Копирование и установка акции счастливый час',
            'text' => 'Равным образом укрепление и развитие структуры в значительной степени обуславливает создание новых предложений.',
            'time' => 1,
            'fact_time' => 1,
            'price' => 1,
            'limit' => 1,
            'importance' => 90,
            'status_id' => 4,
            'project_id' => 2,
            'company_id' => 1,
            'created_at' => Carbon::now(),
        ]);

        DB::table('tasks')->insert([
            'name' => 'Установка акции счастливый 2020',
            'text' => 'Не следует, однако забывать, что начало повседневной работы по формированию позиции способствует подготовки и реализации существенных финансовых и административных условий.',
            'time' => 1,
            'fact_time' => 1,
            'price' => 1,
            'limit' => 1,
            'importance' => 80,
            'status_id' => 4,
            'project_id' => 2,
            'company_id' => 1,
            'created_at' => Carbon::now(),
        ]);

        DB::table('tasks')->insert([
            'name' => 'Не меняются баннеры в приложении',
            'text' => 'Значимость этих проблем настолько очевидна, что сложившаяся структура организации способствует подготовки и реализации позиций, занимаемых участниками в отношении поставленных задач.',
            'time' => 1,
            'fact_time' => 1,
            'price' => 1,
            'limit' => 1,
            'importance' => 70,
            'status_id' => 3,
            'project_id' => 3,
            'company_id' => 1,
            'created_at' => Carbon::now(),
        ]);
    }
}
