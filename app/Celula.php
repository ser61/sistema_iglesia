<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Celula extends Model
{
    //
    protected $table = "celulas";
    protected $fillable = ['numero','fechadecreacion'];
    protected $primaryKey = 'numero';

  public function scope_getCelulas($query){
    $celulas = $query ->join('informes as i', 'i.ncelula','=','celulas.numero')
                      ->join('miembros as m', 'm.ci'     ,'=','i.cilider')
                      ->join('personas as p', 'p.ci','=','m.ci')
                    ->select(
                      'numero',
                      'fechadecreacion',
                      'p.ci as ci',
                      'p.nombre as nombre',
                      'p.apellido as apellido',
                      DB::raw('count(numero) as informenes')
                    )->groupBy('numero');
    return $celulas;
  }

  public function scope_getCel($query){
    $celulas = $query->select(
                        'celulas.numero',
                        'fechadecreacion',
                        DB::raw('(select datosLider(numero, 1)) as ci'),
                        DB::raw('(select datosLider(numero, 2)) as nombre'),
                        DB::raw('(select datosLider(numero, 3)) as apellido'),
                        DB::raw('(select countInformes(numero)) as informenes')
                      );
    return $celulas;
  }

  public function scope_buscarCelula($query, $search)
  {
    $celula = $this->_getCel()
                  ->where(function($query) use ($search){
                    return $query->where('celulas.numero','LIKE','%'.$search.'%')
                                  ->orWhere(DB::raw('(select datosLider(celulas.numero, 1))'),'LIKE','%'.$search.'%')
                                  ->orWhere(DB::raw('(select datosLider(celulas.numero, 2))'),'LIKE','%'.$search.'%')
                                  ->orWhere(DB::raw('(select datosLider(celulas.numero, 3))'),'LIKE','%'.$search.'%');
                  });
    return $celula;
  }
}
