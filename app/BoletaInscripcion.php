<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class BoletaInscripcion extends Model
{
    //
    protected $table = "boletasinscripcion";
    protected $fillable = ['numeromodulo','cimiembro','fecha'];

  public function scope_getCantInscriptos($query, $idmodulo)
  {
    $cantidad = $query->where('numeromodulo',$idmodulo)
                      ->select(DB::raw('count(*) as cant'))->get()->first();
    return $cantidad;
  }

  public function scope_getInscriptos($query, $idmodulo)
  {
    $inscriptos = $query->join('miembros as m','m.ci','cimiembro')
                        ->join('personas as p','p.ci','m.ci')
                        ->where('numeromodulo',$idmodulo)
                        ->select(
                          'm.ci as ci',
                          DB::raw('(concat(p.nombre," ",p.apellido)) as nombre')
                        );
    return $inscriptos;
  }
}
