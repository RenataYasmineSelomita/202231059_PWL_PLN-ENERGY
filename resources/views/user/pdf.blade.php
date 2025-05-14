<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Pengguna</title>
    <style>
        /* CSS Umum */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
        }

        h3 {
            text-align: center;
            font-size: 24px;
            margin-bottom: 20px;
        }

        /* Styling Tabel */
        .custom-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 30px;
        }

        .custom-table th, .custom-table td {
            padding: 10px 15px;
            text-align: center;
            border: 1px solid #ddd;
        }

        .custom-table th {
            background-color: #f8f9fa;
            font-weight: bold;
        }

        .custom-table td {
            background-color: #ffffff;
        }

        /* Styling untuk header dan footer */
        .table-wrapper {
            position: relative;
            padding: 10px;
        }

        /* Watermark pada PDF - Dihapus saat print */
        .table-wrapper::before {
            content: "Sistem Penjadwalan PLN";
            position: absolute;
            font-size: 80px;
            color: rgba(0, 0, 0, 0.1);
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) rotate(-30deg);
            z-index: 0;
            pointer-events: none;
            white-space: nowrap;
        }

        /* Aturan untuk cetakan PDF */
        @media print {
            body {
                padding: 0;
                margin: 0;
            }

            .table-wrapper::before {
                content: none;  /* Hapus watermark saat cetak */
            }

            .custom-table th, .custom-table td {
                border: 1px solid black;
                padding: 8px;
                font-size: 12px;
            }

            h3 {
                font-size: 22px;
                margin-bottom: 10px;
            }

            /* Menambahkan margin di halaman */
            .container {
                margin-top: 10px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="table-wrapper">
            <h3>Daftar Pengguna</h3>
            <table class="custom-table">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Username</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->username }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="2" class="text-center">Belum ada data pengguna.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
