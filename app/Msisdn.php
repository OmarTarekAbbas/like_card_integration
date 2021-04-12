<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Msisdn extends Model
{
  protected $fillable = ['msisdn', 'status', 'unique_id'];
}
