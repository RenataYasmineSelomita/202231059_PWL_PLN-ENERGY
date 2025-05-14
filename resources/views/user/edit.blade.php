@extends('layouts.app')

@section('title', 'Edit Data Pegawai Pelayanan Teknik') {{-- JUDUL HALAMAN --}}

@push('styles')
    {{-- Style khusus untuk halaman ini jika ada --}}
@endpush

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-user-edit mr-2"></i>Edit Data Pegawai</h1> {{-- JUDUL BAGIAN --}}
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
            {{-- Variabel dari controller adalah $user, tetap gunakan itu --}}
            <h6 class="m-0 font-weight-bold text-primary">Formulir Edit Pegawai: {{ $user->name }}</h6> {{-- JUDUL CARD --}}
        </div>
        <div class="card-body">
            <form action="{{ route('user.update', $user->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group mb-3">
                    <label for="name">Nama Lengkap <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $user->name) }}" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="username">Username <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('username') is-invalid @enderror" id="username" name="username" value="{{ old('username', $user->username) }}" required>
                    @error('username')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="email">Email <span class="text-danger">*</span></label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $user->email) }}" required>
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="position_display">Jabatan</label>
                    <input type="text" class="form-control" id="position_display" value="Pelayanan Teknik (Yantek)" readonly>
                </div>

                <div class="form-group mb-3" id="penugasan-container-edit">
                    <label>Pilih Penugasan <span class="text-danger">*</span></label>
                     @if(isset($penugasanOptions) && count($penugasanOptions) > 0)
                        @foreach ($penugasanOptions as $option)
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="penugasan[]" value="{{ $option }}" id="penugasan_edit_{{ $loop->index }}"
                                       {{ (is_array(old('penugasan', $user->penugasan)) && in_array($option, old('penugasan', $user->penugasan))) ? 'checked' : '' }}>
                                <label class="form-check-label" for="penugasan_edit_{{ $loop->index }}">
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
                    <label for="status">Status <span class="text-danger">*</span></label>
                    <select name="status" id="status" class="form-control @error('status') is-invalid @enderror" required>
                        <option value="belum ditugaskan" {{ old('status', $user->status) == 'belum ditugaskan' ? 'selected' : '' }}>Belum Ditugaskan</option>
                        <option value="sudah ditugaskan" {{ old('status', $user->status) == 'sudah ditugaskan' ? 'selected' : '' }}>Sudah Ditugaskan</option>
                    </select>
                     @error('status')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <hr>
                <h6 class="text-muted">Ubah Password (Kosongkan jika tidak ingin diubah)</h6>
                <div class="form-group mb-3">
                    <label for="password">Password Baru</label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Min. 8 karakter jika ingin diubah">
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="password_confirmation">Konfirmasi Password Baru</label>
                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Ulangi password baru">
                </div>

                <hr>
                <div class="d-flex justify-content-end">
                    <a href="{{ route('user.index') }}" class="btn btn-secondary mr-2">
                        <i class="fas fa-times"></i> Batal
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Update Pegawai {{-- TEKS TOMBOL --}}
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
{{-- Tidak ada JavaScript khusus yang diperlukan lagi untuk toggle --}}
@endpush