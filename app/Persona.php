<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Collective\Html\Eloquent\FormAccessible;
use Illuminate\Support\Facades\DB;

class Persona extends Model
{
    use FormAccessible;

    protected $table = "personas";
    protected $fillable = [ 'ci',
                            'nombre',
                            'apellido',
                            'sexo',
                            'fechadenacimiento',
                            'direccion',
                            'lugardenacimiento',
                            'estadocivil',
                            'gradoinstruccion',
                            'cipadre',
                            'cimadre',
                            'tipo'
                          ];
    protected $primaryKey = 'ci';

    public function getDateOfBirthAttribute($value)
    {
        return Carbon::parse($value)->format('m/d/Y');
    }

    public function formDateOfBirthAttribute($value)
    {
        return Carbon::parse($value)->format('Y-m-d');
    }

    public function scope_noMiembros($query){
        $lista = $query->where('tipo','=','N');
        return $lista;
    }

    public function scope_miembros($query){
        return $query->where('tipo','M');
    }

    public function scope_hombres($query, $tipo){
        if ($tipo == 1) {
            return $this->_miembros()->where('sexo','M');
        }else{
            return $this->_noMiembros()->where('sexo','M');
        }
    }

    public function scope_mujeres($query, $tipo){
        if ($tipo == 1) {
            return $this->_miembros()->where('sexo','F');
        }else{
            return $this->_noMiembros()->where('sexo','F');
        }
    }

    public function scope_hombresMayores($query, $tipo){
        return $this->_hombres($tipo)->where(DB::raw('year(now()) - year(fechadenacimiento)'), '>=', 30);
    }

    public function scope_mujeresMayores($query, $tipo){
        return $this->_mujeres($tipo)->where(DB::raw('year(now()) - year(fechadenacimiento)'), '>=', 30);
    }

    public function scope_hombresJovenes($query, $tipo){
        return $this->_hombres($tipo)->where(DB::raw('year(now()) - year(fechadenacimiento)'), '<', 30);
    }

    public function scope_mujeresJovenes($query, $tipo){
        return $this->_mujeres($tipo)->where(DB::raw('year(now()) - year(fechadenacimiento)'), '<', 30);
    }

    public function scope_buscarNoMiembros($query, $search){
        $lista = $query->where('nombre','LIKE','%'.$search.'%')
                        ->orWhere('apellido','LIKE','%'.$search.'%')
                        ->orWhere('ci','LIKE','%'.$search.'%');
        return $lista;
    }

    public function scope_buscarPersona($query, $ci){
        $persona = $query->where('ci',$ci);
        return $persona;
    }

    public function scope_buscarPersonas($query, $search){
        $personas = $query->where('nombre','LIKE','%'.$search.'%')
                        ->orWhere('apellido','LIKE','%'.$search.'%')
                        ->orWhere('ci','LIKE','%'.$search.'%');
        return $personas;
    }

    public function scope_eliminar($query, $ci){
        $affected = DB::update('update personas set cipadre = null 
                where cipadre = ?', [$ci]);
        $affecte1 = DB::update('update personas set cimadre = null 
                where cimadre = ?', [$ci]);
        $this::destroy($ci);
        return 0;
    }
}
