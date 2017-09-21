<?php

namespace App\Http\Controllers;

use App\Asistencia;
use App\Miembro;
use Illuminate\Http\Request;
use Session;
use Redirect;

class AsisteciaController extends Controller
{
    public function index(){}

    public function searchAsistencia(Request $request){
      if ($request->ajax()) {
        $asistentes = Asistencia::_buscarAsistentes($request['search'], $request['idinforme'])->paginate(8);
        $search     = $request['search'];
        $view       = view('asistencia.getList', compact('asistentes', 'search'));
        return Response($view);
      }
    }

    public function asistenciaPaginateSearch(Request $request){
      if ($request->ajax()) {
        $asistentes = Asistencia::_buscarAsistentes($request['search'], $request['idinforme'])->paginate(8);
        $search = $request['search'];
        return view('asistencia.getList', compact('asistentes', 'search'));
      }
    }

    public function create($idInforme)
    {
        $miembros = Miembro::_miembrosNotAsist($idInforme)->paginate(8);
        return view('asistencia.create', compact('idInforme','miembros'));
    }

    public function searchMiembros(Request $request){
      if ($request->ajax()) {
        $miembros = Miembro::_buscarMiembrosNotAsist($request['search'], $request['idinforme'])->paginate(8);
        $search     = $request['search'];
        $view       = view('asistencia.getListMiembros', compact('miembros', 'search'));
        return Response($view);
      }
    }

    public function miembrosPaginateSearch(Request $request){
      if ($request->ajax()) {
        $miembros = Miembro::_buscarMiembrosNotAsist($request['search'], $request['idinforme'])->paginate(8);
        $search = $request['search'];
        return view('asistencia.getListMiembros', compact('miembros', 'search'));
      }
    }

    public function store(Request $request, $idInforme)
    {
        if((Asistencia::_existAsistente($request['cimiembro'], $idInforme)) == 1){
            Session::flash('message-noexist', 'El miembro Ya Existe, pruebe con otro!!');
            return back();
        }
        $this->validate( $request , [
            'cimiembro' => 'required|numeric|exists:miembros,ci',
        ]);
        Asistencia::create([
            'cimiembro'=> $request['cimiembro'],
            'idinforme' => $idInforme
        ]);
        Session::flash('message', 'El miembro ha sido Rregistrado Exitosamente!!');
        return back();
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $asistente = Asistencia::find($id);
        $miembros = Miembro::_miembrosNotAsist($asistente['idinforme'])->paginate(8);
        return view('asistencia.edit',compact('asistente','miembros'));
    }

    public function update(Request $request, $id)
    {
        $asistente = Asistencia::find($id);
        if((Asistencia::_existAsistente($request['cimiembro'], $asistente['idinforme'])) == 1){
            Session::flash('message-noexist', 'El miembro Ya Existe, pruebe con otro!!');
            return back();
        }
        $this->validate( $request , [
          'cimiembro' => 'required|numeric|exists:miembros,ci',
        ]);
        $asistente->update($request->all());
        $asistente->save();
        return redirect()->route('informe.show',$asistente['idinforme'])->with('message','Asistente Actualizado Exitosamente!!');
    }

    public function destroy($id)
    {
        $asistecia = Asistencia::destroy($id);
        Session::flash('message','El Miembros a sido Retirado de la Asistencia Exitosamente');
        return back();
    }
}
