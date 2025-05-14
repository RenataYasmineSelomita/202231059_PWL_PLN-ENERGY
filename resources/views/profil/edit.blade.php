{{-- resources/views/profil/edit.blade.php --}}
@extends('layouts.app')

@section('title', 'Edit Profil Saya')

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0"><i class="fas fa-user-edit mr-2"></i>Edit Profil Saya</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('profil.index') }}">Profil Saya</a></li>
                <li class="breadcrumb-item active">Edit Profil</li>
            </ol>
        </div>
    </div>
@stop

@section('content')
<div class="container-fluid">
    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h5><i class="icon fas fa-ban"></i> Gagal menyimpan perubahan!</h5>
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Formulir Edit Profil</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        @if(isset($user) && $user instanceof \App\Models\User)
            <form action="{{ route('profil.update') }}" method="POST" id="formEditProfil"> {{-- Tambahkan id jika perlu untuk JS --}}
                @csrf
                @method('PUT')
                <div class="card-body">
                    <div class="form-group row">
                        <label for="name" class="col-sm-3 col-form-label text-sm-right">Nama Lengkap <span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $user->name) }}" placeholder="Masukkan nama lengkap" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="email" class="col-sm-3 col-form-label text-sm-right">Email <span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $user->email) }}" placeholder="Masukkan alamat email" required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="username" class="col-sm-3 col-form-label text-sm-right">Username</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control @error('username') is-invalid @enderror" id="username" name="username" value="{{ old('username', $user->username) }}" placeholder="Masukkan username (opsional)">
                            @error('username')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="lokasi" class="col-sm-3 col-form-label text-sm-right">Lokasi</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control @error('lokasi') is-invalid @enderror" id="lokasi" name="lokasi" value="{{ old('lokasi', $user->lokasi) }}" placeholder="Masukkan lokasi (opsional)">
                            @error('lokasi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label text-sm-right">Jabatan</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" value="@if($user->position == 'admin')Administrator @elseif($user->position == 'yantek')Pelayanan Teknik @else{{ $user->position ? Str::ucfirst($user->position) : '-' }}@endif" readonly
                                   title="Jabatan tidak dapat diubah melalui halaman ini.">
                        </div>
                    </div>

                    {{-- Jika Anda ingin mengizinkan upload foto profil di sini, tambahkan field file --}}
                    {{--
                    <div class="form-group row">
                        <label for="profile_photo" class="col-sm-3 col-form-label text-sm-right">Ganti Foto Profil</label>
                        <div class="col-sm-9">
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input @error('profile_photo') is-invalid @enderror" id="profile_photo" name="profile_photo">
                                    <label class="custom-file-label" for="profile_photo">Pilih file gambar...</label>
                                </div>
                            </div>
                            @error('profile_photo')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                            <small class="form-text text-muted">Kosongkan jika tidak ingin mengganti foto. Maksimal 2MB (JPG, PNG, GIF).</small>
                            @if($user->profile_photo_path)
                                <img src="{{ $user->profile_photo_url }}" alt="Current Profile Photo" class="img-thumbnail mt-2" style="max-height: 100px;">
                            @endif
                        </div>
                    </div>
                    --}}

                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save mr-1"></i> Simpan Perubahan</button>
                    <a href="{{ route('profil.index') }}" class="btn btn-secondary float-right"><i class="fas fa-times mr-1"></i> Batal</a>
                </div>
                <!-- /.card-footer -->
            </form>
       
    </div>
    <!-- /.card -->
</div><!-- /.container-fluid -->
@endsection

@push('scripts')
{{-- Jika menggunakan custom file input Bootstrap untuk foto profil --}}
{{-- <script>
$(function () {
  bsCustomFileInput.init();
});
</script> --}}
{{-- Atau script untuk menampilkan nama file pada custom file input --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const fileInput = document.querySelector('input[type="file"].custom-file-input');
        if (fileInput) {
            fileInput.addEventListener('change', function (e) {
                let fileName = e.target.files[0] ? e.target.files[0].name : 'Pilih file gambar...';
                let nextSibling = e.target.nextElementSibling;
                if (nextSibling && nextSibling.classList.contains('custom-file-label')) {
                    nextSibling.innerText = fileName;
                }
            });
        }
    });
</script>
@endpush