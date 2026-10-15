<?php

namespace App\Http\Controllers;
use App\Models\Employee; 
use App\Models\Department;
use App\Models\Position;
use Illuminate\Http\Request;
class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employees = Employee::latest()->paginate(5);
        $departments = Department::all();
        $positions = Position::all();
        return view('employees.index', compact('employees', 'departments', 'positions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $departments = Department::all();
        $positions = Position::all();
        return view('employees.create', compact('departments', 'positions'));
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_lengkap'   => 'required|string|max:255',
            'email'          => 'required|email|max:255',
            'nomor_telepon'  => 'required|string|max:20',
            'tanggal_lahir'  => 'required|date',
            'alamat'         => 'required|string|max:255',
            'tanggal_masuk'  => 'required|date',
            'department_id'  => 'required|exists:departments,id', 
            'position_id'    => 'required|exists:positions,id',
            'status'         => 'required|string|max:50',
        ]);

        Employee::create($request->all());
        return redirect()->route('employees.index')
            ->with('success', 'Data pegawai berhasil disimpan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $employee = Employee::find($id);
        return view('employees.show', compact('employee'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $employee = Employee::find($id);
        $departments = Department::all();
        $positions = Position::all();
        return view('employees.edit', compact('employee', 'departments', 'positions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
        'nama_lengkap'   => 'required|string|max:255',
        'email'          => 'required|email|max:255',
        'nomor_telepon'  => 'required|string|max:20',
        'tanggal_lahir'  => 'required|date',
        'alamat'         => 'required|string|max:255',
        'tanggal_masuk'  => 'required|date',
        'department_id'  => 'required|exists:departments,id', 
        'position_id'    => 'required|exists:positions,id',
        'status'         => 'required|string|max:50',
        ]);
        $employee = Employee::findOrFail($id);
        $employee->update($request->only([ 
            'nama_lengkap',
            'email', 
            'nomor_telepon', 
            'tanggal_lahir', 
            'alamat', 
            'tanggal_masuk', 
            'department_id',
            'position_id',
            'status',
        ]));
        return redirect()->route('employees.index')
            ->with('success', 'Data pegawai berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $employee = Employee::find($id);
        $employee->delete();
        return redirect()->route('employees.index')
            ->with('success', 'Data pegawai berhasil dihapus!');
    }
}
