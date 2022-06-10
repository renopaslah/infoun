<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Menu;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Menu::create([
            'name' => 'Dashboard',
            'href' => '/home',
        ]);

        Menu::create([
            'name' => 'Pengumuman',
            'href' => '/board',
        ]);

        Menu::create([
            'name' => 'Kelulusan',
            'href' => '/score',
        ]);

        Menu::create([
            'name' => 'Bendahara',
            'href' => '/bill',
        ]);

        Menu::create([
            'name' => 'Data',
            'href' => '/#',
        ]);

        Menu::create([
            'name' => 'Referensi',
            'href' => '/#',
        ]);

        Menu::create([
            'name' => 'Pengaturan',
            'href' => '/#',
        ]);

        Menu::create([
            'name' => 'Siswa',
            'parent_id' => 5,
            'href' => 'data/student',
        ]);

        Menu::create([
            'name' => 'Mata Ujian',
            'parent_id' => 5,
            'href' => 'data/subject',
        ]);

        Menu::create([
            'name' => 'Kelas',
            'parent_id' => 6,
            'href' => 'reference/group',
        ]);

        Menu::create([
            'name' => 'Tahun Ajaran',
            'parent_id' => 6,
            'href' => 'reference/year',
        ]);

        Menu::create([
            'name' => 'Role',
            'parent_id' => 7,
            'href' => 'setting/role',
        ]);

        Menu::create([
            'name' => 'Hak Akses Menu',
            'parent_id' => 7,
            'href' => 'setting/menu_access',
        ]);

        Menu::create([
            'name' => 'Hak Akses Controller',
            'parent_id' => 7,
            'href' => 'setting//controller_access',
        ]);
    }
}
