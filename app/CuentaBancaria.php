<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
class CuentaBancaria extends Model
{
  use Notifiable;
  use SoftDeletes;
    protected $table="cuenta_bancarias";
    //
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre', 'tipo','moneda', 'banco', 'monto','cuenta',
    ];
    public function movimientoSalida()
    {
        return $this->hasMany('App\CuentaBancaria','fk_cuenta');
    }
    public function movimientoEntrada()
    {
        return $this->hasMany('App\CuentaBancaria','fk_cuenta');
    }
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    // protected $hidden = [
    //     'password', 'remember_token',
    // ];
    protected $dates = ['deleted_at'];
}
