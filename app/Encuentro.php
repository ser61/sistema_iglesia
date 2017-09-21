<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Prerequisito;
use App\Miembro;
use App\VersionEncuentro;
use Illuminate\Support\Facades\DB;

class Encuentro extends Model
{
    //
    protected $table = "encuentros";
    protected $fillable = ['nombre'];

  public function scope_buscarEncuentro($query, $search){
  	$lista = $query->where('encuentros.id','LIKE','%'.$search.'%')
                    ->orWhere('encuentros.nombre','LIKE','%'.$search.'%');
    return $lista;
  }

  public function scope_requisitos($query, $idpre){
  	$lista = $query->where('id','<>',$idpre)
  									->select('nombre','id');
  	return $lista;
  }

  public function scope_requisitosFaltantes($query, $encuentro){
    $prerrequisitos = Prerequisito::where('idencuentro',$encuentro)
                                ->select('idprerequisito')->get();
    $encuentros = $query->whereNotIn('id',$prerrequisitos)->where('id','<>',$encuentro);
    return $encuentros;
  }

  public function scope_eliminarDependencias($query, $id){
    DB::statement('delete from prerequisitos where idencuentro = ?',[$id]);
    DB::statement('delete from versionesencuentro where idencuentro = ?',[$id]);
    return 0;
  }

  public function scope_buscarHabilitados($query,$search, $encuentro){
    $habilitados = Miembro::_getHabilitados($encuentro)
                            ->where(function($query) use ($search){
                                return $query->where('p.ci','LIKE','%'.$search.'%')
                                            ->orWhere('p.nombre','LIKE','%'.$search.'%')
                                            ->orWhere('p.apellido','LIKE','%'.$search.'%');
                            });
    return $habilitados;
  }
}
