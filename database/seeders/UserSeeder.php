<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'profile_id' => 1,
            'email' => 'reno.nilam@gmail.com',
            'password' => bcrypt('indonesiaku'),
        ]);

        User::create([
            'profile_id' => 2,
            'email' => 'aisyah@gmail.com',
            'password' => bcrypt('123456'),
        ]);

        User::create([
            'profile_id' => 3,
            'email' => 'siswa@gmail.com',
            'password' => bcrypt('123456'),
        ]);
    }
}
