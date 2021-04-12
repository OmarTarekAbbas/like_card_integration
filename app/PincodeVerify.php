<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PincodeVerify extends Model
{
  protected $fillable = ['msisdn', 'operator_id', 'price', 'request_id', 'pin', 'request', 'response'];
}
