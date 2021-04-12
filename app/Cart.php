<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
  protected $fillable = [
    'client_id', 'product_name', 'product_image','currency', 'quantity', 'price', 'total_price'
  ];

  public function client()
  {
    return $this->belongsTo('App\Client');
  }
}
