<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Subject;

class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Subject::create([
            'name' => 'Bahasa Indonesia',
        ]);

        Subject::create([
            'name' => 'Bahasa Inggris',
        ]);

        Subject::create([
            'name' => 'Matematika',
        ]);

        Subject::create([
            'name' => 'Teori Produktif',
        ]);

        Subject::create([
            'name' => 'Praktik Produktif',
        ]);
    }
}
