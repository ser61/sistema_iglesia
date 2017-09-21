<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Registro;
use App\Reunion;
use Session;
use Redirect;

class RegistroController extends Controller
{
  public function index()
  {
  }

  public function lista($idreunion)
  {
    $registros = Registro::_getRegistros($idreunion)->paginate(8);
    $reunion = Reunion::find($idreunion);
    return view('registro.index', compact('registros', 'reunion'));
  }

  public function create($idreunion)
  {
    $reunion = Reunion::find($idreunion);
    return view('registro.create', compact('reunion'));
  }

  public function store(Request $request, $idreunion)
  {
    $this->validate( $request , [
      'fecha' => 'required|date',
      'numerodeasistentes'=>'required|numeric',
      'ofrenda'=>'required|numeric|min:1|max:999999',
    ]);
    Registro::create([
      'idreunion' => $idreunion,
      'fecha' => $request['fecha'],
      'numerodeasistentes'=>$request['numerodeasistentes'],
      'ofrenda'=>$request['ofrenda'],
    ]);
    $reunion = Reunion::find($idreunion);
    return redirect()->route('registro.lista',compact('reunion'))->with('message','Registro almacenado Exitosamente!!');
  }

  public function show($id)
  {
    //
  }

  public function edit($id, $idreunion)
  {
    $registro = Registro::find($id);
    $reunion = Reunion::find($idreunion);
    return view('registro.edit',compact('registro', 'reunion'));
  }

  public function update(Request $request, $id)
  {
    $this->validate( $request , [
      'fecha' => 'required|date',
      'numerodeasistentes'=>'required|numeric',
      'ofrenda'=>'required|numeric|min:1|max:999999',
    ]);
    $registro = Registro::find($id);
    $registro->update($request->all());
    $registro->save();
    $reunion = Reunion::find($registro['idreunion']);
    return redirect()->route('registro.lista',compact('reunion'))->with('message','Registro Actualizado Exitosamente!!');
  }

  public function destroy($id)
  {
    Registro::destroy($id);
    Session::flash('message','El Registro fue Eliminado Exitosamente!!');
    return back();
  }
}