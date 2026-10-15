<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Pegawai</title>
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
    </style>
</head>
<body>
    @extends('master')
    @section('title', 'Daftar Jenis Cuti')
    @section('content')

    <div class="container mt-5">
        <div class="card p-4">
            <h1 class="mb-4 text-center">Daftar Jenis Cuti</h1>

            <div class="d-flex justify-content-between align-items-center mb-3">
                <a href="{{ route('leave_types.create') }}" class="btn btn-primary">
                    + Tambah Jenis Cuti
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
                            <th>Nama Jenis</th>
                            <th>Maksimal Hari</th>
                            <th>Keterangan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($leaveTypes as $leaveType)
                            <tr>
                                <td>{{ $leaveType->nama_jenis }}</td>
                                <td>{{ $leaveType->maksimal_hari ?? '-' }}</td>
                                <td>{{ $leaveType->keterangan ?? '-' }}</td>
                                <td>
                                    <a href="{{ route('leave_types.show', $leaveType->id) }}" class="btn btn-sm btn-info text-white">Detail</a>
                                    <a href="{{ route('leave_types.edit', $leaveType->id) }}" class="btn btn-sm btn-warning text-white">Edit</a>
                                    <form action="{{ route('leave_types.destroy', $leaveType->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                onclick="return confirm('Yakin ingin menghapus?')"
                                                class="btn btn-sm btn-danger">
                                            Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center">Belum ada data jenis cuti.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if(method_exists($leaveTypes, 'links'))
                {{ $leaveTypes->links() }}
            @endif
        </div>
    </div>
@endsection

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
