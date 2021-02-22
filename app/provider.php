<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Provider extends Model
{
  protected $fillable = ['title','image'];

  ///////////////////set image///////////////////////////////
  public function setImageAttribute($value){
    $img_name = time().rand(0,999).'.'.$value->getClientOriginalExtension();
    $value->move(base_path('/uploads/provider'),$img_name);
    $this->attributes['image']= $img_name ;
  }

  public function getImageAttribute($value)
  {
    return url('/uploads/provider/'.$value);
  }
  public function categories()
  {
    return $this->hasMany('App\Category','provider_id','id');
  }
}
