<?php
namespace App;

use App\Constants\OrderStatus;
use App\Constants\PaymentType;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Client extends Authenticatable
{
    use Notifiable,HasRoles;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'password', 'image', 'phone', 'operator_id'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    public function setOperatorIdAttribute($value)
    {
      $newValue = explode('-', $value);
      $this->attributes['operator_id']= $newValue[1] ;
    }

    public function operator()
    {
        return $this->belongsTo('App\Operator') ;
    }


    public function orders()
    {
      return $this->hasMany(Order::class)
      ->orderBy("orders.created_at", "desc")
      ->where("status", OrderStatus::FINISHED)
      ->whereNotNull("transaction_id");
    }

}
