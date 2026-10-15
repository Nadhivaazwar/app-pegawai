<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Department;
use App\Models\Position;
use App\Models\Employee;
use App\Models\LeaveType;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // =========================
        // 1. MASTER DEPARTMENT
        // =========================
        $itDept = Department::updateOrCreate(
            ['nama_department' => 'IT'],
            [] // departments hanya punya nama_department + timestamps
        );

        $hrDept = Department::updateOrCreate(
            ['nama_department' => 'HRD'],
            []
        );

        // =========================
        // 2. MASTER POSITION
        // (INGAT: ada kolom gaji_pokok yang NOT NULL)
        // =========================
        $posManager = Position::updateOrCreate(
            ['nama_jabatan' => 'Manager'],
            ['gaji_pokok' => 10000000] // contoh angka
        );

        $posStaff = Position::updateOrCreate(
            ['nama_jabatan' => 'Staff'],
            ['gaji_pokok' => 5000000] // contoh angka
        );

        // =========================
        // 3. MASTER LEAVE TYPES
        // (punya: nama_jenis, keterangan [nullable], maksimal_hari [nullable])
        // =========================
        LeaveType::updateOrCreate(
            ['nama_jenis' => 'Cuti Tahunan'],
            [
                'keterangan'    => 'Cuti tahunan',
                'maksimal_hari' => 12,
            ]
        );

        LeaveType::updateOrCreate(
            ['nama_jenis' => 'Sakit'],
            [
                'keterangan'    => 'Cuti sakit',
                'maksimal_hari' => 30,
            ]
        );

        // =========================
        // 4. DATA PEGAWAI UNTUK USER PEGAWAI
        // employees: nama_lengkap, email, nomor_telepon, tanggal_lahir,
        // alamat, tanggal_masuk, department_id, position_id, status
        // =========================
        $employeeUser = Employee::updateOrCreate(
            ['email' => 'pegawai@example.com'],
            [
                'nama_lengkap'  => 'Pegawai Contoh',
                'nomor_telepon' => '08123456789',
                'tanggal_lahir' => '2000-01-01',
                'alamat'        => 'Alamat Pegawai Contoh',
                'tanggal_masuk' => now()->toDateString(),
                'department_id' => $itDept->id,
                'position_id'   => $posStaff->id,
                'status'        => 'aktif',
            ]
        );

        // =========================
        // 5. USERS: ADMIN, HR, PEGAWAI
        // users: employee_id [nullable], name, email, role, password, ...
        // =========================

        // Admin
        User::updateOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name'        => 'Admin Utama',
                'password'    => Hash::make('password'), // password: password
                'role'        => 'admin',
                'employee_id' => null,
            ]
        );

        // HR
        User::updateOrCreate(
            ['email' => 'hr@example.com'],
            [
                'name'        => 'HRD',
                'password'    => Hash::make('password'), // password: password
                'role'        => 'hr',
                'employee_id' => null,
            ]
        );

        // Pegawai (terhubung ke employees)
        User::updateOrCreate(
            ['email' => 'pegawai@example.com'],
            [
                'name'        => 'Pegawai Contoh',
                'password'    => Hash::make('password'), // password: password
                'role'        => 'employee',
                'employee_id' => $employeeUser->id,
            ]
        );
    }
}
