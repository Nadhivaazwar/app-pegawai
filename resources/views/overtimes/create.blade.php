@extends('master')
@section('title', 'Tambah Lembur')

@section('content')
<div class="container mt-5">
    <div class="card p-4">
        <h1 class="mb-4 text-center">Tambah Data Lembur</h1>

        <form action="{{ route('overtimes.store') }}" method="POST">
            @csrf

            <div class="row g-3">
                {{-- Pegawai --}}
                <div class="col-md-6">
                    <label for="employee_id" class="form-label">Pegawai</label>
                    <select name="employee_id" id="employee_id" class="form-select" required>
                        <option value="">-- Pilih Pegawai --</option>
                        @foreach($employees as $emp)
                            <option value="{{ $emp->id }}" {{ old('employee_id') == $emp->id ? 'selected' : '' }}>
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
                           value="{{ old('tanggal') }}"
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
                           value="{{ old('jam_mulai') }}"
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
                           value="{{ old('jam_selesai') }}"
                           required>
                    @error('jam_selesai')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                {{-- Tarif per jam (fixed) --}}
                <div class="col-md-6">
                    <label class="form-label">Tarif per Jam</label>

                    {{-- tampil ke user, tidak bisa diubah --}}
                    <input type="text"
                           class="form-control"
                           value="Rp {{ number_format($tarifPerJam, 0, ',', '.') }}"
                           readonly>

                    {{-- dikirim ke backend --}}
                    <input type="hidden" name="tarif_per_jam" value="{{ $tarifPerJam }}">

                    @error('tarif_per_jam')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="col-12 text-end mt-3">
                    <a href="{{ route('overtimes.index') }}" class="btn btn-secondary">Kembali</a>
                    <button type="submit" class="btn btn-primary px-4">Simpan</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
