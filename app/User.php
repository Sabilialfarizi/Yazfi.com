<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Model;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;
    use HasRoles;

    protected $guarded = ['id'];
    protected $table = 'users';
    public $timestamps = false;


    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }
    public function getJWTCustomClaims()
    {
        return [];
    }

    public function cabang()
    {
        return $this->belongsTo(Cabang::class, 'cabang_id');
    }

    public function jadwal()
    {
        return $this->hasMany(Jadwal::class);
    }

    public function customer()
    {
        return $this->hasMany(Customer::class);
    }

    public function booking()
    {
        return $this->hasMany(Booking::class);
    }
  
    public function rincian()
    {
        return $this->hasMany(RincianPembayaran::class, 'kasir_id');
    }

    public function komisi()
    {
        return $this->hasMany(RincianKomisi::class);
    }
    public function purchase()
    {
        return $this->belongsTo(Purchase::class, 'project_id');
    }
    public function reinburst()
    {
        return $this->belongsTo(Reinburst::class, 'id');
    }
    public function perusahaan()
    {
        return $this->belongsTo(Perusahaan::class, 'id_perusahaan');
    }
    public function jabatan()
    {
        return $this->belongsTo(Jabatan::class, 'id_jabatans');
    }

    public function project()
    {
        return $this->belongsTo(Project::class, 'cabang_id');
    }

    public function sales()
    {
        return $this->hasMany(TeamSales::class);
    }

}
