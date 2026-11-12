<?php

namespace Database\Factories;

use App\Models\PenghuniKost;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<PenghuniKost>
 */
class PenghuniKostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama' => fake()->name(),
            'nik' => fake()->numerify('################'),
            'jk' => fake()->randomElement(['Laki-laki', 'Perempuan']),
            'telepon' => fake()->numerify('08##########'),
            'pekerjaan' => fake()->randomElement(['Mahasiswa', 'Karyawan Swasta', 'PNS', 'Wiraswasta']),
            'kamar' => fake()->randomElement([
                'Kamar A-01 (Griya Harmoni)',
                'Kamar A-02 (Griya Harmoni)',
                'Kamar B-05 (Barokah Jaya)',
                'Kamar C-03 (Green Residence)',
            ]),
            'tgl_masuk' => fake()->date('Y-m-d'),
            'harga' => (string) fake()->randomElement([800000, 1000000, 1200000, 1500000]),
            'kontak_darurat' => fake()->name().' ('.fake()->numerify('08##########').')',
            'status' => fake()->randomElement(['Lunas', 'Belum lunas', 'Nunggak']),
        ];
    }
}
