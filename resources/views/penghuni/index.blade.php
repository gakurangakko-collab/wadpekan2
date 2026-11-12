@extends('layouts.app')

@section('title', 'Manajemen Data Penghuni Kost')

@section('content')
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
        <div>
            <h1 class="h3 fw-bold mb-1">Manajemen Data Penghuni Kost</h1>
            <p class="text-muted mb-0">Daftar seluruh penghuni kost aktif dan status pembayarannya.</p>
        </div>
        <div class="d-flex gap-2">
            @can('view-laporan-keuangan')
                <a href="{{ route('penghuni.laporan') }}" class="btn btn-outline-primary shadow-sm">
                    <i class="bi bi-cash-coin me-1"></i> Laporan Keuangan
                </a>
            @endcan
            <a href="{{ route('penghuni.create') }}" class="btn btn-primary shadow-sm">
                <i class="bi bi-plus-circle me-1"></i> Tambah Penghuni Baru
            </a>
        </div>
    </div>

    <!-- Ringkasan Statistik -->
    <section class="mb-4">
        <div class="row g-3">
            <div class="col-sm-6 col-lg-3">
                <div class="stat-card">
                    <div class="text-muted small fw-semibold">Total Penghuni Aktif</div>
                    <div class="h4 fw-bold text-dark mt-2 mb-0">{{ $totalPenghuni }} <span class="fs-6 fw-normal text-muted">Orang</span></div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3">
                <div class="stat-card">
                    <div class="text-muted small fw-semibold">Status Lunas</div>
                    <div class="h4 fw-bold text-success mt-2 mb-0">{{ $totalLunas }} <span class="fs-6 fw-normal text-muted">Orang</span></div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3">
                <div class="stat-card">
                    <div class="text-muted small fw-semibold">Belum Lunas</div>
                    <div class="h4 fw-bold text-warning mt-2 mb-0">{{ $totalBelumLunas }} <span class="fs-6 fw-normal text-muted">Orang</span></div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3">
                <div class="stat-card">
                    <div class="text-muted small fw-semibold">Menunggak</div>
                    <div class="h4 fw-bold text-danger mt-2 mb-0">{{ $totalMenunggak }} <span class="fs-6 fw-normal text-muted">Orang</span></div>
                </div>
            </div>
        </div>
    </section>

    <!-- Cari dan Filter -->
    <section class="card mb-4 shadow-sm">
        <div class="card-header bg-white py-3">
            <span class="fw-bold"><i class="bi bi-funnel-fill text-primary me-1"></i> Cari dan Filter Penghuni</span>
        </div>
        <div class="card-body">
            <form action="{{ route('penghuni.index') }}" method="GET" class="row g-3 align-items-end">
                <div class="col-md-5">
                    <label for="cari" class="form-label fw-semibold">Pencarian:</label>
                    <input type="text" class="form-control" id="cari" name="cari"
                        value="{{ request('cari') }}"
                        placeholder="Cari berdasarkan nama, NIK, atau nomor HP...">
                </div>
                <div class="col-md-4">
                    <label for="filter_status" class="form-label fw-semibold">Status Sewa:</label>
                    <select class="form-select" id="filter_status" name="filter_status">
                        <option value="">Semua Status</option>
                        <option value="Lunas" {{ request('filter_status') === 'Lunas' ? 'selected' : '' }}>Lunas</option>
                        <option value="Belum lunas" {{ request('filter_status') === 'Belum lunas' ? 'selected' : '' }}>Belum lunas</option>
                        <option value="Nunggak" {{ request('filter_status') === 'Nunggak' ? 'selected' : '' }}>Nunggak</option>
                    </select>
                </div>
                <div class="col-md-3 d-flex gap-2">
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="bi bi-search"></i> Cari
                    </button>
                    <a href="{{ route('penghuni.index') }}" class="btn btn-outline-secondary" title="Reset filter">
                        <i class="bi bi-arrow-counterclockwise"></i>
                    </a>
                </div>
            </form>
        </div>
    </section>

    <!-- Tabel Daftar Penghuni -->
    <section class="card shadow-sm">
        <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
            <span class="fw-bold"><i class="bi bi-table text-primary me-1"></i> Daftar Penghuni Kost</span>
            <span class="badge bg-primary">{{ count($daftarPenghuni) }} Data</span>
        </div>
        <div class="table-responsive">
            <table class="table table-hover table-striped align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th scope="col" class="text-center" style="width: 50px;">No</th>
                        <th scope="col">Nama & NIK</th>
                        <th scope="col">Gender</th>
                        <th scope="col">No. HP / WA</th>
                        <th scope="col">Pekerjaan</th>
                        <th scope="col">Kamar Kost</th>
                        <th scope="col">Tgl Masuk</th>
                        <th scope="col">Biaya Sewa / Bulan</th>
                        <th scope="col">Kontak Darurat</th>
                        <th scope="col" class="text-center">Status</th>
                        <th scope="col" class="text-center" style="width: 120px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($daftarPenghuni as $index => $penghuni)
                        <tr>
                            <td class="text-center fw-bold text-muted">{{ $index + 1 }}</td>
                            <td>
                                <div class="fw-bold text-dark">{{ $penghuni->nama }}</div>
                                <small class="text-muted">{{ $penghuni->nik }}</small>
                            </td>
                            <td>
                                @if ($penghuni->jk === 'Laki-laki' || $penghuni->jk === 'Laki laki')
                                    <span class="badge bg-info text-dark">Laki-laki</span>
                                @else
                                    <span class="badge bg-danger-subtle text-danger border border-danger-subtle">Perempuan</span>
                                @endif
                            </td>
                            <td>{{ $penghuni->telepon }}</td>
                            <td><span class="small">{{ $penghuni->pekerjaan ?? '-' }}</span></td>
                            <td>
                                <span class="badge bg-secondary">{{ $penghuni->kamar }}</span>
                            </td>
                            <td>
                                {{ $penghuni->tgl_masuk ? \Carbon\Carbon::parse($penghuni->tgl_masuk)->format('d/m/Y') : '-' }}
                            </td>
                            <td>Rp {{ number_format((int)$penghuni->harga, 0, ',', '.') }}</td>
                            <td>
                                <div class="small fw-semibold text-secondary">
                                    {{ $penghuni->kontak_darurat }}
                                </div>
                            </td>
                            <td class="text-center">
                                @if ($penghuni->status === 'Lunas')
                                    <span class="badge bg-success">Lunas</span>
                                @elseif ($penghuni->status === 'Belum lunas')
                                    <span class="badge bg-warning text-dark">Belum lunas</span>
                                @else
                                    <span class="badge bg-danger">Nunggak</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <div class="btn-group btn-group-sm" role="group">
                                    @can('update', $penghuni)
                                        <a href="{{ route('penghuni.edit', $penghuni) }}" class="btn btn-outline-warning" title="Edit Data">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                    @endcan
                                    @can('delete', $penghuni)
                                        <form action="{{ route('penghuni.destroy', $penghuni) }}" method="POST" class="d-inline"
                                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus data penghuni {{ $penghuni->nama }}?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger" title="Hapus Data">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    @endcan
                                    @cannot('update', $penghuni)
                                        @cannot('delete', $penghuni)
                                            <span class="badge bg-light text-muted border"><i class="bi bi-lock-fill me-1"></i>Terkunci</span>
                                        @endcannot
                                    @endcannot
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="11" class="text-center py-4 text-muted">
                                <i class="bi bi-inbox fs-3 d-block mb-2 text-secondary"></i>
                                Tidak ada data penghuni kost yang ditemukan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>
@endsection
