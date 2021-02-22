<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RoleRoute extends Model
{
    protected $table = "role_route" ;
    protected $fillable = ['role_id','route_id'] ;

    public function route()
    {
        return $this->belongsTo('App\RouteModel','route_id','id');
    }

    public function role()
    {
        return $this->belongsTo('App\Role','role_id','id');
    }
}
