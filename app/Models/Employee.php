<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    protected $fillable = ['nomor_induk', 'nama', 'alamat', 'tanggal_lahir', 'tanggal_masuk'];

    public function leaves()
    {
        return $this->hasMany(Leave::class, 'nomor_induk', 'nomor_induk');
    }
}
