@extends('layouts.app')

@section('title', 'Tambah Data Penghuni Kost Baru')

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-8">

            <div class="d-flex align-items-center justify-content-between mb-3">
                <div>
                    <h1 class="h3 fw-bold mb-1">Tambah Penghuni Baru</h1>
                    <p class="text-muted mb-0">Isi formulir ringkas di bawah untuk mendaftarkan penyewa baru ke dalam database.</p>
                </div>
                <a href="{{ route('penghuni.index') }}" class="btn btn-outline-secondary btn-sm">
                    <i class="bi bi-arrow-left me-1"></i> Lihat Data Tabel
                </a>
            </div>

            <div class="custom-card-box">
                <h2 class="h6 fw-bold text-primary mb-1">
                    <i class="bi bi-info-circle-fill me-1"></i> Petunjuk Pengisian
                </h2>
                <p class="text-muted small mb-0">
                    Data yang Anda submit melalui form ini akan langsung dimasukkan ke dalam database dan dapat langsung dilihat di halaman manajemen.
                </p>
            </div>

            <div class="card shadow-sm mb-4">
                <div class="card-header bg-white py-3">
                    <span class="fw-bold"><i class="bi bi-person-lines-fill text-primary me-1"></i> Formulir Data Penghuni</span>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('penghuni.store') }}" method="POST">
                        @csrf

                        <!-- Nama Lengkap -->
                        <div class="mb-3">
                            <label for="nama" class="form-label fw-semibold">Nama Lengkap <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama"
                                value="{{ old('nama') }}" placeholder="Contoh: Siti Rahma" required>
                            @error('nama')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- NIK & Jenis Kelamin -->
                        <div class="row g-3 mb-3">
                            <div class="col-md-7">
                                <label for="nik" class="form-label fw-semibold">Nomor KTP / NIK <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('nik') is-invalid @enderror" id="nik" name="nik"
                                    value="{{ old('nik') }}" placeholder="16 digit NIK sesuai KTP" required>
                                @error('nik')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-5">
                                <label class="form-label fw-semibold d-block">Jenis Kelamin <span class="text-danger">*</span></label>
                                <div class="pt-2">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="jk" id="laki"
                                            value="Laki-laki" {{ old('jk') === 'Laki-laki' ? 'checked' : '' }} required>
                                        <label class="form-check-label" for="laki">Laki-laki</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="jk" id="perempuan"
                                            value="Perempuan" {{ old('jk') === 'Perempuan' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="perempuan">Perempuan</label>
                                    </div>
                                </div>
                                @error('jk')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- No HP & Pekerjaan -->
                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label for="telepon" class="form-label fw-semibold">No. HP / WhatsApp <span class="text-danger">*</span></label>
                                <input type="tel" class="form-control @error('telepon') is-invalid @enderror" id="telepon" name="telepon"
                                    value="{{ old('telepon') }}" placeholder="08xxxxxxxxxx" required>
                                @error('telepon')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="pekerjaan" class="form-label fw-semibold">Pekerjaan / Instansi</label>
                                <input type="text" class="form-control @error('pekerjaan') is-invalid @enderror" id="pekerjaan" name="pekerjaan"
                                    value="{{ old('pekerjaan') }}" placeholder="Contoh: Mahasiswa UGM / Karyawan">
                                @error('pekerjaan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <hr class="my-4">

                        <!-- Kamar & Tanggal Masuk -->
                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label for="kamar" class="form-label fw-semibold">Pilih Kamar Kost <span class="text-danger">*</span></label>
                                <select class="form-select @error('kamar') is-invalid @enderror" id="kamar" name="kamar" required>
                                    <option value="">-- Pilih Kamar Tersedia --</option>
                                    <option value="Kamar A-01 (Griya Harmoni)" {{ old('kamar') === 'Kamar A-01 (Griya Harmoni)' ? 'selected' : '' }}>Kamar A-01 (Kost Griya Harmoni)</option>
                                    <option value="Kamar A-02 (Griya Harmoni)" {{ old('kamar') === 'Kamar A-02 (Griya Harmoni)' ? 'selected' : '' }}>Kamar A-02 (Kost Griya Harmoni)</option>
                                    <option value="Kamar B-05 (Barokah Jaya)" {{ old('kamar') === 'Kamar B-05 (Barokah Jaya)' ? 'selected' : '' }}>Kamar B-05 (Kost Barokah Jaya)</option>
                                    <option value="Kamar C-03 (Green Residence)" {{ old('kamar') === 'Kamar C-03 (Green Residence)' ? 'selected' : '' }}>Kamar C-03 (Kost Green Residence)</option>
                                </select>
                                @error('kamar')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="tgl_masuk" class="form-label fw-semibold">Tanggal Mulai Masuk <span class="text-danger">*</span></label>
                                <input type="date" class="form-control @error('tgl_masuk') is-invalid @enderror" id="tgl_masuk" name="tgl_masuk"
                                    value="{{ old('tgl_masuk', date('Y-m-d')) }}" required>
                                @error('tgl_masuk')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Harga & Status -->
                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label for="harga" class="form-label fw-semibold">Biaya Sewa per Bulan (Rp) <span class="text-danger">*</span></label>
                                <div class="input-group has-validation">
                                    <span class="input-group-text">Rp</span>
                                    <input type="number" class="form-control @error('harga') is-invalid @enderror" id="harga" name="harga"
                                        value="{{ old('harga', '1200000') }}" placeholder="1200000" min="0" step="50000" required>
                                    @error('harga')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="status" class="form-label fw-semibold">Status Pembayaran <span class="text-danger">*</span></label>
                                <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" required>
                                    <option value="Belum lunas" {{ old('status', 'Belum lunas') === 'Belum lunas' ? 'selected' : '' }}>Belum lunas</option>
                                    <option value="Lunas" {{ old('status') === 'Lunas' ? 'selected' : '' }}>Lunas</option>
                                    <option value="Nunggak" {{ old('status') === 'Nunggak' ? 'selected' : '' }}>Nunggak</option>
                                </select>
                                @error('status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Kontak Darurat -->
                        <div class="mb-4">
                            <label for="kontak_darurat" class="form-label fw-semibold">Kontak Darurat (Nama & No. HP) <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('kontak_darurat') is-invalid @enderror" id="kontak_darurat" name="kontak_darurat"
                                value="{{ old('kontak_darurat') }}" placeholder="Contoh: Ibu Rahma (081298765432)" required>
                            <div class="form-text">Dapat dihubungi jika terjadi keadaan mendesak terkait penghuni.</div>
                            @error('kontak_darurat')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Action Buttons -->
                        <div class="d-flex gap-2 justify-content-end">
                            <a href="{{ route('penghuni.index') }}" class="btn btn-outline-secondary px-4">
                                <i class="bi bi-x-circle me-1"></i> Batal
                            </a>
                            <button type="submit" class="btn btn-primary px-4">
                                <i class="bi bi-save-fill me-1"></i> Simpan Data Penghuni
                            </button>
                        </div>

                    </form>
                </div>
            </div>

        </div>
    </div>
@endsection
