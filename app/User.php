<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes; 
class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;  
    protected $table="usuarios";
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre', 'correo','telefono', 'idrol', 'usuario','password','fk_usuario',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    protected $dates = ['deleted_at'];

    public function Logs()
    {
        return $this->hasMany('App\Logs','fk_usuario');
    }

    // public function Logs()
    // {
    //     return $this->belongsToMany('App\Logs','fk_usuario');
    // }
}
