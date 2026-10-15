@extends('master')

@section('title', 'Dashboard Admin')

@section('content')
<div class="mt-3">
    <h2 class="mb-4">Dashboard Admin</h2>

    {{-- Kartu ringkasan --}}
    <div class="row mb-4">
        <div class="col-md-4 mb-3">
            <div class="card h-100">
                <div class="card-body">
                    <h6 class="text-muted">Total Pegawai</h6>
                    <h3 class="mb-0">{{ $totalPegawai }}</h3>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-3">
            <div class="card h-100">
                <div class="card-body">
                    <h6 class="text-muted">Total Department</h6>
                    <h3 class="mb-0">{{ $totalDept }}</h3>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-3">
            <div class="card h-100">
                <div class="card-body">
                    <h6 class="text-muted">Cuti Pending</h6>
                    <h3 class="mb-0">{{ $cutiPending }}</h3>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        {{-- Pengajuan cuti terbaru --}}
        <div class="col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-header">
                    <strong>5 Pengajuan Cuti Terbaru</strong>
                </div>
                <div class="card-body p-0">
                    <table class="table table-sm mb-0 table-striped">
                        <thead>
                            <tr>
                                <th>Pegawai</th>
                                <th>Jenis</th>
                                <th>Tanggal</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($latestLeaves as $leave)
                                <tr>
                                    <td>{{ $leave->employee->nama_lengkap ?? '-' }}</td>
                                    <td>{{ $leave->leaveType->nama_jenis ?? '-' }}</td>
                                    <td>{{ $leave->tanggal_mulai }} - {{ $leave->tanggal_selesai }}</td>
                                    <td>{{ ucfirst($leave->status) }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center text-muted">
                                        Belum ada pengajuan cuti.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{-- Lembur terbaru --}}
        <div class="col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-header">
                    <strong>5 Lembur Terbaru</strong>
                </div>
                <div class="card-body p-0">
                    <table class="table table-sm mb-0 table-striped">
                        <thead>
                            <tr>
                                <th>Pegawai</th>
                                <th>Tanggal</th>
                                <th>Total Jam</th>
                                <th>Total Lembur</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($latestOvertimes as $ot)
                                <tr>
                                    <td>{{ $ot->employee->nama_lengkap ?? '-' }}</td>
                                    <td>{{ $ot->tanggal }}</td>
                                    <td>{{ $ot->total_jam }}</td>
                                    <td>Rp {{ number_format($ot->total_lembur, 0, ',', '.') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center text-muted">
                                        Belum ada data lembur.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
