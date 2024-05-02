<?php

namespace Database\Seeders;

use App\Models\InfoLayanan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InfoLayananSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $il = [
            [
                'kunker_pj' => 1,
                'layanan_nama' => 'Contoh Info Layanan',
                'layanan_slug' => 'contoh-info-layanan',
                'layanan_desc' => 'Contoh Deskripsi Info Layanan',
                'layanan_apk' => 'Contoh Aplikasi Info Layanan',
                'layanan_status' => 0,
                'layanan_sop' => 'Contoh SOP Info Layanan',
            ],
            [
                'kunker_pj' => 2,
                'layanan_nama' => 'Contoh Info Layanan 2',
                'layanan_slug' => 'contoh-info-layanan-2',
                'layanan_desc' => 'Contoh Deskripsi Info Layanan 2',
                'layanan_apk' => 'Contoh Aplikasi Info Layanan 2',
                'layanan_status' => 1,
                'layanan_sop' => 'Contoh SOP Info Layanan 2',
            ]
        ];
        InfoLayanan::query()->insert($il);
    }
}
