<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Overtime extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'tanggal',
        'jam_mulai',
        'jam_selesai',
        'total_jam',
        'tarif_per_jam',
        'total_lembur',
        'disetujui_oleh',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
