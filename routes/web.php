<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\SalaryController;
use App\Http\Controllers\LeaveTypeController;
use App\Http\Controllers\LeaveController;
use App\Http\Controllers\OvertimeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\EmployeeDashboardController;
use App\Http\Controllers\ProfileController;

// =========================
// HALAMAN AWAL
// =========================
Route::get('/', function () {
    return redirect()->route('login');
});

// =========================
// AUTH (GUEST SAJA)
// =========================
Route::middleware('guest')->group(function () {
    Route::get('/login',    [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login',   [LoginController::class, 'login']);

    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register',[RegisterController::class, 'register']);
});

// =========================
// ROUTE YANG BUTUH LOGIN
// =========================
Route::middleware('auth')->group(function () {

    // LOGOUT
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    // ---------- PEGAWAI ----------
    Route::middleware('role:employee')->group(function () {
        Route::get(
            '/dashboard-pegawai',
            [EmployeeDashboardController::class, 'index']
        )->name('employee.dashboard');

        Route::get('/profile',   [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');

        Route::post(
            '/attendance/check-in',
            [AttendanceController::class, 'checkIn']
        )->name('attendance.checkin');

        Route::post(
            '/attendance/check-out',
            [AttendanceController::class, 'checkOut']
        )->name('attendance.checkout');
    });

    // ---------- ROUTE CUTI (BOLEH admin, hr, employee) ----------
    // role detail di-handle di LeaveController
    Route::get('/leaves/create', [LeaveController::class, 'create'])->name('leaves.create');
    Route::post('/leaves',       [LeaveController::class, 'store'])->name('leaves.store');

    // ---------- ADMIN SAJA: MASTER DATA ----------
    Route::middleware('role:admin')->group(function () {
        Route::resource('departments', DepartmentController::class);
        Route::resource('positions',   PositionController::class);
        Route::resource('leave_types', LeaveTypeController::class);
    });

    // ---------- ADMIN + HR: DASHBOARD & DATA OPERASIONAL ----------
    Route::middleware('role:admin,hr')->group(function () {

        Route::get('/dashboard', [AdminDashboardController::class, 'index'])
            ->name('dashboard');

        Route::resource('employees',   EmployeeController::class);
        Route::resource('attendances', AttendanceController::class);

        // admin + hr: semua aksi salary KECUALI show
        Route::resource('salaries', SalaryController::class)->except(['show']);

        // leaves: create & store sudah dibuat di luar, jadi di sini kita kecualikan
        Route::resource('leaves',  LeaveController::class)->except(['create', 'store']);
        Route::resource('overtimes', OvertimeController::class);

        Route::post('leaves/{leave}/approve', [LeaveController::class, 'approve'])
            ->name('leaves.approve');
        Route::post('leaves/{leave}/reject',  [LeaveController::class, 'reject'])
            ->name('leaves.reject');
    });

    // ---------- SLIP GAJI: boleh admin, hr, employee ----------
    Route::middleware('role:admin,hr,employee')->group(function () {
        Route::get('/salaries/{salary}', [SalaryController::class, 'show'])
            ->name('salaries.show');
    });
});
