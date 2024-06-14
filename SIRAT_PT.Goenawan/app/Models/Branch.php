<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_cabang',
        'kota_kabupaten',
        'alamat',
        'nama_pimpinan',
        'nib_cabang',
        'pdf_nib',
        'pdf_akta_cabang',
    ];

    public function karyawans()
    {
        return $this->hasMany(Karyawan::class, 'cabang_id');
    }
}
