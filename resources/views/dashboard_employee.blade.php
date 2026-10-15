@extends('master')

@section('title', 'Dashboard Pegawai')

@section('content')
<div class="mt-3">
    <h2 class="mb-4">Dashboard Pegawai</h2>

    @if ($employee)
        {{-- Salam & info singkat --}}
        <div class="alert alert-info">
            <strong>Halo, {{ $employee->nama_lengkap }}!</strong><br>
            <span class="small">
                Department: {{ $employee->department->nama_department ?? '-' }}
                |
                Jabatan: {{ $employee->position->nama_jabatan ?? '-' }}
            </span>
        </div>

        {{-- Kartu ringkas --}}
        <div class="row mb-4">
            {{-- Gaji terakhir --}}
            <div class="col-md-4 mb-3">
                <div class="card h-100">
                    <div class="card-body">
                        <h6 class="text-muted">Gaji Terakhir</h6>
                        @php $lastSalary = $salaries->first(); @endphp

                        @if ($lastSalary)
                            <h3 class="mb-1">
                                Rp {{ number_format($lastSalary->total_gaji, 0, ',', '.') }}
                            </h3>
                            <div class="small text-muted">
                                Periode: {{ $lastSalary->bulan }}
                            </div>
                        @else
                            <p class="mb-0 text-muted">Belum ada data gaji.</p>
                        @endif
                    </div>
                </div>
            </div>

            {{-- Pengajuan cuti --}}
            <div class="col-md-4 mb-3">
                <div class="card h-100">
                    <div class="card-body d-flex flex-column">
                        <h6 class="text-muted">Pengajuan Cuti</h6>
                        <p class="small text-muted mb-2">
                            Ajukan cuti langsung dari sini.
                        </p>
                        <a href="{{ route('leaves.create') }}" class="btn btn-success mt-auto">
                            Ajukan Cuti
                        </a>
                    </div>
                </div>
            </div>

            {{-- Absensi terakhir --}}
            <div class="col-md-4 mb-3">
                <div class="card h-100">
                    <div class="card-body">
                        <h6 class="text-muted mb-3">Absensi Terakhir</h6>

                        {{-- Jam sekarang (live) --}}
                        <div class="small text-muted mb-2">
                            Waktu sekarang: <span id="current-time"></span>
                        </div>

                        {{-- Tombol Absen Masuk & Keluar --}}
                        <div class="d-flex gap-2 mb-3">
                            <form action="{{ route('attendance.checkin') }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-success">
                                    Absen Masuk
                                </button>
                            </form>

                            <form action="{{ route('attendance.checkout') }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-outline-danger">
                                    Absen Keluar
                                </button>
                            </form>
                        </div>

                        @php $lastAtt = $attendances->first(); @endphp

                        @if ($lastAtt)
                            <div class="mb-1">
                                Tanggal: {{ $lastAtt->tanggal }}
                            </div>
                            <div class="small">
                                Masuk: {{ $lastAtt->waktu_masuk ?? '-' }} <br>
                                Pulang: {{ $lastAtt->waktu_keluar ?? '-' }} <br>
                                Status: {{ ucfirst($lastAtt->status_absensi) }}
                            </div>
                        @else
                            <p class="mb-0 text-muted">Belum ada data absensi.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        {{-- Riwayat gaji & cuti --}}
        <div class="row">
            {{-- Riwayat Gaji --}}
            <div class="col-md-6 mb-4">
                <div class="card h-100">
                    <div class="card-header">
                        Riwayat Gaji Terbaru
                    </div>
                    <div class="card-body p-0">
                        <table class="table table-sm mb-0 table-striped">
                            <thead>
                                <tr>
                                    <th>Bulan</th>
                                    <th>Total Gaji</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($salaries as $salary)
                                    <tr>
                                        <td>{{ $salary->bulan }}</td>
                                        <td>
                                            Rp {{ number_format($salary->total_gaji, 0, ',', '.') }}
                                        </td>
                                        <td>
                                            <a href="{{ route('salaries.show', $salary->id) }}"
                                               class="btn btn-sm btn-outline-primary">
                                                Slip
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-center text-muted">
                                            Belum ada data gaji.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            {{-- Riwayat Cuti --}}
            <div class="col-md-6 mb-4">
                <div class="card h-100">
                    <div class="card-header">
                        Riwayat Cuti Terbaru
                    </div>
                    <div class="card-body p-0">
                        <table class="table table-sm mb-0 table-striped">
                            <thead>
                                <tr>
                                    <th>Tanggal</th>
                                    <th>Jenis / Alasan</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($leaves as $leave)
                                    <tr>
                                        <td>
                                            {{ $leave->tanggal_mulai }} - {{ $leave->tanggal_selesai }}
                                        </td>
                                        <td>
                                            {{ $leave->leaveType->nama_jenis ?? $leave->alasan ?? '-' }}
                                        </td>
                                        <td>{{ ucfirst($leave->status) }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-center text-muted">
                                            Belum ada pengajuan cuti.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        {{-- Riwayat Absensi --}}
        <div class="card mb-4">
            <div class="card-header">
                Riwayat Absensi Terbaru
            </div>
            <div class="card-body p-0">
                <table class="table table-sm mb-0 table-striped">
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>Masuk</th>
                            <th>Pulang</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($attendances as $att)
                            <tr>
                                <td>{{ $att->tanggal }}</td>
                                <td>{{ $att->waktu_masuk ?? '-' }}</td>
                                <td>{{ $att->waktu_keluar ?? '-' }}</td>
                                <td>{{ ucfirst($att->status_absensi) }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted">
                                    Belum ada data absensi.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    @else
        <div class="alert alert-warning">
            Data pegawai belum dihubungkan dengan akun ini.
            Silakan hubungi admin / HR.
        </div>
    @endif
</div>

{{-- Script jam real-time --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {
        function updateClock() {
            const now = new Date();

            const optionsDate = { year: 'numeric', month: '2-digit', day: '2-digit' };
            const optionsTime = {
                hour: '2-digit',
                minute: '2-digit',
                second: '2-digit',
                hour12: false
            };

            const formatted =
                now.toLocaleDateString('id-ID', optionsDate) + ' ' +
                now.toLocaleTimeString('id-ID', optionsTime);

            const el = document.getElementById('current-time');
            if (el) {
                el.textContent = formatted;
            }
        }

        updateClock();
        setInterval(updateClock, 1000);
    });
</script>
@endsection
