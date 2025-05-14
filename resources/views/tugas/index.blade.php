@extends('layouts.app')

@section('title', 'Daftar Penjadwalan Tugas')

@push('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap4.min.css">
    <style>
        .badge-status.status-baru { background-color: #003f7d; color: white; }
        .badge-status.status-dikerjakan { background-color: #ffc107; color: black; }
        .badge-status.status-selesai { background-color: #28a745; color: white; }
        .badge-status.status-pending { background-color: #6c757d; color: white; }
        .badge-status.status-batal { background-color: #dc3545; color: white; }
        .table-responsive .btn-sm { margin-bottom: .25rem; }
    </style>
@endpush

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-tasks mr-2"></i>Daftar Penjadwalan Tugas</h1>
        <a href="{{ route('tugas.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-plus fa-sm text-white-50 mr-1"></i> Tambah Tugas Baru
        </a>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle mr-2"></i>{{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-times-circle mr-2"></i>{{ session('error') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex flex-wrap align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Data Tugas Terjadwal</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover" id="dataTableTugas" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th class="text-center" style="width: 5%;">No</th> <!-- TH 1 -->
                            <th>Judul Tugas</th> <!-- TH 2 -->
                            <th>Pegawai Ditugaskan</th> <!-- TH 3 -->
                            <th>Lokasi</th> <!-- TH 4 -->
                            <th>Tanggal & Waktu Mulai</th> <!-- TH 5 -->
                            <th class="text-center">Status</th> <!-- TH 6 -->
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($tugas as $item)
                            <tr>
                                <td class="text-center">{{ $loop->iteration + ($tugas->currentPage() - 1) * $tugas->perPage() }}</td> <!-- TD 1 -->
                                <td>
                                    <a href="{{ route('tugas.show', $item->id) }}" title="Lihat Detail Tugas: {{ $item->nama }}">{{ $item->nama }}</a>
                                    <br><small class="text-muted">{{ Str::limit($item->deskripsi, 70) }}</small>
                                </td> <!-- TD 2 -->
                                <td>
                                    {{ $item->user->name ?? 'Belum Ditugaskan' }}
                                    @if($item->user)
                                        <br><small class="text-muted">({{ $item->user->username ?? $item->user->email }})</small>
                                    @elseif($item->email)
                                        <br><small class="text-muted">Kontak: {{ $item->email }}</small>
                                    @endif
                                </td> <!-- TD 3 -->
                                <td>{{ $item->lokasi }}</td> <!-- TD 4 -->
                                <td>
                                    {{ $item->tanggal_mulai ? \Carbon\Carbon::parse($item->tanggal_mulai)->translatedFormat('d M Y') : '-' }}
                                    @if($item->waktu_mulai && $item->waktu_selesai)
                                        <br><small class="text-muted">{{ \Carbon\Carbon::parse($item->waktu_mulai)->format('H:i') }} - {{ \Carbon\Carbon::parse($item->waktu_selesai)->format('H:i') }}</small>
                                    @elseif($item->waktu_mulai)
                                        <br><small class="text-muted">{{ \Carbon\Carbon::parse($item->waktu_mulai)->format('H:i') }}</small>
                                    @endif
                                </td> <!-- TD 5 -->
                                <td class="text-center">
                                    @php
                                        $statusNormalized = strtolower(str_replace(' ', '-', $item->status_tugas ?? 'baru'));
                                    @endphp
                                    <span class="badge badge-status status-{{ $statusNormalized }}">
                                        {{ Str::ucfirst($item->status_tugas ?? 'Baru') }}
                                    </span>
                                </td> <!-- TD 6 -->
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">Belum ada data tugas terjadwal.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if($tugas->hasPages())
            <div class="mt-3 d-flex justify-content-center">
                {{ $tugas->links() }}
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
            try {
                $('#dataTableTugas').DataTable({
                    "language": { "url": "//cdn.datatables.net/plug-ins/1.13.6/i18n/id.json" },
                    "columnDefs": [
                        // Kolom 'No' (indeks 0) dan 'Status' (indeks 5) tidak bisa diurutkan.
                        { "orderable": false, "targets": [0, 5] } 
                    ],
                     "paging":   false, 
                     "info":     false, 
                     "searching": true,
                });
            } catch (e) {
                console.error("Error initializing DataTables: ", e);
                // Tampilkan pesan error di console jika ada masalah saat inisialisasi
            }
        });
    </script>
@endpush