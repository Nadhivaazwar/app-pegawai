<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Pegawai</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Poppins', sans-serif;
        }
        .card {
            border-radius: 12px;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.08);
        }
        .card-header {
            background-color: #1d3557;
            color: #fff;
            text-align: center;
            font-weight: 600;
        }
        .table th {
            background-color: #212529;
            color: #fff;
            width: 35%;
        }
        .table td {
            background-color: #fff;
            color: #212529;
        }
        .btn-primary {
            background-color: #1d3557;
            border-color: #1d3557;
            border-radius: 8px;
        }
        .btn-primary:hover {
            background-color: #457b9d;
            border-color: #457b9d;
        }
        .badge-status {
            padding: 6px 10px;
            border-radius: 6px;
            font-size: 0.9rem;
        }
        .badge-status.aktif {
            background-color: #198754;
            color: #fff;
        }
        .badge-status.nonaktif {
            background-color: #6c757d;
            color: #fff;
        }
    </style>
</head>

<body>
    @extends('master')
    @section('title', 'Detail Lembur')
    @section('content')

    <div class="container mt-5">
        <div class="card">
            <div class="card-header bg-dark text-white text-center">
                <h3 class="mb-0">Detail Lembur Pegawai</h3>
            </div>
            <div class="card-body">
                <table class="table table-bordered align-middle">
                    <tr>
                        <th>Pegawai</th>
                        <td>{{ $overtime->employee->nama_lengkap ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Tanggal</th>
                        <td>{{ $overtime->tanggal }}</td>
                    </tr>
                    <tr>
                        <th>Jam Mulai</th>
                        <td>{{ $overtime->jam_mulai }}</td>
                    </tr>
                    <tr>
                        <th>Jam Selesai</th>
                        <td>{{ $overtime->jam_selesai }}</td>
                    </tr>
                    <tr>
                        <th>Total Jam</th>
                        <td>{{ $overtime->total_jam }}</td>
                    </tr>
                    <tr>
                        <th>Tarif per Jam</th>
                        <td>{{ number_format($overtime->tarif_per_jam) }}</td>
                    </tr>
                    <tr>
                        <th>Total Lembur</th>
                        <td>{{ number_format($overtime->total_lembur) }}</td>
                    </tr>
                </table>
            </div>
            <div class="card-footer text-center bg-light">
                <a href="{{ route('overtimes.index') }}" class="btn btn-primary">
                    ← Kembali ke Daftar Lembur
                </a>
            </div>
        </div>
    </div>

    @endsection

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
