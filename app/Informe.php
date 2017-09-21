<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Informe extends Model
{
  protected $table = "informes";
  protected $fillable = ['ncelula','cilider','fecha','nronuevos','nrovisitas','ofrenda'];

  public function scope_getInformes($query, $id)
  {
    $informes = $query->join('personas','informes.cilider','=','personas.ci')
                      ->where('informes.ncelula','=',$id)
                      ->select(
                        'personas.ci as cilider',
                        'informes.id as id',
                        'personas.nombre as nombre',
                        'personas.apellido as apellido ',
                        'informes.fecha as fecha',
                        'informes.nronuevos as nronuevos',
                        'informes.nrovisitas as visitas',
                        'informes.ofrenda as ofrenda')->orderBy('informes.fecha','desc');
    return $informes;
  }

  public function scope_buscarInforme($query, $search, $nrocelula)
  {
    $informes = $this->_getInformes($nrocelula)
                    ->where('informes.id','LIKE','%'.$search.'%');
    return $informes;
  }
}
