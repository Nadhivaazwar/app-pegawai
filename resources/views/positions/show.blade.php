<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Jabatan</title>

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
            padding: 25px;
        }
        .table th {
            background-color: #212529;
            color: #fff;
            width: 35%;
        }
        .table td {
            background-color: #fff;
        }
        .btn-primary {
            background-color: #1d3557;
            border-color: #1d3557;
        }
        .btn-primary:hover {
            background-color: #457b9d;
            border-color: #457b9d;
        }
        .btn-secondary {
            background-color: #6c757d;
            border-color: #6c757d;
        }
        .btn-secondary:hover {
            background-color: #5a6268;
            border-color: #545b62;
        }
    </style>
</head>

<body>
@extends('master')
@section('title', 'Detail Jabatan')
@section('content')

<div class="container mt-5">
    <div class="card">
        <h1 class="text-center mb-4">Detail Jabatan</h1>

        <table class="table table-bordered">
            <tr>
                <th>Nama Jabatan</th>
                <td>{{ $position->nama_jabatan }}</td>
            </tr>
            <tr>
                <th>Gaji Pokok</th>
                <td>Rp {{ number_format($position->gaji_pokok, 0, ',', '.') }}</td>
            </tr>
        </table>

        <div class="text-center mt-4">
            <a href="{{ route('positions.index') }}" class="btn btn-secondary">
                ← Kembali ke Daftar Jabatan
            </a>
        </div>
    </div>
</div>

@endsection

<!-- ✅ Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
