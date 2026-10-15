<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Pengajuan Cuti</title>
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
    @section('title', 'Edit Pengajuan Cuti')
    @section('content')

    <div class="container mt-5">
        <div class="card p-4">
            <h1 class="mb-4 text-center">Edit Pengajuan Cuti</h1>

            <form action="{{ route('leaves.update', $leave->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="employee_id" class="form-label">Pegawai</label>
                        <select name="employee_id" id="employee_id" class="form-select" required>
                            @foreach($employees as $emp)
                                <option value="{{ $emp->id }}"
                                    {{ old('employee_id', $leave->employee_id) == $emp->id ? 'selected' : '' }}>
                                    {{ $emp->nama_lengkap }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label for="leave_type_id" class="form-label">Jenis Cuti</label>
                        <select name="leave_type_id" id="leave_type_id" class="form-select" required>
                            @foreach($leave_types as $lt)
                                <option value="{{ $lt->id }}"
                                    {{ old('leave_type_id', $leave->leave_type_id) == $lt->id ? 'selected' : '' }}>
                                    {{ $lt->nama_jenis }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label for="tanggal_mulai" class="form-label">Tanggal Mulai</label>
                        <input type="date" name="tanggal_mulai" id="tanggal_mulai"
                            class="form-control" value="{{ old('tanggal_mulai', $leave->tanggal_mulai) }}" required>
                    </div>

                    <div class="col-md-6">
                        <label for="tanggal_selesai" class="form-label">Tanggal Selesai</label>
                        <input type="date" name="tanggal_selesai" id="tanggal_selesai"
                            class="form-control" value="{{ old('tanggal_selesai', $leave->tanggal_selesai) }}" required>
                    </div>

                    <div class="col-md-12">
                        <label for="alasan" class="form-label">Alasan</label>
                        <textarea name="alasan" id="alasan" rows="3" class="form-control">{{ old('alasan', $leave->alasan) }}</textarea>
                    </div>

                    <div class="col-12 text-end mt-3">
                        <a href="{{ route('leaves.index') }}" class="btn btn-secondary">Kembali</a>
                        <button type="submit" class="btn btn-primary px-4">Update</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    @endsection


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
