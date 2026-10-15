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
    @section('title', 'Daftar Pengajuan Cuti')
    @section('content')

    <div class="container mt-5">
        <div class="card p-4">
            <h1 class="mb-4 text-center">Daftar Pengajuan Cuti</h1>

            <div class="d-flex justify-content-between align-items-center mb-3">
                <a href="{{ route('leaves.create') }}" class="btn btn-primary">
                    + Ajukan Cuti
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
                            <th>Jenis Cuti</th>
                            <th>Tanggal</th>
                            <th>Total Hari</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($leaves as $leave)
                            <tr>
                                <td>{{ $leave->employee->nama_lengkap ?? '-' }}</td>
                                <td>{{ $leave->leaveType->nama_jenis ?? '-' }}</td>
                                <td>{{ $leave->tanggal_mulai }} s/d {{ $leave->tanggal_selesai }}</td>
                                <td>{{ $leave->total_hari }}</td>
                                <td>
                                    <span class="badge
                                        @if($leave->status == 'pending') bg-secondary
                                        @elseif($leave->status == 'disetujui') bg-success
                                        @else bg-danger
                                        @endif">
                                        {{ ucfirst($leave->status) }}
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ route('leaves.show', $leave->id) }}" class="btn btn-sm btn-info text-white">Detail</a>
                                    <a href="{{ route('leaves.edit', $leave->id) }}" class="btn btn-sm btn-warning text-white">Edit</a>

                                    <form action="{{ route('leaves.destroy', $leave->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                onclick="return confirm('Hapus pengajuan cuti ini?')"
                                                class="btn btn-sm btn-danger">
                                            Hapus
                                        </button>
                                    </form>

                                    @if($leave->status == 'pending')
                                        <form action="{{ route('leaves.approve', $leave->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-success">
                                                Approve
                                            </button>
                                        </form>

                                        <form action="{{ route('leaves.reject', $leave->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-secondary">
                                                Reject
                                            </button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">Belum ada pengajuan cuti.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if(method_exists($leaves, 'links'))
                {{ $leaves->links() }}
            @endif
        </div>
    </div>

    @endsection

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
