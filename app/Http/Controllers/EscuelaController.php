<?php

namespace App\Http\Controllers;

use App\EscuelaDeLideres;
use App\Modulo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class EscuelaController extends Controller
{
    public function index()
    {
      $escuelas = EscuelaDeLideres::_getEscuelas()->paginate(8);
      return view('escuelas.index',compact('escuelas'));
    }

    public function aprobados($escuela)
    {
      $aprobados = EscuelaDeLideres::_getAprobados($escuela)->paginate(8);
      return view('escuelas.aprobados', compact('aprobados'));
    }

    public function reprobados($escuela)
    {
      $reprobados = EscuelaDeLideres::_getReprobados($escuela)->paginate(8);
      return view('escuelas.reprobados', compact('reprobados'));
    }

    public function create()
    {
      return view('escuelas.create');
    }

    public function store(Request $request)
    {
      $this->validate( $request , [
        'numero' => 'required|numeric|unique:escuelasdelideres,numero',
        'cimiembro'=>'required|numeric|exists:informes,cilider',
      ]);
      EscuelaDeLideres::create([
        'numero' => $request['numero'],
        'cimiembro'=>$request['cimiembro'],
      ]);
      return redirect('escuela/')->with('message','Escuela Registrada Exitosamente!!');
    }

    public function show($numero)
    {
      $modulos = Modulo::where('numeroescuela',$numero)->orderBy('numero','asc')->get();
      return view('modulo.index',compact('modulos','numero'));
    }

    public function edit($numero)
    {
      $escuela = EscuelaDeLideres::find($numero);
      return view('escuelas.edit',compact('escuela'));
    }

    public function update(Request $request, $numero)
    {
      $this->validate( $request , [
        'numero' => 'required|numeric|unique:escuelasdelideres,numero',
        'cimiembro'=>'required|numeric|exists:informes,cilider',
      ]);
      $escuela = EscuelaDeLideres::find($numero);
      $escuela->update($request->all());
      $escuela->save();
      Session::flash('message','La escuela ha sido Actualizada Exitosamente!!');
      return Redirect::to('escuela/');
    }

    public function destroy($numero)
    {
      EscuelaDeLideres::destroy($numero);
      Session::flash('message','La escuela ha sido Eliminada Exitosamente!!');
      return Redirect::to('escuela/');
    }
}
