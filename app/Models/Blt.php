<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blt extends Model
{
    use HasFactory;

    /**
     * Nama tabel jika Anda tidak menggunakan jamak (optional)
     * protected $table = 'blts';
     */

    protected $fillable = [
        'nik',
        'kk',
        'nama',
        'alamat',
        'metode_pencairan',
        'tahun',
        'status'
    ];

    /**
     * Casting status untuk mempermudah manipulasi data (optional)
     */
    protected $casts = [
        'tahun' => 'integer',
    ];
}
