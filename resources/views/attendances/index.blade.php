<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Attendance</title>

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
            text-align: center;
        }
        .table td {
            text-align: center;
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
        .btn-warning {
            background-color: #ffc107;
            border-color: #ffc107;
            color: #212529;
        }
        .btn-warning:hover {
            background-color: #e0a800;
            border-color: #d39e00;
        }
    </style>
</head>

<body>
@extends('master')
@section('title', 'Data Attendance')
@section('content')

<div class="container mt-5">
    <div class="card p-4">
        <h1 class="mb-4 text-center">Daftar Absensi Pegawai</h1>

        <div class="d-flex justify-content-between align-items-center mb-3">
            <a href="{{ route('attendances.create') }}" class="btn btn-primary">
                + Tambah Data Absensi
            </a>
        </div>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="table-responsive">
            <table class="table table-striped table-bordered align-middle">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Tanggal</th>
                        <th>Waktu Masuk</th>
                        <th>Waktu Keluar</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($attendances as $attendance)
                    <tr>
                        <td>{{ $attendance->employee->nama_lengkap }}</td>
                        <td>{{ $attendance->tanggal }}</td>
                        <td>{{ $attendance->waktu_masuk ?? '-' }}</td>
                        <td>{{ $attendance->waktu_keluar ?? '-' }}</td>
                        <td>
                            <span class="badge 
                                @if($attendance->status_absensi == 'hadir') bg-success 
                                @elseif($attendance->status_absensi == 'izin') bg-warning text-dark 
                                @else bg-danger @endif">
                                {{ ucfirst($attendance->status_absensi) }}
                            </span>
                        </td>
                        <td>
                            <a href="{{ route('attendances.show', $attendance->id) }}" class="btn btn-sm btn-info text-white">Detail</a>
                            <a href="{{ route('attendances.edit', $attendance->id) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('attendances.destroy', $attendance->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Yakin ingin menghapus?')" class="btn btn-sm btn-danger">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection

<!-- ✅ Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
