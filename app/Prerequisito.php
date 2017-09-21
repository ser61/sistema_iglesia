<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Prerequisito extends Model
{
    //
    protected $table = "prerequisitos";
    protected $fillable = ['id','idencuentro','idprerequisito'];

  public function scope_getPrerequisitos($query, $encuentro){
  	$lista = $query->join('encuentros as e', 'e.id', '=', 'prerequisitos.idprerequisito')
									->where('prerequisitos.idencuentro',$encuentro)
									->select(
										'prerequisitos.id as id',
										'prerequisitos.idprerequisito as idPrerequisito',
										'e.nombre as nombrePrerequisito'
										);
		return $lista;
  }				

  public function scope_getPrerequisito($query, $encuentro, $idpre){
  	$prerequisito = $query->where('idencuentro',$encuentro)
  												->where('idprerequisito',$idpre);
  	return $prerequisito;
  }

}
