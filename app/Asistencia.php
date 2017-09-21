<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Asistencia extends Model
{
    //
    protected $table = "asistencias";
    protected $fillable = ['cimiembro','idinforme'];

    public function scope_cumpleAsistencia($query, $cimiembro){
    	$nro = $query->join('miembros as m','m.ci','=','cimiembro')
    								->join('informes as i','i.id','=','idinforme')
    								->where('m.ci',$cimiembro)
    								->select(DB::raw('count(asistencias.id) as asistencia'))->get()->first();
			return $nro;
    }

  public function scope_getAsistentes($query, $idInforme)
  {
    $asistentes = $query->join('miembros','asistencias.cimiembro','=','miembros.ci')
                        ->join('personas','personas.ci','=','miembros.ci')
                        ->join('informes','informes.id','=','asistencias.idinforme')
                        ->where('informes.id','=',$idInforme)
                        ->select(
                          'asistencias.id as id',
                          'personas.ci as ci',
                          'personas.nombre as nombre',
                          'personas.apellido as apellido'
                        )->orderBy('asistencias.id','desc');
    return $asistentes;
  }

  public function scope_buscarAsistentes($query, $search, $idinforme)
  {
    $asistentes = $this->_getAsistentes($idinforme)
                        ->where(function($query) use ($search){
                          return $query->where('personas.ci','LIKE','%'.$search.'%')
                                      ->orWhere('personas.nombre','LIKE','%'.$search.'%')
                                      ->orWhere('personas.apellido','LIKE','%'.$search.'%');
                        });
    return $asistentes;
  }

  public function scope_existAsistente($query, $cimiembro, $idInforme)
  {
    $aaistente = $query->where('cimiembro',$cimiembro)->where('idinforme', $idInforme)->get();
    if(count($aaistente) > 0){
      return 1;
    }
    return -1;
  }
}
