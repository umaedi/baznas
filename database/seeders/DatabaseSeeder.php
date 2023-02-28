<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        \App\Models\User::create([
            'name'  => 'Amil',
            'email' => 'amil@gmail.com',
            'password'  => bcrypt('amil123'),
            'no_tlp'    => '085741492045'
        ]);

        $categories = [
            ['nama_kategori'  => 'Zakat Profesi'],
            ['nama_kategori'  => 'Zakat Mal'],
            ['nama_kategori'  => 'Zakat Fitrah'],
            ['nama_kategori'  => 'Infaq Shodaqoh'],
        ];
        \App\Models\Category::insert($categories);

        $dinas = [
            ['nama_dinas'   => 'Kedinasan'],
            ['nama_dinas'   => 'Pegawai'],
            ['nama_dinas'   => 'Masyarakat Umum'],
        ];

        \App\Models\Dinas::insert($dinas);
    }
}
