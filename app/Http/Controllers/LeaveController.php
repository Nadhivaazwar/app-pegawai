<?php

namespace App\Http\Controllers;

use App\Models\Leave;
use App\Models\LeaveType;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LeaveController extends Controller
{
    /**
     * List semua pengajuan cuti (untuk admin / HR).
     */
    public function index()
    {
        $leaves = Leave::with(['employee', 'leaveType'])
            ->latest()
            ->paginate(10);

        return view('leaves.index', compact('leaves'));
    }

    /**
     * Form pengajuan cuti.
     * - Pegawai: hanya boleh mengajukan untuk dirinya sendiri.
     * - Admin / HR: boleh pilih pegawai mana saja.
     */
    public function create()
    {
        $user = Auth::user();

        if (! $user) {
            return redirect()->route('login');
        }

        // Ambil semua jenis cuti
        $leaveTypes = LeaveType::orderBy('nama_jenis')->get();

        if ($user->role === 'employee') {
            // Pegawai → hanya untuk dirinya sendiri
            $employee = $user->employee
                ?? Employee::where('email', $user->email)->first();

            if (! $employee) {
                return redirect()
                    ->route('profile.edit')
                    ->withErrors([
                        'leave' => 'Akun ini belum terhubung dengan data pegawai.',
                    ]);
            }

            // Collection berisi 1 pegawai (supaya view tetap bisa pakai <select>)
            $employees  = collect([$employee]);
            $isEmployee = true;
        } else {
            // Admin / HR → boleh pilih semua pegawai
            $employees  = Employee::orderBy('nama_lengkap')->get();
            $isEmployee = false;
        }

        return view('leaves.create', [
            'employees'   => $employees,
            'leave_types' => $leaveTypes,
            'isEmployee'  => $isEmployee,
        ]);
    }

    /**
     * Simpan pengajuan cuti baru.
     */
    public function store(Request $request)
    {
        $user = Auth::user();

        if (! $user) {
            return redirect()->route('login');
        }

        // Default: pakai employee_id dari form (admin/hr)
        $employeeId = $request->employee_id;

        // Pegawai: paksa employee_id = miliknya sendiri
        if ($user->role === 'employee') {
            $employee = $user->employee
                ?? Employee::where('email', $user->email)->first();

            if (! $employee) {
                return redirect()
                    ->route('profile.edit')
                    ->withErrors([
                        'leave' => 'Akun ini belum terhubung dengan data pegawai.',
                    ])
                    ->withInput();
            }

            $employeeId = $employee->id;
        }

        // Validasi input
        $validated = $request->validate([
            'leave_type_id'   => 'required|exists:leave_types,id',
            'tanggal_mulai'   => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'alasan'          => 'nullable|string',
        ]);

        // Hitung total hari (inkl. tanggal mulai & selesai)
        $tanggalMulai   = new \DateTime($validated['tanggal_mulai']);
        $tanggalSelesai = new \DateTime($validated['tanggal_selesai']);
        $totalHari      = $tanggalMulai->diff($tanggalSelesai)->days + 1;

        Leave::create([
            'employee_id'     => $employeeId,
            'leave_type_id'   => $validated['leave_type_id'],
            'tanggal_mulai'   => $validated['tanggal_mulai'],
            'tanggal_selesai' => $validated['tanggal_selesai'],
            'total_hari'      => $totalHari,
            'alasan'          => $validated['alasan'] ?? null,
            'status'          => 'pending',
            'disetujui_oleh'  => null,
        ]);

        // Pegawai → balik ke dashboard pegawai
        if ($user->role === 'employee') {
            return redirect()
                ->route('employee.dashboard')
                ->with('success', 'Pengajuan cuti berhasil dibuat!');
        }

        // Admin / HR → balik ke list cuti
        return redirect()
            ->route('leaves.index')
            ->with('success', 'Pengajuan cuti berhasil dibuat!');
    }

    /**
     * Detail pengajuan cuti.
     */
    public function show(string $id)
    {
        $leave = Leave::with(['employee', 'leaveType'])->findOrFail($id);

        return view('leaves.show', compact('leave'));
    }

    /**
     * Form edit cuti (biasanya hanya admin / HR).
     */
    public function edit(string $id)
    {
        $leave       = Leave::findOrFail($id);
        $employees   = Employee::orderBy('nama_lengkap')->get();
        $leave_types = LeaveType::orderBy('nama_jenis')->get();

        return view('leaves.edit', compact('leave', 'employees', 'leave_types'));
    }

    /**
     * Update data cuti.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'employee_id'     => 'required|exists:employees,id',
            'leave_type_id'   => 'required|exists:leave_types,id',
            'tanggal_mulai'   => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'alasan'          => 'nullable|string',
        ]);

        $leave = Leave::findOrFail($id);

        $tanggalMulai   = new \DateTime($request->tanggal_mulai);
        $tanggalSelesai = new \DateTime($request->tanggal_selesai);
        $totalHari      = $tanggalMulai->diff($tanggalSelesai)->days + 1;

        $leave->update([
            'employee_id'     => $request->employee_id,
            'leave_type_id'   => $request->leave_type_id,
            'tanggal_mulai'   => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'total_hari'      => $totalHari,
            'alasan'          => $request->alasan,
        ]);

        return redirect()
            ->route('leaves.index')
            ->with('success', 'Data pengajuan cuti berhasil diperbarui!');
    }

    /**
     * Hapus pengajuan cuti.
     */
    public function destroy(string $id)
    {
        $leave = Leave::findOrFail($id);
        $leave->delete();

        return redirect()
            ->route('leaves.index')
            ->with('success', 'Pengajuan cuti berhasil dihapus!');
    }

    /**
     * Setujui cuti.
     */
    public function approve(string $id)
    {
        $leave = Leave::findOrFail($id);

        $leave->update([
            'status'         => 'disetujui',
            'disetujui_oleh' => Auth::id(),
        ]);

        return redirect()
            ->back()
            ->with('success', 'Pengajuan cuti telah disetujui.');
    }

    /**
     * Tolak cuti.
     */
    public function reject(string $id)
    {
        $leave = Leave::findOrFail($id);

        $leave->update([
            'status'         => 'ditolak',
            'disetujui_oleh' => Auth::id(),
        ]);

        return redirect()
            ->back()
            ->with('success', 'Pengajuan cuti telah ditolak.');
    }
}
