@extends('master')

@section('title', 'Profil Saya')

@section('content')
<div class="container mt-3">
    <h2 class="mb-4">Profil Saya</h2>

    {{-- Alert sukses --}}
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    {{-- Error validasi --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- DATA PEGAWAI --}}
    <div class="card mb-4">
        <div class="card-header">
            Data Pegawai
        </div>
        <div class="card-body">
            @if ($employee)
                <table class="table table-borderless w-75">
                    <tr>
                        <th style="width: 160px;">Nama Lengkap</th>
                        <td>{{ $employee->nama_lengkap }}</td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td>{{ $employee->email }}</td>
                    </tr>
                    <tr>
                        <th>Department</th>
                        <td>{{ $employee->department->nama_department ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Jabatan</th>
                        <td>{{ $employee->position->nama_jabatan ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Nomor Telepon</th>
                        <td>{{ $employee->nomor_telepon ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Alamat</th>
                        <td>{{ $employee->alamat ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Tanggal Lahir</th>
                        <td>{{ $employee->tanggal_lahir ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Tanggal Masuk</th>
                        <td>{{ $employee->tanggal_masuk ?? '-' }}</td>
                    </tr>
                </table>
                <p class="text-muted mb-0">
                    Perubahan data di atas hanya bisa dilakukan oleh Admin / HR melalui menu Employee.
                </p>
            @else
                <p class="text-muted mb-0">
                    Data pegawai belum dihubungkan dengan akun ini.
                    Silakan hubungi admin.
                </p>
            @endif
        </div>
    </div>

    {{-- PENGATURAN AKUN (USER) --}}
    <div class="card mb-4">
        <div class="card-header">
            Pengaturan Akun
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('profile.update') }}">
                @csrf
                @method('PATCH')

                <div class="mb-3">
                    <label for="name" class="form-label">Nama Akun</label>
                    <input type="text"
                           id="name"
                           name="name"
                           class="form-control"
                           value="{{ old('name', $user->name) }}"
                           required>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email Akun</label>
                    <input type="email"
                           id="email"
                           name="email"
                           class="form-control"
                           value="{{ old('email', $user->email) }}"
                           required>
                </div>

                <hr>

                <p class="text-muted">
                    Kosongkan password jika tidak ingin mengganti.
                </p>

                <div class="mb-3">
                    <label for="password" class="form-label">Password Baru</label>
                    <input type="password"
                           id="password"
                           name="password"
                           class="form-control"
                           autocomplete="new-password">
                </div>

                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">Konfirmasi Password Baru</label>
                    <input type="password"
                           id="password_confirmation"
                           name="password_confirmation"
                           class="form-control"
                           autocomplete="new-password">
                </div>

                <button type="submit" class="btn btn-primary">
                    Simpan Perubahan
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
