@extends('layouts.app')

@section('title', 'Tambah Data Tugas Baru')

@push('styles')
    <style> #deskripsi { min-height: 100px; } </style>
@endpush

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-plus-circle mr-2"></i>Tambah Data Tugas Baru</h1>
        <a href="{{ route('tugas.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm">
            <i class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali ke Daftar Tugas
        </a>
    </div>

    {{-- Pesan Validasi Error Langsung di View --}}
    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <h5 class="alert-heading">Terjadi Kesalahan Validasi!</h5>
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
        </div>
    @endif
    {{-- Pesan Sukses/Error dari Session --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
        </div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
        </div>
    @endif


    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Formulir Data Tugas</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('tugas.store') }}" method="POST">
                @csrf

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="user_id">Pegawai Ditugaskan <span class="text-danger">*</span></label>
                            <select name="user_id" id="user_id" class="form-control @error('user_id') is-invalid @enderror" required>
                                <option value="">-- Pilih Pegawai --</option>
                                @foreach ($pegawaiYantek as $pegawai)
                                    <option value="{{ $pegawai->id }}" {{ old('user_id') == $pegawai->id ? 'selected' : '' }}>
                                        {{ $pegawai->name }} ({{ $pegawai->username }})
                                    </option>
                                @endforeach
                            </select>
                            @error('user_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="nama">Judul/Nama Tugas <span class="text-danger">*</span></label>
                            <input type="text" id="nama" name="nama" class="form-control @error('nama') is-invalid @enderror" placeholder="Contoh: Perbaikan Gangguan SR Area X" value="{{ old('nama') }}" required>
                            @error('nama')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="form-group mb-3">
                    <label for="email">Email Kontak Tambahan (Opsional)</label>
                    <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Masukkan email kontak terkait tugas" value="{{ old('email') }}">
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="deskripsi">Detail Deskripsi Tugas <span class="text-danger">*</span></label>
                    <textarea id="deskripsi" name="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror" placeholder="Masukkan deskripsi tugas secara lengkap" rows="4" required>{{ old('deskripsi') }}</textarea>
                    @error('deskripsi')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="lokasi">Lokasi Penugasan <span class="text-danger">*</span></label>
                    <input type="text" id="lokasi" name="lokasi" class="form-control @error('lokasi') is-invalid @enderror" placeholder="Contoh: Gardu Induk X, Jalan Merdeka No. 10" value="{{ old('lokasi') }}" required>
                    @error('lokasi')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="tanggal_mulai">Tanggal Mulai <span class="text-danger">*</span></label>
                            <input type="date" id="tanggal_mulai" name="tanggal_mulai" class="form-control @error('tanggal_mulai') is-invalid @enderror" value="{{ old('tanggal_mulai') }}" required>
                            @error('tanggal_mulai')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="tanggal_selesai">Tanggal Selesai <span class="text-danger">*</span></label>
                            <input type="date" id="tanggal_selesai" name="tanggal_selesai" class="form-control @error('tanggal_selesai') is-invalid @enderror" value="{{ old('tanggal_selesai') }}" required>
                            @error('tanggal_selesai')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="waktu_mulai">Waktu Mulai <span class="text-danger">*</span></label>
                            <input type="time" id="waktu_mulai" name="waktu_mulai" class="form-control @error('waktu_mulai') is-invalid @enderror" value="{{ old('waktu_mulai') }}" required>
                            @error('waktu_mulai')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="waktu_selesai">Waktu Selesai <span class="text-danger">*</span></label>
                            <input type="time" id="waktu_selesai" name="waktu_selesai" class="form-control @error('waktu_selesai') is-invalid @enderror" value="{{ old('waktu_selesai') }}" required>
                            @error('waktu_selesai')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="form-group mb-3">
                    <label for="status_tugas">Status Tugas Awal</label> {{-- Label diubah --}}
                    <select name="status_tugas" id="status_tugas" class="form-control @error('status_tugas') is-invalid @enderror">
                        <option value="baru" {{ old('status_tugas', 'baru') == 'baru' ? 'selected' : '' }}>Baru</option>
                        <option value="dikerjakan" {{ old('status_tugas') == 'dikerjakan' ? 'selected' : '' }}>Dikerjakan</option>
                        {{-- Opsi 'selesai', 'pending', 'batal' mungkin kurang relevan saat create --}}
                        {{-- <option value="selesai" {{ old('status_tugas') == 'selesai' ? 'selected' : '' }}>Selesai</option> --}}
                        {{-- <option value="pending" {{ old('status_tugas') == 'pending' ? 'selected' : '' }}>Pending</option> --}}
                        {{-- <option value="batal" {{ old('status_tugas') == 'batal' ? 'selected' : '' }}>Batal</option> --}}
                    </select>
                    @error('status_tugas')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <hr>
                <div class="d-flex justify-content-end">
                    <a href="{{ route('tugas.index') }}" class="btn btn-secondary mr-2"><i class="fas fa-times"></i> Batal</a>
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan Tugas</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    {{-- Script khusus jika ada --}}
@endpush