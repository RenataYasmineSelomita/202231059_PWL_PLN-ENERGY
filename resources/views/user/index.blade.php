{{-- resources/views/user/index.blade.php --}}

@extends('layouts.app')

@section('title', 'Manajemen Pegawai')

@push('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap4.min.css">
    <style>
        #dataTableUser td .btn {
            margin-bottom: .25rem; /* Jarak antar tombol jika jadi 2 baris */
            margin-right: .25rem; /* Jarak antar tombol jika sebaris */
        }
        #dataTableUser .text-center-aksi {
            text-align: center;
        }
        .penugasan-list {
            padding-left: 1.2rem; /* Indentasi list */
            margin-bottom: 0; /* Hapus margin bawah default ul */
            font-size: 0.85rem; /* Ukuran font lebih kecil untuk list */
        }
        .penugasan-list li {
            margin-bottom: 0.2rem; /* Jarak antar item list */
        }
    </style>
@endpush

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-users mr-2"></i>Manajemen Pegawai</h1>
        <div class="d-flex">
            <a href="{{ route('user.create') }}" class="btn btn-sm btn-primary shadow-sm mr-2">
                <i class="fas fa-plus fa-sm text-white-50 mr-1"></i> Tambah User
            </a>
        </div>
    </div>

    {{-- Pesan Sukses/Error DIKEMBALIKAN LANGSUNG KE SINI --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
    @endif
    {{-- Anda juga bisa menambahkan blok @if ($errors->any()) di sini jika diperlukan untuk error validasi global --}}
    {{-- @if ($errors->any())
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
    @endif --}}


    <!-- Data User Card -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Daftar Pegawai Terdaftar</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover" id="dataTableUser" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th class="text-center" width="5%">No</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Username</th>
                            <th class="text-center">Jabatan</th>
                            <th>Penugasan</th>
                            <th class="text-center">Status</th>
                            <th class="text-center" width="100px">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($users as $key => $user)
                            <tr>
                                <td class="text-center">
                                    @if(method_exists($users, 'currentPage')) {{-- Untuk pagination --}}
                                        {{ $loop->iteration + ($users->currentPage() - 1) * $users->perPage() }}
                                    @else
                                        {{ $key + 1 }}
                                    @endif
                                </td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->username }}</td>
                                <td class="text-center">{{ $user->position == 'yantek' ? 'Pelayanan Teknik' : ($user->position == 'admin' ? 'Admin' : Str::ucfirst($user->position)) }}</td>
                                <td>
                                    @if($user->position == 'yantek' && !empty($user->penugasan) && is_array($user->penugasan))
                                        <ul class="list-unstyled penugasan-list">
                                            @foreach($user->penugasan as $tugas)
                                                <li><i class="fas fa-check-circle fa-xs text-success mr-1"></i>{{ $tugas }}</li>
                                            @endforeach
                                        </ul>
                                    @elseif($user->position == 'yantek' && !empty($user->penugasan) && is_string($user->penugasan))
                                        <i class="fas fa-check-circle fa-xs text-success mr-1"></i>{{ $user->penugasan }}
                                    @else
                                        -
                                    @endif
                                </td>
                                <td class="text-center">
                                    <span class="badge badge-{{ $user->status == 'sudah' ? 'success' : 'secondary' }}">
                                        {{ $user->status == 'sudah' ? 'Ditugaskan' : 'Belum Ditugaskan' }}
                                    </span>
                                </td>
                                <td class="text-center-aksi">
                                    <a href="{{ route('user.edit', $user->id) }}" class="btn btn-sm btn-warning" title="Edit User">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('user.destroy', $user->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus user {{ $user->name }}? Tindakan ini tidak dapat dibatalkan.');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" title="Hapus User">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center">Belum ada data .</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if(method_exists($users, 'links') && $users->hasPages())
                <div class="mt-4 d-flex justify-content-center">
                    {{ $users->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#dataTableUser').DataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.13.6/i18n/id.json"
                },
                "columnDefs": [
                    { "orderable": false, "targets": [5, 7] }
                ],
                 "paging":   @if(method_exists($users, 'hasPages') && $users->hasPages()) false @else true @endif,
                 "info":     @if(method_exists($users, 'hasPages') && $users->hasPages()) false @else true @endif
            });
        });
    </script>
@endpush