<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Reunion extends Model
{
    //
    protected $table = "reuniones";
    protected $fillable = ['nombre','dia','horadeinicio','horadefinal'];

    public  function scope_getReuniones($query){
        $reuniones = $query->select(
                                    'id as id',
                                    'nombre as nombre',
                                    'dia as dia',
                                    DB::raw('date_format(horadeinicio, "%H:%i %p") as horadeinicio'),
                                    DB::raw('date_format(horadefinal, "%H:%i %p") as horadefinal'));
        return $reuniones;
    }

    public function scope_buscarReunion($query, $search)
    {
      $reuniones = $query->where('nombre','LIKE','%'.$search.'%')
                          ->select(
                            'id as id',
                            'nombre as nombre',
                            'dia as dia',
                            DB::raw('date_format(horadeinicio, "%H:%i %p") as horadeinicio'),
                            DB::raw('date_format(horadefinal, "%H:%i %p") as horadefinal'));
      return $reuniones;
    }
}
