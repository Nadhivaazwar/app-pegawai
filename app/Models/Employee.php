<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Department;
use App\Models\Position;
use App\Models\Leave;
use App\Models\Attendance;
use App\Models\Overtime;
use App\Models\Salaries;




class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_lengkap',
        'email',
        'department_id',
        'position_id',
        'nomor_telepon',
        'alamat',
        'tanggal_lahir',
        'tanggal_masuk',
        'status',
    ];

    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id', 'id');
    }

    public function position()
    {
        return $this->belongsTo(Position::class, 'position_id');
    }

    public function leaves()
    {
        return $this->hasMany(Leave::class, 'employee_id', 'id');
    }

    public function overtimes()
    {
        return $this->hasMany(Overtime::class);
    }

    public function salaries()
    {
        return $this->hasMany(Salary::class);
    }

    public function attendances()
    {
        return $this->hasMany(Attendance::class, 'employee_id', 'id');
    }
}
