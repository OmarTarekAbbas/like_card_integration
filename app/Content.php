<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
  protected $fillable = ['title','path','image_preview','content_type_id','category_id','patch_number'];

  ///////////////////set image///////////////////////////////
  public function setImagePreviewAttribute($value){
    if(!is_numeric($value))
    {
      $img_name = time().rand(0,999).'.'.$value->getClientOriginalExtension();
      $value->move(base_path('/uploads/content/image'),$img_name);
      $this->attributes['image_preview']= $img_name ;
    }
    else{
      $this->attributes['image_preview']= $value.'.jpg' ;
    }

  }

  public function getImagePreviewAttribute($value)
  {
    return url('/uploads/content/image/'.$value);
  }

  ////////////////// set path ////////////////
  public function setPathAttribute($value){
    if(!is_string($value))
    {
      $img_name = time().rand(0,999).'.'.$value->getClientOriginalExtension();
      $value->move(base_path('/uploads/content/path'),$img_name);
      $this->attributes['path']= $img_name ;
    }
    else
    {
      $this->attributes['path']= $value ;
    }
  }

  public function getPathAttribute($value)
  {
    if(preg_match('(mp4|flv|3gp|mp3|webm|wav|png|jpeg|jpg)', $value))
    {
    return url('/uploads/content/path/'.$value);
    }
    else
    {
      return $value;
    }

  }


  public function category()
  {
    return $this->belongsTo('App\Category','category_id','id');
  }

  public function type()
  {
    return $this->belongsTo('App\ContentType','content_type_id','id');
  }

  // rbt sms code realtion
  public function rbt_operators()
  {
    return $this->belongsToMany('App\Operator','rbt_codes','content_id','operator_id')
    ->withPivot('id','rbt_code')->withTimestamps();
  }

  public function operators()
  {
    return $this->belongsToMany('App\Operator','posts','content_id','operator_id')
    ->withPivot('id','published_date','active','url','user_id')->withTimestamps();
  }

  public function posts()
  {
    return $this->hasMany('App\Post','content_id','id');
  }
}
