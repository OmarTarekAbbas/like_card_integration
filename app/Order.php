<?php

namespace App;

use App\Constants\PaymentStatus;
use App\Constants\PaymentType;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
  protected $fillable = [
    'client_id', 'status', 'total_price', 'payment', 'payment_status', 'transaction_id'
  ];

  public function getPaymentAttribute($value)
  {
    return PaymentType::getLabel($value);
  }

  public function getPaymentStatusAttribute($value)
  {
    return PaymentStatus::getLabel($value);
  }

  public function products()
  {
    return $this->hasMany('App\OrderItem');
  }

  public function client()
  {
    return $this->belongsTo('App\Client');
  }
}
