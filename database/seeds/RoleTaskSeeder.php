<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleTaskSeeder extends Seeder
{
    public function run()
    {
        DB::table('roles_tasks')->insert([
            'role_id' => 1,
            'task_id' => 1,
            'user_id' => 1,
        ]);

        DB::table('roles_tasks')->insert([
            'role_id' => 2,
            'task_id' => 1,
            'user_id' => 2,
        ]);

        DB::table('roles_tasks')->insert([
            'role_id' => 3,
            'task_id' => 1,
            'user_id' => 1,
        ]);

        DB::table('roles_tasks')->insert([
            'role_id' => 1,
            'task_id' => 2,
            'user_id' => 1,
        ]);

        DB::table('roles_tasks')->insert([
            'role_id' => 2,
            'task_id' => 2,
            'user_id' => 2,
        ]);

        DB::table('roles_tasks')->insert([
            'role_id' => 3,
            'task_id' => 2,
            'user_id' => 1,
        ]);

        DB::table('roles_tasks')->insert([
            'role_id' => 1,
            'task_id' => 3,
            'user_id' => 1,
        ]);

        DB::table('roles_tasks')->insert([
            'role_id' => 2,
            'task_id' => 3,
            'user_id' => 1,
        ]);

        DB::table('roles_tasks')->insert([
            'role_id' => 3,
            'task_id' => 3,
            'user_id' => 2,
        ]);

        DB::table('roles_tasks')->insert([
            'role_id' => 1,
            'task_id' => 4,
            'user_id' => 1,
        ]);

        DB::table('roles_tasks')->insert([
            'role_id' => 2,
            'task_id' => 4,
            'user_id' => 1,
        ]);

        DB::table('roles_tasks')->insert([
            'role_id' => 3,
            'task_id' => 4,
            'user_id' => 2,
        ]);

        DB::table('roles_tasks')->insert([
            'role_id' => 1,
            'task_id' => 5,
            'user_id' => 1,
        ]);

        DB::table('roles_tasks')->insert([
            'role_id' => 2,
            'task_id' => 5,
            'user_id' => 1,
        ]);

        DB::table('roles_tasks')->insert([
            'role_id' => 3,
            'task_id' => 5,
            'user_id' => 2,
        ]);
    }
}
