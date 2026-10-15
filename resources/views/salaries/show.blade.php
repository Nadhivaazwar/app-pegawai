@extends('master')
@section('title', 'Slip Gaji')
@section('content')

<style>
@media print {
    nav.navbar,
    .btn,
    footer {
        display: none !important;
    }
    .card {
        border: none;
        box-shadow: none;
    }
    body {
        margin: 0;
        padding: 0;
    }
}
</style>

@php
    if (!empty($salary->bulan)) {
        try {
            $periode = \Carbon\Carbon::createFromFormat('Y-m', $salary->bulan);
            $judulPeriode = $periode->translatedFormat('F Y'); // contoh: November 2025
        } catch (\Exception $e) {
            // Kalau format tidak sesuai, pakai apa adanya
            $judulPeriode = $salary->bulan;
        }
    } else {
        $judulPeriode = '-';
    }
@endphp

<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h4 class="mb-0">
            Slip Gaji {{ $judulPeriode }}
        </h4>

        <button onclick="window.print()" class="btn btn-sm btn-primary">
            Cetak / Print
        </button>
    </div>

    <div class="card-body">
        {{-- Data pegawai --}}
        <h5 class="mb-3">Data Pegawai</h5>
        <table class="table table-borderless w-auto">
            <tr>
                <th style="width: 150px;">Nama</th>
                <td>{{ $salary->employee->nama_lengkap ?? '-' }}</td>
            </tr>
            <tr>
                <th>Department</th>
                <td>{{ $salary->employee->department->nama_department ?? '-' }}</td>
            </tr>
            <tr>
                <th>Jabatan</th>
                <td>{{ $salary->employee->position->nama_jabatan ?? '-' }}</td>
            </tr>
        </table>

        {{-- Rincian gaji --}}
        <h5 class="mt-4 mb-3">Rincian Gaji</h5>
        <table class="table table-striped w-auto">
            <tr>
                <th style="width: 150px;">Gaji Pokok</th>
                <td>Rp {{ number_format($salary->gaji_pokok ?? 0, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <th>Tunjangan</th>
                <td>Rp {{ number_format($salary->tunjangan ?? 0, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <th>Lembur</th>
                <td>Rp {{ number_format($salary->lembur ?? 0, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <th>Potongan</th>
                <td>Rp {{ number_format($salary->potongan ?? 0, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <th>Total Gaji</th>
                <td><strong>Rp {{ number_format($salary->total_gaji ?? 0, 0, ',', '.') }}</strong></td>
            </tr>
        </table>
    </div>
</div>


@endsection
