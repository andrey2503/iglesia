<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

use Illuminate\Database\Eloquent\SoftDeletes;
class AdministradorSoda extends Model
{
  use Notifiable;
  use SoftDeletes;
    protected $table="administrador_sodas";
    //


      protected $dates = ['deleted_at'];

      public function EntradaSoda()
      {
          return $this->hasMany('App\EntradaSoda','fk_grupo');
      }
      public function SalidaSoda()
      {
          return $this->hasMany('App\SalidaSoda','fk_grupo');
      }
}
