@extends('layouts.app')

@section('title', 'Laporan Keuangan Kost')

@section('content')
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
        <div>
            <h1 class="h3 fw-bold mb-1">Laporan Keuangan Kost</h1>
            <p class="text-muted mb-0">Ringkasan pemasukan dan tagihan sewa kamar khusus Pemilik Kost.</p>
        </div>
        <a href="{{ route('penghuni.index') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left me-1"></i> Kembali ke Data Penghuni
        </a>
    </div>

    <section class="mb-4">
        <div class="row g-3">
            <div class="col-sm-6 col-lg-3">
                <div class="stat-card">
                    <div class="text-muted small fw-semibold">Total Potensi / Bulan</div>
                    <div class="h5 fw-bold text-dark mt-2 mb-0">Rp {{ number_format($totalPotensiPendapatan, 0, ',', '.') }}</div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3">
                <div class="stat-card">
                    <div class="text-muted small fw-semibold">Pemasukan Lunas</div>
                    <div class="h5 fw-bold text-success mt-2 mb-0">Rp {{ number_format($totalPemasukanLunas, 0, ',', '.') }}</div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3">
                <div class="stat-card">
                    <div class="text-muted small fw-semibold">Piutang Belum Lunas</div>
                    <div class="h5 fw-bold text-warning mt-2 mb-0">Rp {{ number_format($totalBelumLunasNominal, 0, ',', '.') }}</div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3">
                <div class="stat-card">
                    <div class="text-muted small fw-semibold">Tunggakan</div>
                    <div class="h5 fw-bold text-danger mt-2 mb-0">Rp {{ number_format($totalNunggakNominal, 0, ',', '.') }}</div>
                </div>
            </div>
        </div>
    </section>

    <section class="card shadow-sm">
        <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
            <span class="fw-bold"><i class="bi bi-cash-stack text-primary me-1"></i> Rincian Tagihan Per Penghuni</span>
            <span class="badge bg-primary">{{ count($daftarPenghuni) }} Penghuni</span>
        </div>
        <div class="table-responsive">
            <table class="table table-hover table-striped align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th scope="col" class="text-center" style="width: 50px;">No</th>
                        <th scope="col">Nama Penghuni</th>
                        <th scope="col">Kamar</th>
                        <th scope="col">Biaya Sewa / Bulan</th>
                        <th scope="col" class="text-center">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($daftarPenghuni as $index => $penghuni)
                        <tr>
                            <td class="text-center fw-bold text-muted">{{ $index + 1 }}</td>
                            <td class="fw-semibold">{{ $penghuni->nama }}</td>
                            <td><span class="badge bg-secondary">{{ $penghuni->kamar }}</span></td>
                            <td>Rp {{ number_format((int) $penghuni->harga, 0, ',', '.') }}</td>
                            <td class="text-center">
                                @if ($penghuni->status === 'Lunas')
                                    <span class="badge bg-success">Lunas</span>
                                @elseif ($penghuni->status === 'Belum lunas')
                                    <span class="badge bg-warning text-dark">Belum lunas</span>
                                @else
                                    <span class="badge bg-danger">Nunggak</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-4 text-muted">Belum ada data penghuni kost.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>
@endsection

