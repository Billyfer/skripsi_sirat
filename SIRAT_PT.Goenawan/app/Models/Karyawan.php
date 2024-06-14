<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable; 
use Illuminate\Notifications\Notifiable;

class Karyawan extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'nama',
        'role',
        'cabang_id',
        'email',
        'no_wa',
        'alamat',
        'username',
        'password',
    ];

    public function cabang()
    {
        return $this->belongsTo(Branch::class, 'cabang_id');
    }

    protected $hidden = [
        'password',
        'remember_token',
    ];
}
