<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class absensi extends Model
{
    // use HasFactory;
    protected $table    = 'absensi';

    protected $fillable     =   [ 
                            'karyawan_id','tanggal','jam_masuk','jam_keluar','latitude','longitude','alamat','keterangan','ft_selfie_in','ft_selfie_out'
        ]; 

    // Join table kelas untuk memanggil field karyawan di tabel karyawan
    public function karyawan()
    {
        return $this->belongsTo(mst_karyawan::class);
    }

    public function scopeAbsensi($query, $id)
    {
        return $query->where("karyawan_id", $id);
    }

}
