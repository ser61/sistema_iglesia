<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Modulo extends Model
{
    //
    protected $table = "modulos";
    protected $fillable = ['numero','numeroescuela','fechainicio'];

  public function scope_getNext($query, $escuela)
  {
    $modulos = $query->where('numeroescuela',$escuela);
    if( count($modulos->get()) > 1){
      $numero = $modulos->select( DB::raw('sum(numero) as max') )->get()->first();
      $numero = 6 - $numero['max'];
      return $numero;
    }
    if( count($modulos->get()) > 0){
      $numero = $modulos->select( DB::raw('max(numero) as max') )->get()->first();
      if($numero['max'] == 3){
        $numero = 1;
      }else{
        $numero = $numero['max'] + 1;
      }
      return $numero;
    }
    return 1;
  }
}
