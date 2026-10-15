<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Pegawai</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f8f9fa;
        }
        .card {
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        }
        h2 {
            color: #1d3557;
            font-weight: 600;
        }
        label {
            font-weight: 500;
            color: #333;
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
    @section('title', 'Edit Jenis Cuti')
    @section('content')

    <div class="container mt-5">
        <div class="card p-4">
            <h1 class="mb-4 text-center">Edit Jenis Cuti</h1>

            <form action="{{ route('leave_types.update', $leaveType->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="nama_jenis" class="form-label">Nama Jenis Cuti</label>
                    <input type="text" class="form-control" id="nama_jenis" name="nama_jenis"
                        value="{{ old('nama_jenis', $leaveType->nama_jenis) }}" required>
                    @error('nama_jenis') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="mb-3">
                    <label for="maksimal_hari" class="form-label">Maksimal Hari</label>
                    <input type="number" class="form-control" id="maksimal_hari" name="maksimal_hari"
                        value="{{ old('maksimal_hari', $leaveType->maksimal_hari) }}">
                    @error('maksimal_hari') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="mb-3">
                    <label for="keterangan" class="form-label">Keterangan</label>
                    <textarea class="form-control" id="keterangan" name="keterangan" rows="3">{{ old('keterangan', $leaveType->keterangan) }}</textarea>
                </div>

                <div class="text-end">
                    <a href="{{ route('leave_types.index') }}" class="btn btn-secondary">Kembali</a>
                    <button type="submit" class="btn btn-primary px-4">Update</button>
                </div>
            </form>
        </div>
    </div>

    @endsection

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
