<?php

namespace App\Http\Controllers;

use App\Clase;
use App\FichaControl;
use App\Persona;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class FichaControlController extends Controller
{
    public function index(){}

    public function create($idclase)
    {
      $idmodulo = Clase::find($idclase)->idmodulo;
      $faltantes = FichaControl::_getFaltantes($idclase, $idmodulo)->get()->pluck('nombre', 'ci');
      return view('ficha.create',compact('faltantes','idclase'));
    }

    public function store(Request $request, $idclase)
    {
      $this->validate( $request , [
        'cimiembro' => 'required',
        'asistencia' => 'required',
        'nota' => 'required|numeric',
      ]);
      FichaControl::create([
        'nclase'=>$idclase,
        'cimiembro'=>$request['cimiembro'],
        'asistencia' => $request['asistencia'],
        'nota' => $request['nota'],
      ]);
      return redirect()->route('clase.show',compact('idclase'))->with('message','Ficha Registrada Exitosamente!!');
    }

    public function show($id){}

    public function edit($id)
    {
      $ficha = FichaControl::find($id);
      $nombre = Persona::find($ficha->cimiembro);
      return view('ficha.edit',compact('ficha','nombre'));
    }

    public function update(Request $request, $idficha)
    {
      $this->validate( $request , [
        'asistencia' => 'required',
        'nota' => 'required|numeric',
      ]);
      $alumno = FichaControl::find($idficha);
      $alumno->update($request->all());
      $alumno->save();
      $idclase = $alumno->nclase;
      return redirect()->route('clase.show',compact('idclase'))->with('message','Ficha Actualizada Exitosamente!!');
    }

    public function destroy($idficha)
    {
      FichaControl::destroy($idficha);
      Session::flash('message','Ficha Eliminada Exitosamente!!');
      return back();
    }
}