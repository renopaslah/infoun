<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Group;

class GroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Group::create([
            'name' => '12 Akuntansi 1',
            'year_id' => 1,
        ]);

        Group::create([
            'name' => '12 Akuntansi 2',
            'year_id' => 1,
        ]);
    }
}
