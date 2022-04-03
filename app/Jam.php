<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jam extends Model
{
    protected $table = 'shifts';
    protected $guarded = ['id']; 
    protected $primaryKey = 'id'; 
    public $timestamps = false;
 


   
}
