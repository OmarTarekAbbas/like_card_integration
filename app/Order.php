<?php

namespace App;

use App\Constants\DcbStatus;
use App\Constants\PaymentType;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
  protected $fillable = [
    'client_id', 'status', 'total_price', 'currency', 'payment', 'transaction_id', 'pincode_request_id', 'pincode_verify_id',
    'product_name', 'product_image', 'valid_to', 'serial_id', 'serial_code', 'hash_serial_code', 'sell_price', 'original_price', 'phone', 'phone_code', 'operator_id', 'dcb_status', 'quantity'
  ];

  public function getDcbStatusAttribute($value)
  {
    return DcbStatus::getLabel($value);
  }

  public function products()
  {
    return $this->hasMany('App\OrderItem');
  }

  public function client()
  {
    return $this->belongsTo('App\Client');
  }

  public function replaies()
  {
    return $this->hasMany(OrderReplay::class);
  }
}
