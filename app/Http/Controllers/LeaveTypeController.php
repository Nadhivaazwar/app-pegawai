<?php

namespace App\Http\Controllers;

use App\Models\LeaveType;
use Illuminate\Http\Request;

class LeaveTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $leaveTypes = LeaveType::latest()->paginate(5);
        return view('leave_types.index', compact('leaveTypes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('leave_types.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_jenis'    => 'required|string|max:255',
            'maksimal_hari' => 'nullable|integer',
            'keterangan'    => 'nullable|string',
        ]);

        LeaveType::create($request->all());

        return redirect()->route('leave_types.index')
            ->with('success', 'Jenis cuti berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $leaveType = LeaveType::find($id);
        return view('leave_types.show', compact('leaveType'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $leaveType = LeaveType::find($id);
        return view('leave_types.edit', compact('leaveType'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama_jenis'    => 'required|string|max:255',
            'maksimal_hari' => 'nullable|integer',
            'keterangan'    => 'nullable|string',
        ]);

        $leaveType = LeaveType::findOrFail($id);
        $leaveType->update($request->only([
            'nama_jenis',
            'maksimal_hari',
            'keterangan',
        ]));

        return redirect()->route('leave_types.index')
            ->with('success', 'Jenis cuti berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $leaveType = LeaveType::findOrFail($id);
        $leaveType->delete();

        return redirect()->route('leave_types.index')
            ->with('success', 'Jenis cuti berhasil dihapus!');
    }
}
