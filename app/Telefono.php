<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Telefono extends Model
{
    //
    protected $table = "telefonos";
    protected $fillable = ['cimiembro','numero','descripcion'];
    protected $primaryKey = 'cod';
}
