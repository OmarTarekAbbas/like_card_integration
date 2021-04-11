<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
  protected $fillable = [
    'order_id', 'product_name', 'product_image', 'valid_to', 'serial_id', 'serial_code', 'currency', 'quantity', 'price', 'total_price'
  ];

  public function order()
  {
    return $this->belongsTo('App\Order');
  }
}
