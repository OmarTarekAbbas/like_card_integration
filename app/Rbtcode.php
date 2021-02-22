<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RbtCode extends Model
{
    protected $fillable = ['content_id','operator_id','rbt_code'];

    public function operator()
    {
      return $this->belongsTo('App\Operator','operator_id','id');
    }

    public function content()
    {
      return $this->belongsTo('App\Content','content_id','id');
    }


}
