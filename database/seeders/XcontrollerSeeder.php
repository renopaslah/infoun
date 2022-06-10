<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Xcontroller;

class XcontrollerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Xcontroller::create([
            'name' => 'home',
        ]);

        Xcontroller::create([
            'name' => 'board',
        ]);

        Xcontroller::create([
            'name' => 'score',
        ]);

        Xcontroller::create([
            'name' => 'bill',
        ]);

        Xcontroller::create([
            'name' => 'student',
        ]);

        Xcontroller::create([
            'name' => 'subject',
        ]);

        Xcontroller::create([
            'name' => 'group',
        ]);

        Xcontroller::create([
            'name' => 'year',
        ]);

        Xcontroller::create([
            'name' => 'role',
        ]);

        Xcontroller::create([
            'name' => 'rolemenu',
        ]);

        Xcontroller::create([
            'name' => 'rolecontroller',
        ]);
    }
}
