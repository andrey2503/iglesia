<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

use Illuminate\Database\Eloquent\SoftDeletes;

class Salida extends Model
{
    //
    use Notifiable;
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    public function rubro()
    {
        return $this->hasOne('App\Rubro','id','fk_rubro');
    }
    public function movSalida()
    {
        return $this->hasOne('App\MovSalida','id','fk_salida');
    }
}
