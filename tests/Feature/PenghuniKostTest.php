<?php

namespace Tests\Feature;

use App\Models\PenghuniKost;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PenghuniKostTest extends TestCase
{
    use RefreshDatabase;

    protected User $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->pemilik()->create();
    }

    public function test_guest_is_redirected_to_login(): void
    {
        $response = $this->get(route('penghuni.index'));

        $response->assertRedirect(route('login'));
    }

    public function test_can_display_penghuni_index_page(): void
    {
        $penghuni = PenghuniKost::factory()->create([
            'nama' => 'Budi Santoso',
            'status' => 'Lunas',
        ]);

        $response = $this->actingAs($this->user)->get(route('penghuni.index'));

        $response->assertStatus(200);
        $response->assertSee('Budi Santoso');
        $response->assertSee('Lunas');
    }

    public function test_can_filter_penghuni_by_name(): void
    {
        PenghuniKost::factory()->create(['nama' => 'Siti Aminah']);
        PenghuniKost::factory()->create(['nama' => 'Rudi Hartono']);

        $response = $this->actingAs($this->user)->get(route('penghuni.index', ['cari' => 'Siti']));

        $response->assertStatus(200);
        $response->assertSee('Siti Aminah');
        $response->assertDontSee('Rudi Hartono');
    }

    public function test_can_display_create_form(): void
    {
        $response = $this->actingAs($this->user)->get(route('penghuni.create'));

        $response->assertStatus(200);
        $response->assertSee('Tambah Penghuni Baru');
    }

    public function test_can_store_new_penghuni(): void
    {
        $data = [
            'nama' => 'Dewi Sartika',
            'nik' => '3201123456780009',
            'jk' => 'Perempuan',
            'telepon' => '081299887766',
            'pekerjaan' => 'Mahasiswi UI',
            'kamar' => 'Kamar A-01 (Griya Harmoni)',
            'tgl_masuk' => '2026-10-01',
            'harga' => '1200000',
            'kontak_darurat' => 'Bapak Sartika (081233445566)',
            'status' => 'Lunas',
        ];

        $response = $this->actingAs($this->user)->post(route('penghuni.store'), $data);

        $response->assertRedirect(route('penghuni.index'));
        $response->assertSessionHas('success');
        $this->assertDatabaseHas('penghuni_kost', [
            'nama' => 'Dewi Sartika',
            'nik' => '3201123456780009',
        ]);
    }

    public function test_can_display_edit_form(): void
    {
        $penghuni = PenghuniKost::factory()->create([
            'nama' => 'Joko Widodo',
        ]);

        $response = $this->actingAs($this->user)->get(route('penghuni.edit', $penghuni));

        $response->assertStatus(200);
        $response->assertSee('Joko Widodo');
    }

    public function test_can_update_penghuni(): void
    {
        $penghuni = PenghuniKost::factory()->create([
            'nama' => 'Nama Lama',
            'status' => 'Belum lunas',
        ]);

        $updateData = [
            'nama' => 'Nama Baru',
            'nik' => $penghuni->nik,
            'jk' => $penghuni->jk,
            'telepon' => $penghuni->telepon,
            'pekerjaan' => 'Pekerjaan Baru',
            'kamar' => $penghuni->kamar,
            'tgl_masuk' => '2026-10-15',
            'harga' => '1500000',
            'kontak_darurat' => $penghuni->kontak_darurat,
            'status' => 'Lunas',
        ];

        $response = $this->actingAs($this->user)->put(route('penghuni.update', $penghuni), $updateData);

        $response->assertRedirect(route('penghuni.index'));
        $response->assertSessionHas('success');
        $this->assertDatabaseHas('penghuni_kost', [
            'id' => $penghuni->id,
            'nama' => 'Nama Baru',
            'status' => 'Lunas',
        ]);
    }

    public function test_can_delete_penghuni(): void
    {
        $penghuni = PenghuniKost::factory()->create([
            'nama' => 'Penghuni Mau Dihapus',
        ]);

        $response = $this->actingAs($this->user)->delete(route('penghuni.destroy', $penghuni));

        $response->assertRedirect(route('penghuni.index'));
        $response->assertSessionHas('success');
        $this->assertDatabaseMissing('penghuni_kost', [
            'id' => $penghuni->id,
        ]);
    }

    public function test_role_middleware_rejects_unauthorized_role_with_custom_403(): void
    {
        $unauthorized = User::factory()->create(['role' => 'tamu']);

        $response = $this->actingAs($unauthorized)->get(route('penghuni.index'));

        $response->assertStatus(403);
        $response->assertSee('Akses Ditolak');
        $response->assertSee('Anda tidak memiliki hak akses untuk peran ini.');
    }

    public function test_only_pemilik_can_access_laporan_keuangan_gate(): void
    {
        $pengelola = User::factory()->pengelola()->create();
        PenghuniKost::factory()->create([
            'nama' => 'Penghuni Satu',
            'harga' => '1500000',
            'status' => 'Lunas',
        ]);

        $this->actingAs($pengelola)
            ->get(route('penghuni.laporan'))
            ->assertStatus(403);

        $response = $this->actingAs($this->user)->get(route('penghuni.laporan'));
        $response->assertStatus(200);
        $response->assertSee('Laporan Keuangan Kost');
        $response->assertSee('1.500.000');
    }

    public function test_pengelola_can_update_non_lunas_penghuni_but_harga_is_not_changed(): void
    {
        $pengelola = User::factory()->pengelola()->create();
        $penghuni = PenghuniKost::factory()->create([
            'nama' => 'Budi Awal',
            'harga' => '1000000',
            'status' => 'Belum lunas',
        ]);

        $this->actingAs($pengelola)
            ->get(route('penghuni.edit', $penghuni))
            ->assertStatus(200);

        $response = $this->actingAs($pengelola)->put(route('penghuni.update', $penghuni), [
            'nama' => 'Budi Diubah',
            'nik' => $penghuni->nik,
            'jk' => $penghuni->jk,
            'telepon' => $penghuni->telepon,
            'pekerjaan' => $penghuni->pekerjaan,
            'kamar' => $penghuni->kamar,
            'tgl_masuk' => '2026-10-15',
            'harga' => '9999999',
            'kontak_darurat' => $penghuni->kontak_darurat,
            'status' => 'Belum lunas',
        ]);

        $response->assertRedirect(route('penghuni.index'));
        $this->assertDatabaseHas('penghuni_kost', [
            'id' => $penghuni->id,
            'nama' => 'Budi Diubah',
            'harga' => '1000000',
        ]);
    }

    public function test_pengelola_cannot_edit_or_update_lunas_penghuni(): void
    {
        $pengelola = User::factory()->pengelola()->create();
        $penghuni = PenghuniKost::factory()->create([
            'nama' => 'Penghuni Lunas',
            'status' => 'Lunas',
        ]);

        $this->actingAs($pengelola)
            ->get(route('penghuni.edit', $penghuni))
            ->assertStatus(403);

        $this->actingAs($pengelola)
            ->put(route('penghuni.update', $penghuni), [
                'nama' => 'Coba Ubah',
                'nik' => $penghuni->nik,
                'jk' => $penghuni->jk,
                'telepon' => $penghuni->telepon,
                'pekerjaan' => $penghuni->pekerjaan,
                'kamar' => $penghuni->kamar,
                'tgl_masuk' => '2026-10-15',
                'kontak_darurat' => $penghuni->kontak_darurat,
                'status' => 'Belum lunas',
            ])
            ->assertStatus(403);
    }

    public function test_pengelola_cannot_delete_penghuni(): void
    {
        $pengelola = User::factory()->pengelola()->create();
        $penghuni = PenghuniKost::factory()->create();

        $this->actingAs($pengelola)
            ->delete(route('penghuni.destroy', $penghuni))
            ->assertStatus(403);

        $this->assertDatabaseHas('penghuni_kost', [
            'id' => $penghuni->id,
        ]);
    }

    public function test_index_hides_restricted_controls_from_pengelola(): void
    {
        $pengelola = User::factory()->pengelola()->create();
        PenghuniKost::factory()->create(['status' => 'Lunas']);

        $response = $this->actingAs($pengelola)->get(route('penghuni.index'));
        $response->assertStatus(200);
        $response->assertDontSee('Laporan Keuangan');
        $response->assertDontSee('title="Hapus Data"', false);
        $response->assertSee('Terkunci');
    }
}
