<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Employee;

class EmployeeDashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // cari data employee yang terhubung
        $employee = $user->employee
            ?? Employee::where('email', $user->email)->first();

        // default koleksi kosong
        $salaries    = collect();
        $leaves      = collect();
        $attendances = collect();

        if ($employee) {
            // 5 gaji terbaru
            $salaries = $employee->salaries()
                ->latest()
                ->take(5)
                ->get();

            // 5 cuti terbaru
            $leaves = $employee->leaves()
                ->with('leaveType')
                ->latest()
                ->take(5)
                ->get();

            // 5 absensi terbaru
            $attendances = $employee->attendances()
                ->orderByDesc('tanggal')
                ->take(5)
                ->get();
        }

        return view('dashboard_employee', compact(
            'employee',
            'salaries',
            'leaves',
            'attendances'
        ));
    }
}
