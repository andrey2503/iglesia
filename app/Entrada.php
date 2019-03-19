<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

use Illuminate\Database\Eloquent\SoftDeletes;
class Entrada extends Model
{
  use Notifiable;
  use SoftDeletes;
    protected $table="entradas";
    //
    protected $dates = ['deleted_at'];

    public function rubro()
    {
        return $this->hasOne('App\Rubro','id','fk_rubro');
    }
    public function movEntrada()
    {
        return $this->hasOne('App\MovEntrada','id','fk_entrada');
    }
}
