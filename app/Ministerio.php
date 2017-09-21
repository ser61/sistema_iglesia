<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ministerio extends Model
{
    //
    protected $table = "ministerios";
    protected $fillable = ['id','nombre'];

    public function scope_buscarMinisterio($query, $search){
  	$lista = $query->where('ministerios.id','LIKE','%'.$search.'%')
                    ->orWhere('ministerios.nombre','LIKE','%'.$search.'%');
    return $lista;
  }
}
