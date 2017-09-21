<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Prerequisito;
use App\Asistencia;

class VersionEncuentro extends Model
{
    //
    protected $table = "versionesencuentro";
    protected $fillable = ['id','cimiembro','idencuentro','fecha','lugar'];

    public function scope_getVersiones($query, $encuentro){
    	$lista = $query->where('idencuentro',$encuentro)
    									->select(
    										'id as version',
    										'fecha as fecha',
    										'lugar as lugar'
    										)->groupBy('id');
    	return $lista;
    }

    public function scope_buscarVersiones($query, $search, $idencuentro){
        $versiones = $query->where('idencuentro',$idencuentro)
                            ->where(function($query) use ($search){
                                    return $query->where('id','LIKE','%'.$search.'%')
                                                ->orWhere('fecha','LIKE','%'.$search.'%')
                                                ->orWhere('lugar','LIKE','%'.$search.'%');
                                    })
                            ->select('id as version','fecha as fecha','lugar as lugar')
                            ->orderBy('id');
        return $versiones;
    }

    public function scope_siguienteVersion($query, $version){
        $siguiente = $query->select(DB::raw('max(id) as id'))
                            ->where('idencuentro',$version)
                            ->get()->first();
        return $siguiente;
    }

    public function scope_actualizar($query, $id, $encuentro, $fecha, $lugar){
        $this->where('id',$id)->where('idencuentro',$encuentro)
            ->update(['fecha'=>$fecha, 'lugar'=>$lugar]);
        return 0;
    }

    public function scope_getVersion($query, $id, $encuentro){
        $version = $this->where('id',$id)->where('idencuentro',$encuentro);

        return $version;
    }

    public function scope_getAsistentes($query, $id, $encuentro){
        $asistentes = $query->join('miembros','miembros.ci','=','versionesencuentro.cimiembro')
                            ->join('personas','personas.ci','=','miembros.ci')
                            ->where('versionesencuentro.id',$id)
                            ->where('versionesencuentro.idencuentro',$encuentro)
                            ->select(
                                'personas.ci as ci',
                                'personas.nombre as nombre',
                                'personas.apellido as apellido'
                                )->distinct();
        return $asistentes;
    }

    public function scope_buscarAsistentes($query, $search, $id, $encuentro){
        $asistentes = $this->_getAsistentes($id, $encuentro)
                            ->where(function($query) use ($search){
                                    return $query->where('personas.ci','LIKE','%'.$search.'%')
                                                ->orWhere('personas.nombre','LIKE','%'.$search.'%')
                                                ->orWhere('personas.apellido','LIKE','%'.$search.'%');
                                    });
        return $asistentes;
    }

    public function scope_getAsistente($query, $id, $cimiembro, $encuentro){
        return $query->where('id',$id)->where('cimiembro',$cimiembro)->where('idencuentro',$encuentro)->get();
    }

    public function scope_cumpleRequisitos($query, $cimiembro, $idencuentro){
        $prerequisitos = Prerequisito::_getPrerequisitos($idencuentro)->get();
        $nroPrerequisitosAsistidos = $query->where('id',1)
                                            ->where('cimiembro',$cimiembro)
                                            ->whereIn('idencuentro', $prerequisitos->pluck('idPrerequisito'))
                                            ->get();
        if (count($prerequisitos) == count($nroPrerequisitosAsistidos)) {
            $verdadero['r'] = 1;
            return $verdadero;
        }else{
            $verdadero['r'] = 0;
            return $verdadero;
        }
    }

    public function scope_valido($query, $cimiembro, $idencuentro){
        $asistencia = Asistencia::_cumpleAsistencia($cimiembro);
        $cumpleRequi = $this->_cumpleRequisitos($cimiembro, $idencuentro);
        if ( ($asistencia->asistencia >= 5) and ($cumpleRequi['r'] == 1)) {
            $cumple['r'] = 1;
            return $cumple;
        }else{
            $cumple['r'] = 0;
            return $cumple;
        }
    }
}
