<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Leave extends Model
{
    use HasFactory;
    protected $fillable = ['nomor_induk', 'tanggal_cuti', 'lama_cuti', 'keterangan'];

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'nomor_induk', 'nomor_induk');
    }
}
