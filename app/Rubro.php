<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
class Rubro extends Model
{
  use Notifiable;
  use SoftDeletes;
    protected $table="rubros";
    //
    protected $fillable = [
        'nombre', 'descripcion',
    ];

    protected $dates = ['deleted_at'];

    public function CuentaCobrar()
    {
        return $this->hasMany('App\Rubro','fk_rubro');
    }
    public function CuentaPagar()
    {
        return $this->hasMany('App\Rubro','fk_rubro');
    }
    public function Entrada()
    {
        return $this->hasMany('App\Rubro','fk_rubro');
    }

    public function Salida()
    {
        return $this->hasMany('App\Rubro','fk_rubro');
    }

    public function movimientoSalida()
    {
        return $this->hasMany('App\Rubro','fk_rubro');
    }
    public function movimientoEntrada()
    {
        return $this->hasMany('App\Rubro','fk_rubro');
    }

}
