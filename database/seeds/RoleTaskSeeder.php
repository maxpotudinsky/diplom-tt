<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleTaskSeeder extends Seeder
{
    public function run()
    {
        DB::table('roles_tasks')->insert([
            'user_id' => 1,
            'role_id' => 2,
            'task_id' => 1,
            'project_id' => 1,
            'company_id' => 1,
        ]);

        DB::table('roles_tasks')->insert([
            'user_id' => 2,
            'role_id' => 3,
            'task_id' => 1,
            'project_id' => 1,
            'company_id' => 1,
        ]);

        DB::table('roles_tasks')->insert([
            'user_id' => 1,
            'role_id' => 2,
            'task_id' => 2,
            'project_id' => 1,
            'company_id' => 1,
        ]);

        DB::table('roles_tasks')->insert([
            'user_id' => 2,
            'role_id' => 3,
            'task_id' => 2,
            'project_id' => 1,
            'company_id' => 1,
        ]);

        DB::table('roles_tasks')->insert([
            'user_id' => 1,
            'role_id' => 2,
            'task_id' => 3,
            'project_id' => 2,
            'company_id' => 1,
        ]);

        DB::table('roles_tasks')->insert([
            'user_id' => 2,
            'role_id' => 3,
            'task_id' => 3,
            'project_id' => 2,
            'company_id' => 1,
        ]);

        DB::table('roles_tasks')->insert([
            'user_id' => 1,
            'role_id' => 2,
            'task_id' => 4,
            'project_id' => 2,
            'company_id' => 1,
        ]);

        DB::table('roles_tasks')->insert([
            'user_id' => 2,
            'role_id' => 3,
            'task_id' => 4,
            'project_id' => 2,
            'company_id' => 1,
        ]);

        DB::table('roles_tasks')->insert([
            'user_id' => 1,
            'role_id' => 2,
            'task_id' => 5,
            'project_id' => 3,
            'company_id' => 1,
        ]);

        DB::table('roles_tasks')->insert([
            'user_id' => 2,
            'role_id' => 3,
            'task_id' => 5,
            'project_id' => 3,
            'company_id' => 1,
        ]);
    }
}
