<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MenuRole;

class MenuRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        MenuRole::create([
            'role_id' => 1,
            'menu_id' => 1,
        ]);

        MenuRole::create([
            'role_id' => 1,
            'menu_id' => 3,
        ]);

        MenuRole::create([
            'role_id' => 1,
            'menu_id' => 8,
        ]);

        MenuRole::create([
            'role_id' => 1,
            'menu_id' => 9,
        ]);

        MenuRole::create([
            'role_id' => 1,
            'menu_id' => 10,
        ]);

        MenuRole::create([
            'role_id' => 1,
            'menu_id' => 11,
        ]);

        MenuRole::create([
            'role_id' => 1,
            'menu_id' => 12,
        ]);

        MenuRole::create([
            'role_id' => 1,
            'menu_id' => 13,
        ]);

        MenuRole::create([
            'role_id' => 1,
            'menu_id' => 14,
        ]);

        MenuRole::create([
            'role_id' => 2,
            'menu_id' => 1,
        ]);

        MenuRole::create([
            'role_id' => 2,
            'menu_id' => 4,
        ]);

        MenuRole::create([
            'role_id' => 3,
            'menu_id' => 1,
        ]);

        MenuRole::create([
            'role_id' => 3,
            'menu_id' => 2,
        ]);
    }
}
