<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Collective\Html\Eloquent\FormAccessible;
use Illuminate\Support\Facades\DB;

class Bautismo extends Model
{
	use FormAccessible;
  protected $table = "bautismos";
  protected $fillable = ['id','fecha','lugar'];

  public function getDateOfBirthAttribute($value){
    return Carbon::parse($value)->format('m/d/Y');
  }

  public function formDateOfBirthAttribute($value){
    return Carbon::parse($value)->formtat('Y-m-d');
  }

  public function scope_buscarBautismo($query, $search){
  	$lista = $query->where('bautismos.id','LIKE','%'.$search.'%')
                    ->orWhere('bautismos.lugar','LIKE','%'.$search.'%');
    return $lista;
  }
}
