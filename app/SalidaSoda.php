<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

use Illuminate\Database\Eloquent\SoftDeletes;
class SalidaSoda extends Model
{
  use Notifiable;
  use SoftDeletes;
    protected $table="salida_sodas";

    //
    protected $dates = ['deleted_at'];

    public function AdministradorSoda()
    {
        return $this->hasOne('App\AdministradorSoda','id','fk_grupo');
    }
}
