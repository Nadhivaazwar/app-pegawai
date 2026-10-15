<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Gaji Pegawai</title>

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
        .btn-secondary {
            background-color: #6c757d;
            border-color: #6c757d;
        }
        .btn-secondary:hover {
            background-color: #5a6268;
            border-color: #545b62;
        }
        .form-control:focus, .form-select:focus {
            border-color: #457b9d;
            box-shadow: 0 0 0 0.2rem rgba(69, 123, 157, 0.25);
        }
    </style>
</head>

<body>
@extends('master')
@section('title', 'Edit Data Gaji Pegawai')
@section('content')

<div class="container mt-5">
    <div class="card p-4">
        <h1 class="text-center mb-4">Edit Data Gaji Pegawai</h1>

        <form action="{{ route('salaries.update', $salary->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="employee_id" class="form-label">Nama Pegawai</label>
                <select name="employee_id" id="employee_id" class="form-select" required onchange="updateGajiPokok()">
                    @foreach ($employees as $employee)
                        <option 
                            value="{{ $employee->id }}" 
                            data-gaji="{{ $employee->position->gaji_pokok ?? 0 }}"
                            {{ $salary->employee_id == $employee->id ? 'selected' : '' }}>
                            {{ $employee->nama_lengkap }} 
                            ({{ $employee->position->nama_jabatan ?? 'Tidak Ada Jabatan' }})
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="bulan" class="form-label">Bulan</label>
                <input type="text" name="bulan" id="bulan" 
                    class="form-control" 
                    value="{{ old('bulan', $salary->bulan) }}" required>
            </div>

            <div class="mb-3">
                <label for="gaji_pokok" class="form-label">Gaji Pokok</label>
                <input type="number" name="gaji_pokok" id="gaji_pokok" 
                    class="form-control" 
                    value="{{ old('gaji_pokok', $salary->gaji_pokok) }}" readonly>
            </div>

            <div class="mb-3">
                <label for="tunjangan" class="form-label">Tunjangan</label>
                <input type="number" name="tunjangan" id="tunjangan" 
                    class="form-control" 
                    value="{{ old('tunjangan', $salary->tunjangan) }}">
            </div>

            <div class="mb-3">
                <label for="potongan" class="form-label">Potongan</label>
                <input type="number" name="potongan" id="potongan" 
                    class="form-control" 
                    value="{{ old('potongan', $salary->potongan) }}">
            </div>

            <div class="text-end">
                <a href="{{ route('salaries.index') }}" class="btn btn-secondary me-2">Kembali</a>
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </form>
    </div>
</div>

@endsection

<script>
    function updateGajiPokok() {
        const select = document.getElementById('employee_id');
        const selectedOption = select.options[select.selectedIndex];
        const gaji = selectedOption.getAttribute('data-gaji');
        document.getElementById('gaji_pokok').value = gaji;
    }
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
