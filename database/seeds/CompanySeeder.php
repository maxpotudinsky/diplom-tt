<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CompanySeeder extends Seeder
{
    public function run()
    {
        for ($i = 0; $i < 5; $i++) {
            DB::table('companies')->insert([
                'name' => Str::random(10),
                'code' => Str::random(50),
            ]);
        }
    }
}
