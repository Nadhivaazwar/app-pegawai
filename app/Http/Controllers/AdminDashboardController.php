<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Department;
use App\Models\Leave;
use App\Models\Overtime;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $totalPegawai = Employee::count();
        $totalDept    = Department::count();
        $cutiPending  = Leave::where('status', 'pending')->count();

        $latestLeaves = Leave::with(['employee', 'leaveType'])
            ->latest()
            ->take(5)
            ->get();

        $latestOvertimes = Overtime::with('employee')
            ->latest()
            ->take(5)
            ->get();

        return view('dashboard', compact(
            'totalPegawai',
            'totalDept',
            'cutiPending',
            'latestLeaves',
            'latestOvertimes'
        ));
    }
}
