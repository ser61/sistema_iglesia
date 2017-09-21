<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Trabajo extends Model
{
    //
    protected $table = "trabajos";
    protected $fillable = ['cimiembro','nombredescripcion','direccion'];
    protected $primaryKey = 'nrodetrabajo';
}
