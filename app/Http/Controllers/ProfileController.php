<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Tampilkan halaman "Profil Saya" untuk user yang login.
     */
    public function edit(Request $request): View
    {
        $user = $request->user();

        // Load relasi employee + department + position (jika ada)
        $user->loadMissing('employee.department', 'employee.position');

        $employee = $user->employee; // bisa null kalau belum ada di tabel employees

        return view('profiles.edit', compact('user', 'employee'));
    }

    /**
     * Update data akun user (nama, email, password).
     * Data pegawai tetap dikelola admin di menu Employee,
     * tapi kita sinkronkan nama & email saat user mengubah profil.
     */
    public function update(Request $request): RedirectResponse
    {
        $user = $request->user();

        $validated = $request->validate([
            'name'     => ['required', 'string', 'max:255'],
            'email'    => ['required', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'password' => ['nullable', 'confirmed', 'min:8'],
        ]);

        // Update akun (tabel users)
        $user->name  = $validated['name'];
        $user->email = $validated['email'];

        if (!empty($validated['password'])) {
            $user->password = Hash::make($validated['password']);
        }

        $user->save();

        // 🔁 Sinkronkan ke data pegawai (tabel employees) kalau ada
        if ($user->employee) {
            $user->employee->update([
                'nama_lengkap' => $validated['name'],
                'email'        => $validated['email'],
            ]);
        }

        return redirect()
            ->route('profile.edit')
            ->with('status', 'Profil berhasil diperbarui.');
    }
}
