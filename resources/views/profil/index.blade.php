@extends('layouts.app')

@section('content')

{{-- Pastikan Font Awesome sudah terpasang di layouts.app Anda --}}
{{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"> --}}

<div class="container-fluid mt-4"> {{-- Gunakan container-fluid untuk layout yang lebih lebar ala admin panel --}}

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800 fw-bold">Profil Admin</h1>
        {{-- Bisa tambahkan breadcrumb di sini jika perlu --}}
        {{-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> --}}
    </div>

    @if($user)
    <div class="row">
        <!-- Kolom Foto Profil -->
        <div class="col-xl-4 col-lg-5 mb-4">
            <div class="card shadow">
                <div class="card-header py-3 bg-primary">
                    <h6 class="m-0 font-weight-bold text-white text-center">Foto Profil</h6>
                </div>
                <div class="card-body text-center p-4">
                    <img src="{{ $user->profile_photo_url ?? asset('images/logo_pln.jpg') }}" {{-- Ganti 'default-avatar.png' dengan placeholder Anda --}}
                         alt="Foto Profil {{ $user->name }}"
                         class="img-fluid rounded-3 shadow-sm mx-auto" {{-- img-fluid, rounded-3 (sudut membulat) --}}
                         style="max-width: 250px; max-height: 250px; object-fit: cover; border: 3px solid #e3e6f0;">
                    <h4 class="my-3 fw-bold">{{ $user->name }}</h4>
                    <p class="text-muted mb-1">{{ $user->position == 'admin' ? 'Administrator' : 'Pelayanan Teknik (Yantek)' }}</p>
                    <p class="text-muted mb-4">{{ $user->penugasan ?? 'Tidak ada penugasan' }}</p>

                    {{-- <button class="btn btn-primary btn-sm"><i class="fas fa-edit me-1"></i> Edit Foto</button> --}}
                </div>
            </div>
        </div>

        <!-- Kolom Detail Pengguna -->
        <div class="col-xl-8 col-lg-7 mb-4">
            <div class="card shadow">
                <div class="card-header py-3 bg-primary d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-white">Detail Akun</h6>
                    {{-- Tombol aksi jika diperlukan --}}
                    {{-- <a href="#" class="btn btn-sm btn-light"><i class="fas fa-user-edit me-1"></i> Edit Profil</a> --}}
                </div>
                <div class="card-body p-4">
                    <div class="row mb-3">
                        <div class="col-sm-3">
                            <h6 class="mb-0 fw-semibold"><i class="fas fa-user fa-fw me-2 text-gray-500"></i>Nama Lengkap</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                            {{ $user->name }}
                        </div>
                    </div>
                    <hr>
                    <div class="row mb-3">
                        <div class="col-sm-3">
                            <h6 class="mb-0 fw-semibold"><i class="fas fa-envelope fa-fw me-2 text-gray-500"></i>Email</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                            {{ $user->email }}
                        </div>
                    </div>
                    <hr>
                    <div class="row mb-3">
                        <div class="col-sm-3">
                            <h6 class="mb-0 fw-semibold"><i class="fas fa-briefcase fa-fw me-2 text-gray-500"></i>Jabatan</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                            {{ $user->position == 'admin' ? 'Administrator Sistem' : 'Staf Pelayanan Teknik (Yantek)' }}
                        </div>
                    </div>
                    <hr>
                    <div class="row mb-3">
                        <div class="col-sm-3">
                            <h6 class="mb-0 fw-semibold"><i class="fas fa-map-marker-alt fa-fw me-2 text-gray-500"></i>Area Penugasan</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                            {{ $user->penugasan ?? '-' }}
                        </div>
                    </div>
                    <hr>
                    <div class="row mb-3">
                        <div class="col-sm-3">
                            <h6 class="mb-0 fw-semibold"><i class="fas fa-calendar-alt fa-fw me-2 text-gray-500"></i>Terdaftar Sejak</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                            {{ $user->created_at ? $user->created_at->translatedFormat('d F Y, H:i') : '-' }}
                            {{-- Pastikan Carbon localization sudah di-setting di AppServiceProvider jika ingin 'translatedFormat' berfungsi dengan bahasa Indonesia --}}
                        </div>
                    </div>
                    {{-- <hr> --}}
                    
                </div>
            </div>
        </div>
    </div>
    @else
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-body text-center p-5">
                    <i class="fas fa-exclamation-triangle fa-3x text-warning mb-3"></i>
                    <h4 class="text-danger">Data Profil Tidak Ditemukan</h4>
                    <p class="text-muted">Maaf, kami tidak dapat menemukan data profil yang Anda cari. Silakan coba lagi atau hubungi administrator.</p>
                </div>
            </div>
        </div>
    </div>
    @endif

</div>
@endsection

@push('styles')
<style>
    /* SB Admin 2 uses a light gray background for the body by default */
    /* Jika layouts.app Anda belum memiliki ini, Anda bisa tambahkan: */
    /* body {
        background-color: #f8f9fc;
    } */

    .text-gray-800 { color: #5a5c69 !important; }
    .text-gray-500 { color: #b7b9cc !important; } /* Untuk ikon atau teks sekunder halus */

    .card-header.bg-primary {
        background-color: #003f7d !important; /* Warna biru primer SB Admin 2 */
        border-bottom: 1px solid #ffb81c;
    }
    .img-fluid.rounded-3 {
        border-radius: .4rem !important; /* Sedikit lebih halus dari .25rem default */
    }

    /* Style untuk hr yang lebih halus */
    hr {
        margin-top: 1rem;
        margin-bottom: 1rem;
        border: 0;
        border-top: 1px solid rgba(0,0,0,.1);
    }
</style>
@endpush

@push('scripts')
<script>
    // console.log('Halaman profil gaya SB Admin 2 dimuat.');
</script>
@endpush