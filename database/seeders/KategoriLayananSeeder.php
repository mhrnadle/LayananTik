<?php

namespace Database\Seeders;

use App\Models\KategoriLayanan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KategoriLayananSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kl = [
            [
                'kl_id' => 1,
                'kunker' => 1,
                'kl_label' => 'Pemanfaatan Jaringan Intra Pemerintah Provinsi Lampung',
                'kl_status' => 1,
                'updated_by' => 1,
                'created_at' => now(),
            ],
            [
                'kl_id' => 2,
                'kunker' => 2,
                'kl_label' => 'Pemeliharaan jaringan intra',
                'kl_status' => 0,
                'updated_by' => 1,
                'created_at' => now(),
            ],
            [
                'kl_id' => 3,
                'kunker' => 1,
                'kl_label' => 'Permohonan Akses Perangkat Jaringan Unit Kerja',
                'kl_status' => 1,
                'updated_by' => 1,
                'created_at' => now(),
            ],
            [
                'kl_id' => 4,
                'kunker' => 2,
                'kl_label' => 'Komputasi Awan',
                'kl_status' => 1,
                'updated_by' => 1,
                'created_at' => now(),
            ],
            [
                'kl_id' => 5,
                'kunker' => 2,
                'kl_label' => 'Pencadangan dan Pemulihan',
                'kl_status' => 1,
                'updated_by' => 1,
                'created_at' => now(),
            ],
            [
                'kl_id' => 6,
                'kunker' => 1,
                'kl_label' => 'Integrasi Data',
                'kl_status' => 1,
                'updated_by' => 1,
                'created_at' => now(),
            ],
            [
                'kl_id' => 7,
                'kunker' => 1,
                'kl_label' => 'Manajemen Aset TIK',
                'kl_status' => 1,
                'updated_by' => 1,
                'created_at' => now(),
            ],
            [
                'kl_id' => 8,
                'kunker' => 2,
                'kl_label' => 'Pencatatan Aset Keluar dan Masuk',
                'kl_status' => 1,
                'updated_by' => 1,
                'created_at' => now(),
            ],
            [
                'kl_id' => 9,
                'kunker' => 1,
                'kl_label' => 'Pengelolaan Layanan TI',
                'kl_status' => 1,
                'updated_by' => 1,
                'created_at' => now(),
            ],
            [
                'kl_id' => 10,
                'kunker' => 1,
                'kl_label' => 'Konsultasi Teknologi Informasi dan Komunikasi',
                'kl_status' => 1,
                'updated_by' => 1,
                'created_at' => now(),
            ],
            [
                'kl_id' => 11,
                'kunker' => 1,
                'kl_label' => 'Peminjaman Aset Teknologi Informasi dan Komunikasi',
                'kl_status' => 1,
                'updated_by' => 1,
                'created_at' => now(),
            ],
            [
                'kl_id' => 12,
                'kunker' => 1,
                'kl_label' => 'Pos Elektronik',
                'kl_status' => 1,
                'updated_by' => 1,
                'created_at' => now(),
            ],
            [
                'kl_id' => 13,
                'kunker' => 2,
                'kl_label' => 'Permohonan Akses Akun Aplikasi/Sistem',
                'kl_status' => 1,
                'updated_by' => 1,
                'created_at' => now(),
            ],
        ];

        KategoriLayanan::query()->insert($kl);
    }
}
