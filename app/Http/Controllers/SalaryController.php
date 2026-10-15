<?php

namespace App\Http\Controllers;

use App\Models\Salary;
use App\Models\Employee;
use Illuminate\Http\Request;
use App\Models\Overtime;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class SalaryController extends Controller
{
    public function index()
    {
        $salaries = Salary::with('employee')->latest()->paginate(10);
        return view('salaries.index', compact('salaries'));
    }

    public function create()
    {
        $employees = Employee::all();
        return view('salaries.create', compact('employees'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'bulan'       => 'required|date_format:Y-m',
            'gaji_pokok'  => 'required|numeric',
            'tunjangan'   => 'nullable|numeric',
            'potongan'    => 'nullable|numeric',
        ]);
        
        $employee_id = $request->employee_id;
        $bulan       = $request->bulan; 

        $periode     = Carbon::createFromFormat('Y-m', $bulan);
        $awal_bulan  = $periode->copy()->startOfMonth()->toDateString(); 
        $akhir_bulan = $periode->copy()->endOfMonth()->toDateString();

        $total_lembur = Overtime::where('employee_id', $employee_id)
            ->whereBetween('tanggal', [$awal_bulan, $akhir_bulan])
            ->sum('total_lembur');

        if ($total_lembur === null) {
            $total_lembur = 0;
        }

        $gaji_pokok = (float) $request->gaji_pokok;
        $tunjangan  = (float) ($request->tunjangan ?? 0);
        $potongan   = (float) ($request->potongan ?? 0);

        $total_gaji = $gaji_pokok + $tunjangan + $total_lembur - $potongan;

        Salary::create([
            'employee_id' => $employee_id,
            'bulan'       => $bulan,
            'gaji_pokok'  => $gaji_pokok,
            'tunjangan'   => $tunjangan,
            'lembur'      => $total_lembur,
            'potongan'    => $potongan,
            'total_gaji'  => $total_gaji,
        ]);

        return redirect()->route('salaries.index')
            ->with('success', 'Data gaji berhasil ditambahkan!');
    }


    public function edit(Salary $salary)
    {
        $employees = Employee::all();
        return view('salaries.edit', compact('salary', 'employees'));
    }

    public function update(Request $request, Salary $salary)
    {
        $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'bulan'       => 'required|date_format:Y-m',
            'gaji_pokok'  => 'required|numeric',
            'tunjangan'   => 'nullable|numeric',
            'potongan'    => 'nullable|numeric',
        ]);
        
        $employee_id = $request->employee_id;
        $bulan       = $request->bulan;
        
        $periode     = Carbon::createFromFormat('Y-m', $bulan);
        $awal_bulan  = $periode->copy()->startOfMonth()->toDateString();  
        $akhir_bulan = $periode->copy()->endOfMonth()->toDateString();

        $total_lembur = Overtime::where('employee_id', $employee_id)
            ->whereBetween('tanggal', [$awal_bulan, $akhir_bulan])
            ->sum('total_lembur');

        if ($total_lembur === null) {
            $total_lembur = 0;
        }

        $gaji_pokok = (float) $request->gaji_pokok;
        $tunjangan  = (float) ($request->tunjangan ?? 0);
        $potongan   = (float) ($request->potongan ?? 0);

        $total_gaji = $gaji_pokok + $tunjangan + $total_lembur - $potongan;

        $salary->update([
            'employee_id' => $employee_id,
            'bulan'       => $bulan,
            'gaji_pokok'  => $gaji_pokok,
            'tunjangan'   => $tunjangan,
            'lembur'      => $total_lembur,
            'potongan'    => $potongan,
            'total_gaji'  => $total_gaji,
        ]);

        return redirect()->route('salaries.index')
            ->with('success', 'Data gaji berhasil diperbarui!');
    }

    public function show(Salary $salary)
    {
        // load relasi untuk tampilan slip
        $salary->load('employee.department', 'employee.position');

        $user = Auth::user();

        // Batasi akses khusus untuk role employee
        if ($user->role === 'employee') {

            // Coba ambil data employee dari relasi jika ada
            $employee = $user->employee ?? null;

            // Kalau relasi employee belum ada, fallback cari berdasarkan email
            if (!$employee) {
                $employee = Employee::where('email', $user->email)->first();
            }

            // Jika tetap tidak ditemukan, atau id tidak sama dengan salary->employee_id → tolak
            if (!$employee || $employee->id !== $salary->employee_id) {
                abort(403, 'Anda tidak boleh melihat slip gaji pegawai lain.');
            }
        }

        // Admin & HR bebas melihat semua
        return view('salaries.show', compact('salary'));
    }

    public function destroy(Salary $salary)
    {
        $salary->delete();
        return redirect()->route('salaries.index')->with('success', 'Data gaji berhasil dihapus!');
    }
}
