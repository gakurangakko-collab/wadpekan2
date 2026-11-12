<?php

namespace Database\Seeders;

use App\Models\PenghuniKost;
use Illuminate\Database\Seeder;

class PenghuniKostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (PenghuniKost::count() === 0) {
            PenghuniKost::insert([
                [
                    'nama' => 'Siti Rahma',
                    'nik' => '3304123456780001',
                    'jk' => 'Perempuan',
                    'telepon' => '081234567890',
                    'pekerjaan' => 'Mahasiswi UGM',
                    'kamar' => 'Kamar A-01 (Griya Harmoni)',
                    'tgl_masuk' => '2026-08-10',
                    'harga' => '1200000',
                    'kontak_darurat' => 'Ibu Rahmawati (081298765432)',
                    'status' => 'Lunas',
                ],
                [
                    'nama' => 'Ahmad Fauzi',
                    'nik' => '3201987654320002',
                    'jk' => 'Laki-laki',
                    'telepon' => '082155566677',
                    'pekerjaan' => 'Karyawan Telkom',
                    'kamar' => 'Kamar B-05 (Barokah Jaya)',
                    'tgl_masuk' => '2026-01-02',
                    'harga' => '900000',
                    'kontak_darurat' => 'Bambang S. (081344455566)',
                    'status' => 'Lunas',
                ],
                [
                    'nama' => 'Anisa Putri Rahma',
                    'nik' => '3302112233440004',
                    'jk' => 'Perempuan',
                    'telepon' => '089677889911',
                    'pekerjaan' => 'Karyawan Bank',
                    'kamar' => 'Kamar A-02 (Griya Harmoni)',
                    'tgl_masuk' => '2026-09-01',
                    'harga' => '1300000',
                    'kontak_darurat' => 'Suryono (087811223344)',
                    'status' => 'Nunggak',
                ],
            ]);
        }
    }
}
