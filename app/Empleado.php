<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Empleado extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    
    public function puesto()
    {
        return $this->hasOne('App\Puesto','id','fk_puesto');
    }
    //
}
