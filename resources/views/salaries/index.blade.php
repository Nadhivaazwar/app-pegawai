<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Gaji Pegawai</title>

    <!-- ✅ Bootstrap CDN -->
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
        .table th {
            background-color: #212529;
            color: #fff;
            text-align: center;
        }
        .table td {
            text-align: center;
            vertical-align: middle;
        }
        .btn-primary {
            background-color: #1d3557;
            border-color: #1d3557;
        }
        .btn-primary:hover {
            background-color: #457b9d;
            border-color: #457b9d;
        }
        .btn-warning {
            background-color: #ffc107;
            border-color: #ffc107;
            color: #212529;
        }
        .btn-warning:hover {
            background-color: #e0a800;
            border-color: #d39e00;
        }
        .btn-danger {
            background-color: #dc3545;
            border-color: #dc3545;
        }
        .btn-danger:hover {
            background-color: #bb2d3b;
            border-color: #a52834;
        }
    </style>
</head>

<body>
    @extends('master')
    @section('title', 'Data Gaji Pegawai')
    @section('content')

    <div class="container mt-5">
        <div class="card p-4">
            <h1 class="mb-4 text-center">Daftar Gaji Pegawai</h1>

            <div class="d-flex justify-content-between align-items-center mb-3">
                <a href="{{ route('salaries.create') }}" class="btn btn-primary">
                    + Tambah Data Gaji
                </a>
            </div>

            {{-- Pesan sukses --}}
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <div class="table-responsive">
                <table class="table table-striped table-bordered align-middle">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Bulan</th>
                            <th>Gaji Pokok</th>
                            <th>Tunjangan</th>
                            <th>Lembur</th>
                            <th>Potongan</th>
                            <th>Total Gaji</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($salaries as $salary)
                            <tr>
                                <td>{{ $salary->employee->nama_lengkap ?? '-' }}</td>
                                <td>{{ $salary->bulan }}</td>
                                <td>Rp{{ number_format($salary->gaji_pokok, 0, ',', '.') }}</td>
                                <td>Rp{{ number_format($salary->tunjangan, 0, ',', '.') }}</td>
                                <td>Rp{{ number_format($salary->lembur, 0, ',', '.') }}</td>
                                <td>Rp{{ number_format($salary->potongan, 0, ',', '.') }}</td>
                                <td><strong>Rp{{ number_format($salary->total_gaji, 0, ',', '.') }}</strong></td>
                                <td>
                                    <a href="{{ route('salaries.show', $salary->id) }}" class="btn btn-sm btn-info text-white">
                                        Detail
                                    </a>
                                    <a href="{{ route('salaries.edit', $salary->id) }}" class="btn btn-sm btn-warning">
                                        Edit
                                    </a>
                                    <form action="{{ route('salaries.destroy', $salary->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                onclick="return confirm('Yakin ingin menghapus data ini?')"
                                                class="btn btn-sm btn-danger">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center text-muted">
                                    Belum ada data gaji.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination (kalau pakai paginate) --}}
            @if(method_exists($salaries, 'links'))
                <div class="d-flex justify-content-center mt-3">
                    {{ $salaries->links() }}
                </div>
            @endif
        </div>
    </div>

    @endsection

    <!-- ✅ Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
