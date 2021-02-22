<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    protected $fillable = ['title'];
    protected $table = "types" ;
    
    public function settings()
    {
        return $this->hasMany('App\Setting');
    }
    
}
