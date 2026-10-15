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
@section('title', 'Detail Pegawai')
@section('content')

<div class="container mt-5">
    <div class="card">
        <div class="card-header py-3">
            <h3 class="mb-0">Detail Pegawai</h3>
        </div>
        <div class="card-body">
            <table class="table table-bordered align-middle">
                <tr>
                    <th>Nama Lengkap</th>
                    <td>{{ $employee->nama_lengkap }}</td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td>{{ $employee->email }}</td>
                </tr>
                <tr>
                    <th>Nomor Telepon</th>
                    <td>{{ $employee->nomor_telepon }}</td>
                </tr>
                <tr>
                    <th>Tanggal Lahir</th>
                    <td>{{ $employee->tanggal_lahir }}</td>
                </tr>
                <tr>
                    <th>Alamat</th>
                    <td>{{ $employee->alamat }}</td>
                </tr>
                <tr>
                    <th>Tanggal Masuk</th>
                    <td>{{ $employee->tanggal_masuk }}</td>
                </tr>
                <tr>
                    <th>Nama Department</th>
                    <td>{{ $employee->department->nama_department }}</td>
                </tr>
                <tr>
                    <th>Nama Jabatan</th>
                    <td>{{ $employee->position->nama_jabatan }}</td>
                </tr>
                <tr>
                    <th>Status</th>
                    <td>
                        <span class="badge-status {{ $employee->status == 'aktif' ? 'aktif' : 'nonaktif' }}">
                            {{ ucfirst($employee->status) }}
                        </span>
                    </td>
                </tr>
            </table>
        </div>
        <div class="card-footer text-center bg-light">
            <a href="{{ route('employees.index') }}" class="btn btn-primary">
                ← Kembali ke Daftar Pegawai
            </a>
        </div>
    </div>
</div>

@endsection

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
