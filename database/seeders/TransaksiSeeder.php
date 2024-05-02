<?php

namespace Database\Seeders;

use App\Models\TrPengajuan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TransaksiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $transaksi = [
            [
                'pengajuan_id' => 1,
                'skl_id' => 1,
                'users_id' => 1,
                'pengajuan_detail' => 'Pengajuan 1',
                'pengajuan_status' => 'Menunggu',
                'pengajuan_catatan' => 'Catatan Admin',
                'created_by' => 1,
            ]
        ];

        TrPengajuan::query()->insert($transaksi);
    }
}
