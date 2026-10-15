<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Jabatan</title>

    <!-- ✅ Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f8f9fa;
            color: #212529;
        }
        h2 {
            color: #1d3557;
            font-weight: 600;
            text-align: center;
        }
        .card {
            border-radius: 12px;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.08);
            background: #fff;
        }
        .btn-primary {
            background-color: #1d3557;
            border-color: #1d3557;
        }
        .btn-primary:hover {
            background-color: #457b9d;
            border-color: #457b9d;
        }
        .form-label {
            font-weight: 500;
            color: #212529;
        }
    </style>
</head>
<body>
@extends('master')
@section('title', 'Tambah Jabatan')
@section('content')

<div class="container mt-5">
    <div class="card p-4 mx-auto" style="max-width: 500px;">
        <h2 class="mb-4">Form Tambah Jabatan</h2>

        <form action="{{ route('positions.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="nama_jabatan" class="form-label">Nama Jabatan</label>
                <input type="text" id="nama_jabatan" name="nama_jabatan" 
                       class="form-control" placeholder="Masukkan nama jabatan" required>
            </div>

            <div class="mb-3">
                <label for="gaji_pokok" class="form-label">Gaji Pokok</label>
                <input type="text" id="gaji_pokok" name="gaji_pokok" 
                       class="form-control" placeholder="Masukkan gaji pokok" required>
            </div>

            <div class="d-flex justify-content-between">
                <a href="{{ route('positions.index') }}" class="btn btn-secondary">Kembali</a>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>

@endsection

<!-- ✅ Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
