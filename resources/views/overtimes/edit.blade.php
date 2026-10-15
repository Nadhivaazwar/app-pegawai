<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Lembur</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f8f9fa;
        }
        .card {
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        }
        h1 {
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
    @section('title', 'Edit Lembur')
    @section('content')

    <div class="container mt-5">
        <div class="card p-4">
            <h1 class="mb-4 text-center">Edit Data Lembur</h1>

            <form action="{{ route('overtimes.update', $overtime->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row g-3">
                    {{-- Pegawai --}}
                    <div class="col-md-6">
                        <label for="employee_id" class="form-label">Pegawai</label>
                        <select name="employee_id" id="employee_id" class="form-select" required>
                            @foreach($employees as $emp)
                                <option value="{{ $emp->id }}"
                                    {{ old('employee_id', $overtime->employee_id) == $emp->id ? 'selected' : '' }}>
                                    {{ $emp->nama_lengkap }}
                                </option>
                            @endforeach
                        </select>
                        @error('employee_id')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    {{-- Tanggal --}}
                    <div class="col-md-6">
                        <label for="tanggal" class="form-label">Tanggal</label>
                        <input type="date"
                               name="tanggal"
                               id="tanggal"
                               class="form-control"
                               value="{{ old('tanggal', $overtime->tanggal) }}"
                               required>
                        @error('tanggal')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    {{-- Jam mulai --}}
                    <div class="col-md-6">
                        <label for="jam_mulai" class="form-label">Jam Mulai</label>
                        <input type="time"
                               name="jam_mulai"
                               id="jam_mulai"
                               class="form-control"
                               value="{{ old('jam_mulai', $overtime->jam_mulai) }}"
                               required>
                        @error('jam_mulai')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    {{-- Jam selesai --}}
                    <div class="col-md-6">
                        <label for="jam_selesai" class="form-label">Jam Selesai</label>
                        <input type="time"
                               name="jam_selesai"
                               id="jam_selesai"
                               class="form-control"
                               value="{{ old('jam_selesai', $overtime->jam_selesai) }}"
                               required>
                        @error('jam_selesai')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    {{-- Tarif per jam (fixed) --}}
                    <div class="col-md-6">
                        <label class="form-label">Tarif per Jam</label>

                        {{-- dikirim ke backend --}}
                        <input type="hidden" name="tarif_per_jam" value="{{ $tarifPerJam }}">

                        {{-- hanya ditampilkan --}}
                        <input type="text"
                               class="form-control"
                               value="Rp {{ number_format($tarifPerJam, 0, ',', '.') }}"
                               disabled>
                        @error('tarif_per_jam')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="col-12 text-end mt-3">
                        <a href="{{ route('overtimes.index') }}" class="btn btn-secondary">Kembali</a>
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
