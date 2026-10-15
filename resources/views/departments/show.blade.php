<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Attendance</title>

    <!-- ✅ Bootstrap CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f8f9fa;
        }
        h1 {
            color: #1d3557;
            font-weight: 600;
        }
        .card {
            border-radius: 12px;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.08);
        }
        .table th {
            background-color: #212529;
            color: #fff;
            width: 35%;
        }
        .table td {
            background-color: #fff;
            vertical-align: middle;
        }
        .btn-primary {
            background-color: #1d3557;
            border-color: #1d3557;
        }
        .btn-primary:hover {
            background-color: #457b9d;
            border-color: #457b9d;
        }
    </style>
</head>

<body>
@extends('master')
@section('title', 'Detail Attendance')
@section('content')

<div class="container mt-5">
    <div class="card p-4">
        <h1 class="mb-4 text-center">Detail Attendance</h1>

        <div class="table-responsive">
            <table class="table table-bordered align-middle">
                <tr>
                    <th>Nama Pegawai</th>
                    <td>{{ $attendance->employee->nama_lengkap }}</td>
                </tr>
                <tr>
                    <th>Tanggal</th>
                    <td>{{ $attendance->tanggal }}</td>
                </tr>
                <tr>
                    <th>Status Absensi</th>
                    <td>{{ ucfirst($attendance->status_absensi) }}</td>
                </tr>
                <tr>
                    <th>Waktu Masuk</th>
                    <td>{{ $attendance->waktu_masuk ?? '-' }}</td>
                </tr>
                <tr>
                    <th>Waktu Keluar</th>
                    <td>{{ $attendance->waktu_keluar ?? '-' }}</td>
                </tr>
            </table>
        </div>

        <div class="text-center mt-4">
            <a href="{{ route('attendances.index') }}" class="btn btn-primary">
                ← Kembali ke Daftar Attendance
            </a>
        </div>
    </div>
</div>

@endsection

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
