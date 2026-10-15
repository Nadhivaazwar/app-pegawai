<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class AttendanceController extends Controller
{
    public function index()
    {
        $attendances = Attendance::with('employee')->latest()->get();
        $employees   = Employee::orderBy('nama_lengkap')->get();

        return view('attendances.index', compact('attendances', 'employees'));
    }

    public function create()
    {
        $employees = Employee::orderBy('nama_lengkap')->get();
        return view('attendances.create', compact('employees'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'employee_id'    => 'required|exists:employees,id',
            'tanggal'        => 'required|date',
            'status_absensi' => 'required|in:hadir,izin,sakit,alpha',
            'waktu_masuk'    => 'nullable',
            'waktu_keluar'   => 'nullable',
        ]);

        Attendance::create($request->all());

        return redirect()->route('attendances.index')
            ->with('success', 'Absensi berhasil ditambahkan');
    }

    public function show($id)
    {
        $attendance = Attendance::with('employee')->findOrFail($id);
        return view('attendances.show', compact('attendance'));
    }

    public function edit($id)
    {
        $attendance = Attendance::findOrFail($id);
        $employees  = Employee::orderBy('nama_lengkap')->get();

        return view('attendances.edit', compact('attendance', 'employees'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'employee_id'    => 'required|exists:employees,id',
            'tanggal'        => 'required|date',
            'status_absensi' => 'required|in:hadir,izin,sakit,alpha',
        ]);

        $attendance = Attendance::findOrFail($id);
        $attendance->update($request->all());

        return redirect()->route('attendances.index')
            ->with('success', 'Data attendance berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
        $attendance = Attendance::findOrFail($id);
        $attendance->delete();

        return redirect()->route('attendances.index')
            ->with('success', 'Data attendance berhasil dihapus.');
    }

    // =====================
    // ABSEN DARI PEGAWAI
    // =====================

        /**
     * Absen masuk pegawai (dashboard pegawai).
     */
    public function checkIn(Request $request)
    {
        $user = Auth::user();

        // cari data pegawai berdasarkan user
        $employee = $user->employee
            ?? Employee::where('email', $user->email)->first();

        if (! $employee) {
            return back()->withErrors([
                'attendance' => 'Akun ini belum terhubung dengan data pegawai.',
            ]);
        }

        $today = now()->toDateString();

        // cari / buat data absensi hari ini untuk pegawai
        $attendance = Attendance::firstOrNew([
            'employee_id' => $employee->id,
            'tanggal'     => $today,
        ]);

        // kalau sudah pernah absen masuk, jangan diubah lagi (opsional)
        if ($attendance->waktu_masuk) {
            return back()->with('info', 'Anda sudah absen masuk hari ini.');
        }

        $attendance->waktu_masuk    = now()->format('H:i:s');
        $attendance->status_absensi = $attendance->status_absensi ?: 'hadir';
        $attendance->save();

        // balik ke dashboard pegawai
        return redirect()->route('employee.dashboard')
            ->with('success', 'Absen masuk berhasil.');
    }

    /**
     * Absen keluar pegawai (dashboard pegawai).
     * Kalau ditekan berkali-kali, waktu_keluar akan di-update terus.
     */
    public function checkOut(Request $request)
    {
        $user = Auth::user();

        $employee = $user->employee
            ?? Employee::where('email', $user->email)->first();

        if (! $employee) {
            return back()->withErrors([
                'attendance' => 'Akun ini belum terhubung dengan data pegawai.',
            ]);
        }

        $today = now()->toDateString();

        // cari absensi hari ini
        $attendance = Attendance::where('employee_id', $employee->id)
            ->where('tanggal', $today)
            ->first();

        if (! $attendance) {
            // kalau belum ada record hari ini, buat baru
            $attendance = new Attendance();
            $attendance->employee_id     = $employee->id;
            $attendance->tanggal         = $today;
            $attendance->waktu_masuk     = null; // belum ada
            $attendance->status_absensi  = 'hadir';
        }

        // SETIAP klik akan meng-update waktu_keluar
        $attendance->waktu_keluar = now()->format('H:i:s');
        $attendance->save();

        return redirect()->route('employee.dashboard')
            ->with('success', 'Absen keluar berhasil diperbarui.');
    }
}
