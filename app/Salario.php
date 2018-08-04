<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
class Salario extends Model
{
  use Notifiable;
  use SoftDeletes;
    protected $table="salarios";
    //
    protected $fillable = [
        'moneda', 'salarioNominal','obligaciones','salarioNeto','fk_puesto'
    ];

    protected $dates = ['deleted_at'];
    public function puesto()
    {
        return $this->hasOne('App\Puesto','id','fk_puesto');
    }
}
