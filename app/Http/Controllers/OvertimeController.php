<?php

namespace App\Http\Controllers;

use App\Models\Overtime;
use App\Models\Employee;
use Illuminate\Http\Request;
use Carbon\Carbon;

class OvertimeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $overtimes = Overtime::with('employee')
            ->latest()
            ->paginate(5);

        return view('overtimes.index', compact('overtimes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $employees   = Employee::orderBy('nama_lengkap')->get();
        $tarifPerJam = 25000; // tarif lembur per jam (fix)

        return view('overtimes.create', compact('employees', 'tarifPerJam'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'tanggal'     => 'required|date',
            'jam_mulai'   => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i|after:jam_mulai',
        ]);

        // Hitung total jam lembur
        $mulai    = Carbon::createFromFormat('H:i', $validated['jam_mulai']);
        $selesai  = Carbon::createFromFormat('H:i', $validated['jam_selesai']);
        $totalJam = $mulai->diffInHours($selesai); // bisa diganti diffInMinutes kalau mau lebih detail

        // Tarif fix
        $tarifPerJam = 25000;
        $totalLembur = $tarifPerJam * $totalJam;

        Overtime::create([
            'employee_id'   => $validated['employee_id'],
            'tanggal'       => $validated['tanggal'],
            'jam_mulai'     => $validated['jam_mulai'],
            'jam_selesai'   => $validated['jam_selesai'],
            'total_jam'     => $totalJam,
            'tarif_per_jam' => $tarifPerJam,
            'total_lembur'  => $totalLembur,
        ]);

        return redirect()->route('overtimes.index')
            ->with('success', 'Data lembur berhasil disimpan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $overtime = Overtime::with('employee')->findOrFail($id);

        return view('overtimes.show', compact('overtime'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $overtime  = Overtime::findOrFail($id);
        $employees = Employee::orderBy('nama_lengkap')->get();
        $tarifPerJam = 25000; 

        return view('overtimes.edit', compact('overtime', 'employees', 'tarifPerJam'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'tanggal'     => 'required|date',
            'jam_mulai'   => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i|after:jam_mulai',
        ]);

        $overtime = Overtime::findOrFail($id);

        // Hitung ulang total jam lembur
        $mulai    = Carbon::createFromFormat('H:i', $validated['jam_mulai']);
        $selesai  = Carbon::createFromFormat('H:i', $validated['jam_selesai']);
        $totalJam = $mulai->diffInHours($selesai);

        // Tarif fix
        $tarifPerJam = 25000;
        $totalLembur = $tarifPerJam * $totalJam;

        $overtime->update([
            'employee_id'   => $validated['employee_id'],
            'tanggal'       => $validated['tanggal'],
            'jam_mulai'     => $validated['jam_mulai'],
            'jam_selesai'   => $validated['jam_selesai'],
            'total_jam'     => $totalJam,
            'tarif_per_jam' => $tarifPerJam,
            'total_lembur'  => $totalLembur,
        ]);

        return redirect()->route('overtimes.index')
            ->with('success', 'Data lembur berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $overtime = Overtime::findOrFail($id);
        $overtime->delete();

        return redirect()->route('overtimes.index')
            ->with('success', 'Data lembur berhasil dihapus!');
    }
}
