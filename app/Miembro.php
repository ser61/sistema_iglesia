<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Collective\Html\Eloquent\FormAccessible;
use Illuminate\Support\Facades\DB;

class Miembro extends Model
{
  use FormAccessible;

  protected $table = "miembros";
  protected $fillable = ['ci','fechadeconversion','idministerio','idbautismo'];
  protected $primaryKey = 'ci';

  public function getDateOfBirthAttribute($value){
    return Carbon::parse($value)->format('m/d/Y');
  }

  public function formDateOfBirthAttribute($value){
    return Carbon::parse($value)->formtat('Y-m-d');
  }

  public function scope_miembros($query){
    $miembros = $query->join('personas','miembros.ci','=','personas.ci')
                      ->select(
                        'personas.nombre as nombre',
                        'personas.apellido as apellido',
                        'personas.ci as ci',
                        'miembros.fechadeconversion as fechadeconversion',
                        'miembros.idbautismo as idbautismo',
                        'miembros.idministerio as idministerio'
                        );
    return $miembros;
  }

  public function scope_miembrosNotAsist($query, $idinforme)
  {
    $miembros = $this->_miembros()->whereNotIn('personas.ci',(Asistencia::where('idinforme',$idinforme)
                                                                        ->select('cimiembro')->get()) );
    return $miembros;
  }

  public function scope_buscarMiembrosNotAsist($query, $search, $idinforme)
  {
    $miembros = $this->_miembrosNotAsist($idinforme)
                      ->where(function($query) use ($search){
                        return $query->where('personas.nombre','LIKE','%'.$search.'%')
                                    ->orWhere('personas.apellido','LIKE','%'.$search.'%')
                                    ->orWhere('personas.ci','LIKE','%'.$search.'%');
                      });
    return $miembros;
  }

  public function scope_buscarMiembros($query, $search){
    $lista = $this->_miembros()->where('personas.nombre','LIKE','%'.$search.'%')
                              ->orWhere('personas.apellido','LIKE','%'.$search.'%')
                              ->orWhere('miembros.ci','LIKE','%'.$search.'%');
    return $lista;
  }

  public function scope_listaBautizados($query){
    $listaBautizados = $query->join('personas','miembros.ci','=','personas.ci')
                              ->join('bautismos','miembros.idbautismo','=','bautismos.id')
                              ->select(
                                'personas.ci as ci',
                                'personas.nombre as nombre',
                                'personas.apellido as apellido',
                                'bautismos.lugar as lugar',
                                'bautismos.fecha as fecha'
                                );
    return $listaBautizados;
  }

  public function scope_buscarBautizados($query, $search){
    $lista = $this->_listaBautizados()->where('personas.nombre','LIKE','%'.$search.'%')
                                      ->orWhere('personas.apellido','LIKE','%'.$search.'%')
                                      ->orWhere('miembros.ci','LIKE','%'.$search.'%');
    return $lista;
  }

  public function scope_listaNoBautizados($query){
    $lista = $query->join('personas','miembros.ci','=','personas.ci')
                    ->whereNull('miembros.idbautismo')
                    ->select(
                      'miembros.ci as ci',
                      'personas.nombre as nombre',
                      'personas.apellido as apellido'
                      );
    return $lista;
  }

  public function scope_buscarNoBautizados($query, $search){
    $lista = $this->_listaNoBautizados()
                  ->where(function($query) use ($search){
                    return $query->where('personas.nombre','LIKE','%'.$search.'%')
                                ->orWhere('personas.apellido','LIKE','%'.$search.'%')
                                ->orWhere('miembros.ci','LIKE','%'.$search.'%');
                  });
    return $lista;                                        
  }

  public function scope_listaConMinisterios($query){
    $lista = $query->join('personas','miembros.ci','=','personas.ci')
                  ->join('ministerios','miembros.idministerio','=','ministerios.id')
                  ->select(
                    'personas.ci as ci',
                    'personas.nombre as nombre',
                    'personas.apellido as apellido',
                    'ministerios.nombre as nombreministerio'
                    );
    return $lista;
  }

  public function scope_buscarConMinisterio($query, $search){
    $lista = $this->_listaConMinisterios()->where('personas.nombre','LIKE','%'.$search.'%')
                                          ->orWhere('personas.apellido','LIKE','%'.$search.'%')
                                          ->orWhere('personas.ci','LIKE','%'.$search.'%');
    return $lista;
  }

  public function scope_listaSinMinisterios($query){
    $lista = $query->join('personas','miembros.ci','=','personas.ci')
                  ->whereNull('miembros.idministerio')
                  ->select(
                    'personas.ci as ci',
                    'personas.nombre as nombre',
                    'personas.apellido as apellido'
                    );
    return $lista;
  }

  public function scope_buscarSinMinisterio($query, $search){
    $lista = $this->_listaSinMinisterios()
                  ->where(function($query) use ($search){
                    return $query->where('personas.nombre','LIKE','%'.$search.'%')
                                ->orWhere('personas.apellido','LIKE','%'.$search.'%')
                                ->orWhere('personas.ci','LIKE','%'.$search.'%');
                  });
    return $lista;
  }

  public function scope_getHabilitados($query, $idencuentro){
    $habilitados = $query->join('personas as p','p.ci','=','miembros.ci')
                          ->where(DB::raw('(select nroAsistencia(miembros.ci))'),'>=',5)
                          ->where(DB::raw('(select cumplePre(miembros.ci,'.$idencuentro.'))'),'=', 1)
                          ->select('p.ci as ci', 'p.nombre as nombre', 'p.apellido as apellido');
    return $habilitados;
  }
}
