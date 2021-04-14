<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PincodeRequest extends Model
{
  protected $fillable = ['msisdn', 'operator_id', 'request_id', 'request', 'response'];
}
