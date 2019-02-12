<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

use Illuminate\Database\Eloquent\SoftDeletes;
class MovimientoSalida extends Model
{
  use Notifiable;
  use SoftDeletes;
    protected $table="mov_salidas";
    //
    protected $dates = ['deleted_at'];

    public function rubro()
    {
        return $this->hasOne('App\Rubro','id','fk_rubro');
    }
    public function usuario()
    {
        return $this->hasOne('App\User','id','fk_usuario');
    }
    public function cuenta()
    {
        return $this->hasOne('App\CuentaBancaria','id','fk_cuenta');
    }
}
