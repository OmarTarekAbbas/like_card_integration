<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $fillable = ['title'];

    public function operator()
    {
      return $this->hasMany(Operator::class);
    }
}
