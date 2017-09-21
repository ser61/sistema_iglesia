<?php

namespace App\Http\Controllers;

use App\Asistencia;
use App\Informe;
use Illuminate\Http\Request;
use Session;
use Redirect;
use Illuminate\Support\Facades\DB;

class InformeController extends Controller
{
    public function index(){}

    public function searchInforme(Request $request){
      if ($request->ajax()) {
        $informes = Informe::_buscarInforme($request['search'], $request['nrocelula'])->paginate(8);
        $search     = $request['search'];
        $nrocelula = $request['nrocelula'];
        $view       = view('informe.getList', compact('informes', 'search','nrocelula'));
        return Response($view);
      }
    }

    public function informePaginateSearch(Request $request){
      if ($request->ajax()) {
        $informes = Informe::_buscarInforme($request['search'], $request['nrocelula'])->paginate(8);
        $search = $request['search'];
        $nrocelula = $request['nrocelula'];
        return view('informe.getList', compact('informes', 'search','nrocelula'));
      }
    }

    public function create($cilider, $nrocelula)
    {
      return view('informe.create', compact('cilider','nrocelula'));
    }

    public function store(Request $request, $nrocelula)
    {
      $this->validate( $request , [
        'cilider' => 'required|numeric|exists:miembros,ci',
        'fecha' => 'required|date',
        'nronuevos' => 'required|numeric',
        'nrovisitas' => 'required|numeric',
        'ofrenda' => 'required|numeric|min:1|max:999999'
      ]);
      Informe::create([
        'ncelula'=> $nrocelula,
        'cilider' => $request['cilider'],
        'fecha' => $request['fecha'],
        'nronuevos' => $request['nronuevos'],
        'nrovisitas' => $request['nrovisitas'],
        'ofrenda' => $request['ofrenda']
      ]);
      $cilider = $request['cilider'];
      return redirect()->route('celula.mostrar',compact('nrocelula','cilider'))->with('message','Informe Registrado Exitosamente!!');
    }

    public function show($idInforme)
    {
      $asistentes  = Asistencia::_getAsistentes($idInforme)->paginate(8);
      return view ('asistencia.index',compact('asistentes','idInforme'));
    }

    public function edit($id, $nrocelula)
    {
      $informe = Informe::find($id);
      return view('informe.edit',compact('informe','nrocelula'));
    }

    public function update(Request $request, $id,$nrocelula)
    {
      $this->validate( $request , [
        'cilider' => 'required|numeric|exists:miembros,ci',
        'fecha' => 'required|date',
        'nronuevos' => 'required|numeric',
        'nrovisitas' => 'required|numeric',
        'ofrenda' => 'required|numeric|min:1|max:999999'
      ]);
      $informe = Informe::find($id);
      $informe->update($request->all());
      $informe->save();
      $cilider = $request['cilider'];
      return redirect()->route('celula.mostrar',compact('nrocelula','cilider'))->with('message','Informe Actualizado Exitosamente!!');
    }

    public function destroy($id)
    {
        Informe::destroy($id);
      Session::flash('message','El Informe fue eliminado Exitosamente!!');
      return back();
    }
}
