@extends('layouts.app')

@section('title', 'Tambah Pegawai Pelayanan Teknik') {{-- JUDUL HALAMAN --}}

@push('styles')
    {{-- Style khusus untuk halaman ini jika ada --}}
@endpush

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-user-plus mr-2"></i>Tambah Pegawai Pelayanan Teknik</h1> {{-- JUDUL BAGIAN --}}
        <a href="{{ route('user.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm">
            <i class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali ke Data Pegawai {{-- TEKS TOMBOL --}}
        </a>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <h5 class="alert-heading">Terjadi Kesalahan Validasi!</h5>
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Formulir Tambah Pegawai Pelayanan Teknik</h6> {{-- JUDUL CARD --}}
        </div>
        <div class="card-body">
            <form action="{{ route('user.store') }}" method="POST">
                @csrf

                <div class="form-group mb-3">
                    <label for="name">Nama Lengkap <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" placeholder="Masukkan nama lengkap" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="username">Username <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('username') is-invalid @enderror" id="username" name="username" value="{{ old('username') }}" placeholder="Masukkan username" required>
                    @error('username')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="email">Email <span class="text-danger">*</span></label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" placeholder="Masukkan alamat email" required>
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group mb-3" id="penugasan-container">
                    <label>Pilih Penugasan <span class="text-danger">*</span></label>
                    @if(isset($penugasanOptions) && count($penugasanOptions) > 0)
                        @foreach ($penugasanOptions as $option)
                            <div class="form-check">
                                <input class="form-check-input @error('penugasan.' . $loop->index) is-invalid @enderror"
                                       type="checkbox" name="penugasan[]" value="{{ $option }}" id="penugasan_{{ $loop->index }}"
                                       {{ (is_array(old('penugasan')) && in_array($option, old('penugasan'))) ? 'checked' : '' }}>
                                <label class="form-check-label" for="penugasan_{{ $loop->index }}">
                                    {{ $option }}
                                </label>
                            </div>
                        @endforeach
                        @error('penugasan')
                            <div class="text-danger d-block mt-1 small">{{ $message }}</div>
                        @enderror
                    @else
                        <p class="text-muted">Tidak ada opsi penugasan tersedia.</p>
                    @endif
                </div>

                <div class="form-group mb-3">
                    <label for="password">Password <span class="text-danger">*</span></label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Masukkan password (min. 8 karakter)" required>
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="password_confirmation">Konfirmasi Password <span class="text-danger">*</span></label>
                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Ulangi password" required>
                </div>

                <div class="form-group mb-3">
                    <label for="status">Status Awal <span class="text-danger">*</span></label>
                    <select name="status" id="status" class="form-control @error('status') is-invalid @enderror" required>
                        <option value="belum ditugaskan" {{ old('status', 'belum ditugaskan') == 'belum ditugaskan' ? 'selected' : '' }}>Belum Ditugaskan</option>
                        <option value="sudah ditugaskan" {{ old('status') == 'sudah ditugaskan' ? 'selected' : '' }}>Sudah Ditugaskan</option>
                    </select>
                     @error('status')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <hr>
                <div class="d-flex justify-content-end">
                     <a href="{{ route('user.index') }}" class="btn btn-secondary mr-2">
                        <i class="fas fa-times"></i> Batal
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Simpan Pegawai {{-- TEKS TOMBOL --}}
                    </button>
                </div>
            </form>
        </div>
    </div>

@endsection

@push('scripts')
{{-- Tidak ada JavaScript khusus yang diperlukan lagi untuk toggle --}}
@endpush