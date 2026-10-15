<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Lembur Pegawai</title>

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
    </style>
</head>

<body>
    @extends('master')
    @section('title', 'Daftar Lembur')
    @section('content')

    <div class="container mt-5">
        <div class="card p-4">
            <h1 class="mb-4 text-center">Daftar Lembur Pegawai</h1>

            <div class="d-flex justify-content-between align-items-center mb-3">
                <a href="{{ route('overtimes.create') }}" class="btn btn-primary">
                    + Tambah Lembur
                </a>
            </div>

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <div class="table-responsive">
                <table class="table table-striped table-bordered align-middle">
                    <thead>
                        <tr>
                            <th>Pegawai</th>
                            <th>Tanggal</th>
                            <th>Jam Mulai</th>
                            <th>Jam Selesai</th>
                            <th>Total Jam</th>
                            <th>Tarif per Jam</th>
                            <th>Total Lembur</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($overtimes as $overtime)
                            <tr>
                                <td>{{ $overtime->employee->nama_lengkap ?? '-' }}</td>
                                <td>{{ $overtime->tanggal }}</td>
                                <td>{{ $overtime->jam_mulai }}</td>
                                <td>{{ $overtime->jam_selesai }}</td>
                                <td>{{ $overtime->total_jam }}</td>
                                <td>Rp{{ number_format($overtime->tarif_per_jam, 0, ',', '.') }}</td>
                                <td>Rp{{ number_format($overtime->total_lembur, 0, ',', '.') }}</td>
                                <td>
                                    <a href="{{ route('overtimes.show', $overtime->id) }}"
                                       class="btn btn-sm btn-info text-white">
                                        Detail
                                    </a>
                                    <a href="{{ route('overtimes.edit', $overtime->id) }}"
                                       class="btn btn-sm btn-warning">
                                        Edit
                                    </a>
                                    <form action="{{ route('overtimes.destroy', $overtime->id) }}"
                                          method="POST"
                                          class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                onclick="return confirm('Hapus data lembur ini?')"
                                                class="btn btn-sm btn-danger">
                                            Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center text-muted">
                                    Belum ada data lembur.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if(method_exists($overtimes, 'links'))
                <div class="mt-3">
                    {{ $overtimes->links() }}
                </div>
            @endif
        </div>
    </div>

    @endsection

    <!-- ✅ Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
