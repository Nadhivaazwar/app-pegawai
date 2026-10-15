<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LeaveType extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_jenis',
        'keterangan',
        'maksimal_hari',
    ];

    public function leaves()
    {
        return $this->hasMany(Leave::class);
    }
}
