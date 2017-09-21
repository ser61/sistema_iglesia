<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Clase extends Model
{
    //
    protected $table = "clases";
    protected $fillable = ['idmodulo','fecha'];

  public function scope_getClases($query, $modulo)
  {
    $clases = DB::select(DB::raw('call getClases('.$modulo.')'));
    return $clases;
  }
}
