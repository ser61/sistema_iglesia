<?php

namespace App\Http\Controllers;

use App\BoletaInscripcion;
use App\Clase;
use App\FichaControl;
use App\Modulo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ClaseController extends Controller
{
    public function index()
    {
    }

    public function create($idmodulo)
    {
      $modulo = Modulo::find($idmodulo);
      return view('clase.create',compact('modulo'));
    }

    public function store(Request $request, $idmodulo)
    {
      $this->validate( $request , [
        'fecha' => 'required|date',
      ]);
      Clase::create([
        'idmodulo'=>$idmodulo,
        'fecha'=>$request['fecha'],
      ]);
      return redirect()->route('modulo.show',compact('idmodulo'))->with('message','Clase Registrada Exitosamente!!');
    }

    public function show($idclase)
    {
      $fichasControl = FichaControl::_getFichas($idclase)->paginate(8);
      $idmodulo = Clase::find($idclase)->idmodulo;
      $modulo = Modulo::find($idmodulo)->numero;
      $escuela = Modulo::find($idmodulo)->numeroescuela;
      $nroInscriptos = BoletaInscripcion::_getCantInscriptos($idmodulo)->cant;
      return view('ficha.index',compact('fichasControl','modulo','escuela','idclase','nroInscriptos'));
    }

    public function edit($id)
    {
      $clase = Clase::find($id);
      return view('clase.edit',compact('clase'));
    }

    public function update(Request $request, $id)
    {
      $this->validate( $request , [
        'fecha' => 'required|date',
      ]);
      $clase = Clase::find($id);
      $clase->update($request->all());
      $clase->save();
      $idmodulo = $clase->idmodulo;
      return redirect()->route('modulo.show',compact('idmodulo'))->with('message','Clase Actualizada Exitosamente!!');
    }

    public function destroy($id)
    {
      Clase::destroy($id);
      Session::flash('message','La clase fue Eliminada Exitosamente!!');
      return back();
    }
}
