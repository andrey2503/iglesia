<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
class CuentaPagar extends Model
{  use Notifiable;
  use SoftDeletes;
  protected $table="cuenta_pagars";


    protected $fillable = [
        'nombre', 'identificacion','moneda', 'monto', 'fk_rubro',
    ];
    protected $dates = ['deleted_at'];
    //
    public function rubro()
    {
        return $this->hasOne('App\Rubro','id','fk_rubro');
    }
}
