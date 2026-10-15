<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
    {
        use HasFactory;
        protected $fillable = [
            'employee_id',
            'tanggal',
            'waktu_masuk',
            'waktu_keluar',
            'status_absensi',
        ];

        public function employee() {
            return $this->belongsTo(Employee::class, 'employee_id');
        }
    }
