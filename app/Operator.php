<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Operator extends Model
{
  protected $fillable = [
      'name',
      'country_id',
      'rbt_sms_code',
      'image',
      'rbt_ussd_code',
  ];

  public function setImageAttribute($value){
    $img_name = time().rand(0,999).'.'.$value->getClientOriginalExtension();
    $value->move(base_path('/uploads/operator'),$img_name);
    $this->attributes['image']= $img_name ;
  }

  public function getImageAttribute($value)
  {
    return url('/uploads/operator/'.$value);
  }

  public function country()
  {
      return $this->belongsTo('App\Country') ;
  }

  public function posts()
  {
    return $this->hasMany('App\Post','operator_id','id');
  }

  public function contents()
  {
    return $this->belongsToMany('App\Content','posts','operator_id','content_id')
    ->withPivot('id','published_date','active','url','user_id')->withTimestamps();
  }

}
