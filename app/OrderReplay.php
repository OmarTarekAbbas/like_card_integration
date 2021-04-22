<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderReplay extends Model
{
    protected $fillable = ['admin_id', 'client_id', 'order_id', 'message'];

    public function admin()
    {
      return $this->belongsTo(User::class);
    }

    public function client()
    {
      return $this->belongsTo(Client::class);
    }

    public function order()
    {
      return $this->belongsTo(Order::class);
    }
  }
