<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jam extends Model
{
    protected $table = 'jam_masuk_pulang';
    protected $guarded = ['id']; 
    protected $primaryKey = 'id'; 
    public $timestamps = false;
 


   
}
