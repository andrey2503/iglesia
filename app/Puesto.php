<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
class Puesto extends Model
{
  use Notifiable;
  use SoftDeletes;
    protected $table="puestos";
    //
    protected $fillable = [
        'nombre', 'descripcion',
    ];

    protected $dates = ['deleted_at'];
    //
    public function Salario()
    {
        return $this->hasMany('App\Salario','fk_puesto');
    }
    public function Empleado()
    {
        return $this->hasMany('App\Salario','fk_puesto');
    }
}
