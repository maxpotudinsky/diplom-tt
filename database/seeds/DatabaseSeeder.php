<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
         $this->call(UserSeeder::class);
         $this->call(RoleSeeder::class);
         $this->call(ProjectSeeder::class);
         $this->call(TaskSeeder::class);
         $this->call(RoleTaskSeeder::class);
         $this->call(TaskStatusSeeder::class);
         $this->call(CompanySeeder::class);
    }
}
