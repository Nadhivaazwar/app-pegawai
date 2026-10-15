@extends('master')
@section('title', 'Ajukan Cuti')
@section('content')
<div class="container mt-5">
    <div class="card p-4">
        <h1 class="mb-4 text-center">Form Pengajuan Cuti</h1>

        {{-- error umum dari controller (misal akun belum terhubung dengan pegawai) --}}
        @if ($errors->has('leave'))
            <div class="alert alert-danger">
                {{ $errors->first('leave') }}
            </div>
        @endif

        <form action="{{ route('leaves.store') }}" method="POST">
            @csrf

            <div class="row g-3">
                {{-- Pegawai --}}
                <div class="col-md-6">
                    <label for="employee_id" class="form-label">Pegawai</label>

                    @if(($isEmployee ?? false) && $employees->count())
                        {{-- Pegawai: kunci ke dirinya sendiri --}}
                        @php $emp = $employees->first(); @endphp

                        {{-- dikirim ke backend --}}
                        <input type="hidden" name="employee_id" value="{{ $emp->id }}">

                        {{-- hanya tampil sebagai teks, tidak bisa diganti --}}
                        <input type="text"
                               class="form-control"
                               value="{{ $emp->nama_lengkap }}"
                               disabled>
                    @else
                        {{-- Admin / HR: boleh pilih pegawai --}}
                        <select name="employee_id" id="employee_id" class="form-select" required>
                            <option value="">-- Pilih Pegawai --</option>
                            @foreach($employees as $emp)
                                <option value="{{ $emp->id }}"
                                    {{ old('employee_id') == $emp->id ? 'selected' : '' }}>
                                    {{ $emp->nama_lengkap }}
                                </option>
                            @endforeach
                        </select>
                    @endif

                    @error('employee_id')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                {{-- Jenis Cuti --}}
                <div class="col-md-6">
                    <label for="leave_type_id" class="form-label">Jenis Cuti</label>
                    <select name="leave_type_id" id="leave_type_id" class="form-select" required>
                        <option value="">-- Pilih Jenis Cuti --</option>
                        @foreach($leave_types as $lt)
                            <option value="{{ $lt->id }}"
                                {{ old('leave_type_id') == $lt->id ? 'selected' : '' }}>
                                {{ $lt->nama_jenis }}
                            </option>
                        @endforeach
                    </select>
                    @error('leave_type_id')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                {{-- Tanggal Mulai --}}
                <div class="col-md-6">
                    <label for="tanggal_mulai" class="form-label">Tanggal Mulai</label>
                    <input type="date"
                           name="tanggal_mulai"
                           id="tanggal_mulai"
                           class="form-control"
                           value="{{ old('tanggal_mulai') }}"
                           required>
                    @error('tanggal_mulai')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                {{-- Tanggal Selesai --}}
                <div class="col-md-6">
                    <label for="tanggal_selesai" class="form-label">Tanggal Selesai</label>
                    <input type="date"
                           name="tanggal_selesai"
                           id="tanggal_selesai"
                           class="form-control"
                           value="{{ old('tanggal_selesai') }}"
                           required>
                    @error('tanggal_selesai')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                {{-- Alasan --}}
                <div class="col-md-12">
                    <label for="alasan" class="form-label">Alasan</label>
                    <textarea name="alasan"
                              id="alasan"
                              rows="3"
                              class="form-control">{{ old('alasan') }}</textarea>
                </div>

                {{-- Tombol --}}
                <div class="col-12 text-end mt-3">
                    <a href="{{ route('employee.dashboard') }}" class="btn btn-secondary">
                        Kembali
                    </a>
                    <button type="submit" class="btn btn-primary px-4">
                        Simpan
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
