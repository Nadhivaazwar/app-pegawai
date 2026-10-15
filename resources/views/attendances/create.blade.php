<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Input Attendance</title>

    <!-- ✅ Bootstrap CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f8f9fa;
        }
        h1 {
            color: #1d3557;
            font-weight: 600;
            text-align: center;
        }
        .card {
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.08);
        }
        label {
            font-weight: 600;
            color: #343a40;
        }
        .form-control, .form-select {
            border-radius: 8px;
        }
        .btn-primary {
            background-color: #1d3557;
            border-color: #1d3557;
            transition: 0.3s;
        }
        .btn-primary:hover {
            background-color: #457b9d;
            border-color: #457b9d;
        }
        .btn-secondary {
            background-color: #adb5bd;
            border-color: #adb5bd;
        }
        .btn-secondary:hover {
            background-color: #6c757d;
            border-color: #6c757d;
        }
    </style>
</head>

<body>
@extends('master')
@section('title', 'Form Attendance')
@section('content')

<div class="container mt-5">
    <div class="card p-4 mx-auto" style="max-width: 600px;">
        <h1 class="mb-4">Form Attendance</h1>

        <form action="{{ route('attendances.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="employee_id" class="form-label">Nama Pegawai</label>
                <select name="employee_id" id="employee_id" class="form-select" required>
                    <option value="" selected disabled>-- Pilih Pegawai --</option>
                    @foreach ($employees as $employee)
                        <option value="{{ $employee->id }}">{{ $employee->nama_lengkap }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="tanggal" class="form-label">Tanggal</label>
                <input type="date" id="tanggal" name="tanggal" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="status_absensi" class="form-label">Status Absensi</label>
                <select name="status_absensi" id="status_absensi" class="form-select" required>
                    <option value="" selected disabled>-- Pilih Kehadiran --</option>
                    @foreach (['hadir', 'izin', 'sakit', 'alpha'] as $status)
                        <option value="{{ $status }}">{{ ucfirst($status) }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="waktu_masuk" class="form-label">Waktu Masuk</label>
                <input type="time" id="waktu_masuk" name="waktu_masuk" class="form-control">
            </div>

            <div class="mb-3">
                <label for="waktu_keluar" class="form-label">Waktu Keluar</label>
                <input type="time" id="waktu_keluar" name="waktu_keluar" class="form-control">
            </div>

            <div class="text-end">
                <a href="{{ route('attendances.index') }}" class="btn btn-secondary me-2">Batal</a>
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
