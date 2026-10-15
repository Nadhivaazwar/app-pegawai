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
    @section('title', 'Daftar Pegawai')
    @section('content')
    <div class="container mt-5">
        <div class="card p-4">
            <h1 class="mb-4 text-center">Daftar Pegawai</h1>

            <div class="d-flex justify-content-between align-items-center mb-3">
                <a href="{{ route('employees.create') }}" class="btn btn-primary">
                    + Tambah Data Pegawai
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
                            <th>Nama Lengkap</th>
                            <th>Nama Department</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($employees as $employee)
                        <tr>
                            <td>{{ $employee->nama_lengkap }}</td>
                            <td>{{ $departments->find($employee->department_id)->nama_department }}</td>
                            <td>{{ $employee->status }}</td>
                            <td>
                                <a href="{{ route('employees.show', $employee->id) }}" class="btn btn-sm btn-info text-white">Detail</a>
                                <a href="{{ route('employees.edit', $employee->id) }}" class="btn btn-sm btn-warning text-white">Edit</a>
                                <form action="{{ route('employees.destroy', $employee->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Yakin ingin menghapus?')" class="btn btn-sm btn-danger">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @endsection

    <!-- ✅ Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
