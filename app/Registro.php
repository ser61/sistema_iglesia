<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Registro extends Model
{
    //
    protected $table = "registros";
    protected $fillable = ['id','idreunion','fecha','numerodeasistentes','ofrenda'];

    public function scope_getRegistros($query, $reunion)
    {
        return $query->where('idreunion',$reunion)->orderBy('fecha','desc');
    }
}