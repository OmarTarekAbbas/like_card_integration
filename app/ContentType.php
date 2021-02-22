<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContentType extends Model
{
    protected $fillable = ['title'];

    public function contents()
    {
      return $this->hasMany('App\Content','content_type_id','id');
    }
}
