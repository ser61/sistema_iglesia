<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class EscuelaDeLideres extends Model
{
    //
    protected $table = "escuelasdelideres";
    protected $fillable = ['numero','cimiembro'];
    protected $primaryKey = 'numero';

  public function scope_getEscuelas($query)
  {
    $escuelas = $query->join('miembros as m','m.ci', '=','cimiembro')
                      ->join('personas as p','p.ci','=','m.ci')
                      ->select(
                        'numero as numero',
                        'm.ci as ci',
                        'p.nombre as nombre',
                        'p.apellido as apellido'
                      )->orderBy('numero','desc');
    return $escuelas;
  }

  public function scope_getAprobados($query, $escuela)
  {
    $aprobados = $query->join('modulos as mo','mo.numeroescuela','escuelasdelideres.numero')
                        ->join('clases as c','c.idmodulo','mo.id')
                        ->join('fichascontrol as f','f.nclase','c.id')
                        ->join('miembros as mi','mi.ci','f.cimiembro')
                        ->join('personas as p','p.ci','mi.ci')
                        ->where('escuelasdelideres.numero',$escuela)
                        ->groupBy('mi.ci')
                        ->havingRaw('avg(f.nota) > 50')
                        ->havingRaw('count(distinct mo.numero) > 2')
                        ->select(
                          'escuelasdelideres.numero as escuela',
                          'mi.ci as ci',
                          'p.nombre as nombre',
                          'p.apellido as apellido',
                          DB::raw('count(if(f.asistencia = 0,f.asistencia,null)) as faltas'),
                          DB::raw('count(if(f.asistencia = 1,f.asistencia,null)) as asistidas'),
                          DB::raw('round(avg(f.nota),2) as notafinal')
                        );
    return $aprobados;
  }

  public function scope_getReprobados($query, $escuela)
  {
    $aprobados = $query->join('modulos as mo','mo.numeroescuela','escuelasdelideres.numero')
      ->join('clases as c','c.idmodulo','mo.id')
      ->join('fichascontrol as f','f.nclase','c.id')
      ->join('miembros as mi','mi.ci','f.cimiembro')
      ->join('personas as p','p.ci','mi.ci')
      ->where('escuelasdelideres.numero',$escuela)
      ->groupBy('mi.ci')
      ->orderBy('f.nota','desc')
      ->havingRaw('count(distinct mo.numero) < 3')
      ->select(
        'escuelasdelideres.numero as escuela',
        'mi.ci as ci',
        'p.nombre as nombre',
        'p.apellido as apellido',
        DB::raw('count(if(f.asistencia = 0,f.asistencia,null)) as faltas'),
        DB::raw('count(if(f.asistencia = 1,f.asistencia,null)) as asistidas'),
        DB::raw('count(distinct mo.numero) as modulos'),
        DB::raw('round(avg(f.nota),2) as notafinal')
      );
    return $aprobados;
  }

  public function scope_existeMod($query, $idescuela, $numeroMod)
  {
    $nromodulo = $query->join('modulos as m','m.numeroescuela','escuelasdelideres.numero')
                        ->where('escuelasdelideres.numero',$idescuela)
                        ->where('m.numero',$numeroMod)
                        ->select('m.id as id');
    return $nromodulo;
  }
}
