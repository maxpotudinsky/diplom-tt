<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'phone' => '89442555578',
            'company_id' => 1,
            'password' => Hash::make('adminadmin'),
        ]);

        DB::table('users')->insert([
            'name' => 'Максим П.',
            'email' => 'Max@Max.com',
            'phone' => '89452888578',
            'company_id' => 1,
            'password' => Hash::make('adminadmin'),
        ]);

        DB::table('users')->insert([
            'name' => 'Sergey',
            'email' => 'Sergey@Sergey.com',
            'phone' => '89662868520',
            'company_id' => 2,
            'password' => Hash::make('adminadmin'),
        ]);

        DB::table('users')->insert([
            'name' => 'Andrey',
            'email' => 'Andrey@Andrey.com',
            'phone' => '89588688578',
            'company_id' => 2,
            'password' => Hash::make('adminadmin'),
        ]);

//        factory(App\User::class, 10)->create();
    }
}
