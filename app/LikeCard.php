<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LikeCard extends Model
{
    protected $table = "like_cards" ;
    protected $fillable = ['req','response' ,'function_name'];

}
