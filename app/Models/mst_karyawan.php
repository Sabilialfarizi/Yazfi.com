<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class mst_karyawan extends Model
{
    // use HasFactory;
    protected $table    = 'karyawan';

    protected $fillable     =   [ 
                                'nama',
                                'nik',
                                'telp',
                                'id_user',
                                'id_jabatan',
                                'alamat',
                                'tgl_lahir'
                                ];  
}
