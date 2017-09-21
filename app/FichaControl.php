<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class FichaControl extends Model
{
    //
    protected $table = "fichascontrol";
  protected $fillable = ['nclase','cimiembro','asistencia','nota'];
  
  public function scope_getFichas($query, $idclase)
  {
    $fichas = $query->join('miembros as m','m.ci','cimiembro')
                    ->join('personas as p','p.ci','m.ci')
                    ->where('nclase',$idclase)
                    ->select(
                      'id',
                      'm.ci as ci',
                      'p.nombre as nombre',
                      'p.apellido as apellido',
                      'asistencia',
                      'nota'
                    );
    return $fichas;
  }

  public function scope_inscriptos($query, $idclase){
    return $query->select('cimiembro')->where('nclase',$idclase)->get();
  }

  public function scope_getFaltantes($query, $idclase, $idmodulo)
  {
    $faltantes = BoletaInscripcion::_getInscriptos($idmodulo)
                              ->whereNotIn('m.ci',$this->_inscriptos($idclase))
                              ->select('m.ci','nombre');
    return $faltantes;
  }
}
