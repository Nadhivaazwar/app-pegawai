<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    // Tampilkan form register
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    // Proses register
    public function register(Request $request)
    {
        // 1. Validasi input
        $validated = $request->validate([
            'email'    => 'required|email|exists:employees,email|unique:users,email',
            'password' => 'required|confirmed|min:8',
        ], [
            'email.exists' => 'Email ini belum terdaftar di data pegawai.',
        ]);

        // 2. Ambil data pegawai berdasarkan email
        $employee = Employee::where('email', $validated['email'])->first();

        if (! $employee) {
            return back()
                ->withErrors(['email' => 'Email ini belum terdaftar di data pegawai.'])
                ->withInput();
        }

        // 3. Buat user baru, nama diisi dari pegawai
        $user = User::create([
            'name'     => $employee->nama_lengkap, // <— isi kolom name dari employee
            'email'    => $employee->email,
            'password' => Hash::make($validated['password']),
            'role'     => 'employee',              // otomatis jadi pegawai
        ]);

        // 4. Langsung login
        auth()->login($user);

        // 5. Arahkan ke dashboard pegawai
        return redirect()->route('employee.dashboard')
            ->with('success', 'Registrasi berhasil. Selamat datang!');
    }
}
