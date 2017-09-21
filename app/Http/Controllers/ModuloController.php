<?php

namespace App\Http\Controllers;

use App\Clase;
use App\Modulo;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Input;
use Session;

class ModuloController extends Controller
{
    public function index()
    {
        //
    }

    public function create($escuela)
    {
      return view('modulo.create',compact('escuela'));
    }

    public function store(Request $request, $escuela)
    {
      $this->validate( $request , [
        'fechainicio' => 'required|date',
      ]);
      Modulo::create([
        'numero' => Modulo::_getNext($escuela),
        'numeroescuela'=>$escuela,
        'fechainicio'=>$request['fechainicio'],
      ]);
      return redirect()->route('escuela.show',compact('escuela'))->with('message','Modulo Registrado Exitosamente!!');
    }

    public function show($idmodulo)
    {
      $clases = Clase::_getClases($idmodulo);
      $hayClases = Clase::where('idmodulo',$idmodulo)->get();
      $modulo = Modulo::find($idmodulo);
      return view('clase.index',compact('clases','modulo','hayClases'));
    }

    public function edit($id)
    {
      $modulo = Modulo::find($id);
      return view('modulo.edit',compact('modulo'));
    }

    public function update(Request $request, $id)
    {
      $this->validate( $request , [
        'fechainicio' => 'required|date',
      ]);
      $modulo = Modulo::find($id);
      $modulo->update($request->all());
      $modulo->save();
      $escuela = $modulo['numeroescuela'];
      return redirect()->route('escuela.show',compact('escuela'))->with('message','Modulo Actualizado Exitosamente!!');
    }

    public function destroy($id)
    {
      Modulo::destroy($id);
      Session::flash('message','La escuela ha sido Eliminada Exitosamente!!');
      return back();
    }
}
