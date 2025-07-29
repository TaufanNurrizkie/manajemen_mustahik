<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class MustahikSeeder extends Seeder
{
    public function run(): void
    {
        for ($i = 1; $i <= 10; $i++) {
            DB::table('mustahiks')->insert([
                'nama' => 'Mustahik ' . $i,
                'program' => collect(['Bantuan Pendidikan', 'Bantuan Kesehatan', 'Bantuan UMKM'])->random(),
                'alamat' => 'Jl. Contoh No. ' . $i,
                'kecamatan' => 'Kecamatan ' . chr(65 + $i),
                'kelurahan' => 'Kelurahan ' . chr(65 + $i),
                'latitude' => 0.481 + mt_rand(-500, 500) / 10000,
                'longitude' => 101.431 + mt_rand(-500, 500) / 10000,
                'status' => collect(['belum_dibantu', 'sudah_dibantu'])->random(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
