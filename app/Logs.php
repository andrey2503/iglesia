<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Logs extends Model
{
    use Notifiable;
    
    
    // public function usuario()
    // {
    //     return $this->belongsTo('App\User','id','fk_usuario');
    // }

    public function usuario()
    {
        return $this->hasOne('App\User','id','fk_usuario');
    }
}
