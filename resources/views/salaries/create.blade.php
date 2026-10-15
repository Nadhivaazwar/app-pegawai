<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Input Gaji Pegawai</title>

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
        label {
            font-weight: 500;
            color: #343a40;
        }
        .btn-primary {
            background-color: #1d3557;
            border-color: #1d3557;
        }
        .btn-primary:hover {
            background-color: #457b9d;
            border-color: #457b9d;
        }
        .form-control:focus, .form-select:focus {
            border-color: #457b9d;
            box-shadow: 0 0 0 0.2rem rgba(69, 123, 157, 0.25);
        }
    </style>
</head>

<body>
@extends('master')
@section('title', 'Form Input Gaji Pegawai')
@section('content')

<div class="container mt-5">
    <div class="card p-4">
        <h1 class="text-center mb-4">Form Input Gaji Pegawai</h1>

        <form action="{{ route('salaries.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="employee_id" class="form-label">Nama Pegawai:</label>
                <select id="employee_id" name="employee_id" class="form-select" required onchange="setGajiPokok()">
                    <option value="">-- Pilih Pegawai --</option>
                    @foreach ($employees as $employee)
                        <option 
                            value="{{ $employee->id }}" 
                            data-gaji="{{ $employee->position->gaji_pokok ?? 0 }}">
                            {{ $employee->nama_lengkap }} ({{ $employee->position->nama_jabatan ?? 'Tidak Ada Jabatan' }})
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="bulan" class="form-label">Bulan:</label>
                <input type="month" id="bulan" name="bulan" class="form-control" value="{{ old('bulan') }}" required>
            </div>

            <div class="mb-3">
                <label for="gaji_pokok" class="form-label">Gaji Pokok:</label>
                <input type="number" id="gaji_pokok" name="gaji_pokok" class="form-control" required readonly>
            </div>

            <div class="mb-3">
                <label for="tunjangan" class="form-label">Tunjangan:</label>
                <input type="number" id="tunjangan" name="tunjangan" class="form-control" value="0">
            </div>

            <div class="mb-3">
                <label for="potongan" class="form-label">Potongan:</label>
                <input type="number" id="potongan" name="potongan" class="form-control" value="0">
            </div>

            <div class="text-end">
                <a href="{{ route('salaries.index') }}" class="btn btn-secondary me-2">Kembali</a>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>

<script>
    function setGajiPokok() {
        const select = document.getElementById('employee_id');
        const selected = select.options[select.selectedIndex];
        const gaji = selected.getAttribute('data-gaji');
        document.getElementById('gaji_pokok').value = gaji;
    }
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@endsection
</body>
</html>
