<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            ProfileSeeder::class,
            MenuSeeder::class,
            RoleSeeder::class,
            UserSeeder::class,
            XcontrollerSeeder::class,
            MenuRoleSeeder::class,
            RoleUserSeeder::class,
            RoleXcontrollerSeeder::class,
            YearSeeder::class,
            GroupSeeder::class,
            SubjectSeeder::class,
        ]);
    }
}
