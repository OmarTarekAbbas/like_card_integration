<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Myfatoorah extends Model
{
    protected $fillable = ['url', 'request', 'response', 'type', 'order_id', 'payment_id', 'invoice_id', 'payment_url', 'payment_method', 'invoice_status', 'transaction_status'];
}
