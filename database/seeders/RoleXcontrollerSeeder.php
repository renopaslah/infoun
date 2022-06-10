<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\RoleXcontroller;

class RoleXcontrollerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        RoleXcontroller::create([
            'xcontroller_id' => 1,
            'role_id' => 1,
            'is_can_modify' => 1,
        ]);

        RoleXcontroller::create([
            'xcontroller_id' => 1,
            'role_id' => 2,
            'is_can_modify' => 0,
        ]);

        RoleXcontroller::create([
            'xcontroller_id' => 1,
            'role_id' => 3,
            'is_can_modify' => 0,
        ]);

        RoleXcontroller::create([
            'xcontroller_id' => 2,
            'role_id' => 3,
            'is_can_modify' => 0,
        ]);

        RoleXcontroller::create([
            'xcontroller_id' => 3,
            'role_id' => 1,
            'is_can_modify' => 1,
        ]);

        RoleXcontroller::create([
            'xcontroller_id' => 4,
            'role_id' => 2,
            'is_can_modify' => 1,
        ]);

        RoleXcontroller::create([
            'xcontroller_id' => 5,
            'role_id' => 1,
            'is_can_modify' => 1,
        ]);

        RoleXcontroller::create([
            'xcontroller_id' => 6,
            'role_id' => 1,
            'is_can_modify' => 1,
        ]);

        RoleXcontroller::create([
            'xcontroller_id' => 7,
            'role_id' => 1,
            'is_can_modify' => 1,
        ]);

        RoleXcontroller::create([
            'xcontroller_id' => 8,
            'role_id' => 1,
            'is_can_modify' => 1,
        ]);

        RoleXcontroller::create([
            'xcontroller_id' => 9,
            'role_id' => 1,
            'is_can_modify' => 1,
        ]);

        RoleXcontroller::create([
            'xcontroller_id' => 10,
            'role_id' => 1,
            'is_can_modify' => 1,
        ]);

        RoleXcontroller::create([
            'xcontroller_id' => 11,
            'role_id' => 1,
            'is_can_modify' => 1,
        ]);
    }
}
