<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
  protected $fillable = ['published_date','active','url','content_id','operator_id','user_id'];


  public function operator()
  {
    return $this->belongsTo('App\Operator','operator_id','id');
  }

  public function content()
  {
    return $this->belongsTo('App\Content','content_id','id');
  }

  public function user()
  {
    return $this->belongsTo('App\User','user_id','id');
  }
}
