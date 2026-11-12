<?php

namespace App\Http\Controllers;

use App\Models\PenghuniKost;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PenghuniKostController extends Controller
{
    /**
     * Menampilkan daftar seluruh penghuni kost dengan fitur cari & filter.
     */
    public function index(Request $request): View
    {
        // Hitung ringkasan statistik
        $totalPenghuni = PenghuniKost::count();
        $totalLunas = PenghuniKost::where('status', 'Lunas')->count();
        $totalBelumLunas = PenghuniKost::where('status', 'Belum lunas')->count();
        $totalMenunggak = PenghuniKost::where('status', 'Nunggak')->count();

        // Query data dengan filter
        $query = PenghuniKost::query();

        if ($request->filled('cari')) {
            $cari = $request->input('cari');
            $query->where(function ($q) use ($cari) {
                $q->where('nama', 'like', "%{$cari}%")
                    ->orWhere('nik', 'like', "%{$cari}%")
                    ->orWhere('telepon', 'like', "%{$cari}%");
            });
        }

        if ($request->filled('filter_status')) {
            $query->where('status', $request->input('filter_status'));
        }

        $daftarPenghuni = $query->orderBy('id', 'desc')->get();

        return view('penghuni.index', compact('daftarPenghuni', 'totalBelumLunas', 'totalLunas', 'totalPenghuni', 'totalMenunggak'));
    }

    public function laporan(): View
    {
        $daftarPenghuni = PenghuniKost::orderBy('status')->orderBy('nama')->get();

        $totalPemasukanLunas = $daftarPenghuni->where('status', 'Lunas')->sum(fn (PenghuniKost $item) => (int) $item->harga);
        $totalBelumLunasNominal = $daftarPenghuni->where('status', 'Belum lunas')->sum(fn (PenghuniKost $item) => (int) $item->harga);
        $totalNunggakNominal = $daftarPenghuni->where('status', 'Nunggak')->sum(fn (PenghuniKost $item) => (int) $item->harga);
        $totalPotensiPendapatan = $totalPemasukanLunas + $totalBelumLunasNominal + $totalNunggakNominal;

        return view('penghuni.laporan', compact(
            'daftarPenghuni',
            'totalPemasukanLunas',
            'totalBelumLunasNominal',
            'totalNunggakNominal',
            'totalPotensiPendapatan',
        ));
    }

    /**
     * Menampilkan formulir tambah penghuni baru.
     */
    public function create(): View
    {
        return view('penghuni.create');
    }

    /**
     * Menyimpan data penghuni baru ke database.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:50',
            'nik' => 'required|string|max:20',
            'jk' => 'required|string|max:100',
            'telepon' => 'required|string|max:20',
            'pekerjaan' => 'nullable|string|max:100',
            'kamar' => 'required|string|max:50',
            'tgl_masuk' => 'required|date',
            'harga' => 'required|numeric|min:0',
            'kontak_darurat' => 'required|string|max:100',
            'status' => 'required|in:Lunas,Belum lunas,Nunggak',
        ]);

        PenghuniKost::create($validated);

        return redirect()
            ->route('penghuni.index')
            ->with('success', 'Data penghuni baru berhasil disimpan!');
    }

    /**
     * Menampilkan detail data penghuni tertentu.
     */
    public function show(PenghuniKost $penghuni): RedirectResponse
    {
        return redirect()->route('penghuni.edit', $penghuni);
    }

    /**
     * Menampilkan formulir edit penghuni.
     */
    public function edit(PenghuniKost $penghuni): View
    {
        return view('penghuni.edit', compact('penghuni'));
    }

    /**
     * Memperbarui data penghuni di database.
     */
    public function update(Request $request, PenghuniKost $penghuni): RedirectResponse
    {
        $rules = [
            'nama' => 'required|string|max:50',
            'nik' => 'required|string|max:20',
            'jk' => 'required|string|max:100',
            'telepon' => 'required|string|max:20',
            'pekerjaan' => 'nullable|string|max:100',
            'kamar' => 'required|string|max:50',
            'tgl_masuk' => 'required|date',
            'kontak_darurat' => 'required|string|max:100',
            'status' => 'required|in:Lunas,Belum lunas,Nunggak',
        ];

        if ($request->user()->can('updateHarga', $penghuni)) {
            $rules['harga'] = 'required|numeric|min:0';
        }

        $validated = $request->validate($rules);

        $penghuni->update($validated);

        return redirect()
            ->route('penghuni.index')
            ->with('success', 'Data penghuni berhasil diperbarui!');
    }

    /**
     * Menghapus data penghuni dari database.
     */
    public function destroy(PenghuniKost $penghuni): RedirectResponse
    {
        $penghuni->delete();

        return redirect()
            ->route('penghuni.index')
            ->with('success', 'Data penghuni berhasil dihapus!');
    }
}
