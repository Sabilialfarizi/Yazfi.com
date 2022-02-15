<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use JetBrains\PhpStorm\Pure;

class TukarFaktur extends Model
{
    protected $guarded = ['id'];

    protected $guarded = ['id'];

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'id');
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
    public function project()
    {
        return $this->belongsTo(Project::class, 'id');
    }
    public function cabang()
    {
        return $this->belongsTo(Cabang::class, 'cabang_id');
    }
    public function admin()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function roles()
    {
        return $this->hasMany(User::class, 'users.cabang_id');
    }
}