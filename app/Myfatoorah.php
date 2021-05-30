<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Myfatoorah extends Model
{
    protected $fillable = ['url', 'request', 'response', 'type', 'order_id', 'invoice_id', 'payment_url', 'payment_method', 'invoice_status', 'Transaction_status'];
}
