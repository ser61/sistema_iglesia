<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Miembro;
use App\Persona;
use App\Ministerio;
use App\Bautismo;
use Illuminate\Support\Facades\DB;
use Session;
use Redirect;


class MiembroController extends Controller
{
    public function index()
    {
      $miembros = Miembro::_miembros()->paginate(8);
      return view('miembro.listaMiembros', ['miembros' => $miembros]);
    }

    public function searchMiembros(Request $request){
      if ($request->ajax()) {
        $miembros = Miembro::_buscarMiembros($request['search'])->paginate(8);
        $search = $request['search'];
        $view = view('miembro.getList', compact('miembros', 'search'));
        return Response($view);
      }
    }

    public function miembrosPaginateSearch(Request $request){
      if ($request->ajax()) {
        $miembros = Miembro::_buscarMiembros($request['search'])->paginate(8);
        $search = $request['search'];
        return view('miembro.getList', compact('miembros', 'search'));
      }
    }

    public function bautizados()
    {
      $bautizados = Miembro::_listaBautizados()->orderBy('apellido')->paginate(10);
      return view ('miembro.bautizados',['bautizados'=>$bautizados]);
    }

    public function searchBautizados(Request $request){
      if ($request->ajax()) {
        $bautizados = Miembro::_buscarBautizados($request['search'])->orderBy('apellido')->paginate(10);
        $search = $request['search'];
        $view = view('miembro.getListBautizados', compact('bautizados', 'search'));
        return Response($view);
      }
    }

    public function bautizadosPaginateSearch(Request $request){
      if ($request->ajax()) {
        $bautizados = Miembro::_buscarBautizados($request['search'])->orderBy('apellido')->paginate(10);
        $search = $request['search'];
        return view('miembro.getListBautizados', compact('bautizados', 'search'));
      }
    }

    public function noBautizados()
    {
      $noBautizados = Miembro::_listaNoBautizados()->paginate(8);
      return view ('miembro.noBautizados',['noBautizados'=>$noBautizados]);
    }

    public function searchNoBautizados(Request $request){
      if ($request->ajax()) {
        $noBautizados = Miembro::_buscarNoBautizados($request['search'])->paginate(8);
        $search = $request['search'];
        $view = view('miembro.getListNoBautizados', compact('noBautizados', 'search'));
        return Response($view);
      }
    }

    public function noBautizadosPaginateSearch(Request $request){
      if ($request->ajax()) {
        $noBautizados = Miembro::_buscarNoBautizados($request['search'])->paginate(8);
        $search = $request['search'];
        return view('miembro.getListNoBautizados', compact('noBautizados', 'search'));
      }
    }

    public function conMinisterio()
    {
      $conMinisterios = Miembro::_listaConMinisterios()->orderBy('nombre')->paginate(10);
      return view ('miembro.conMinisterio',['conMinisterios'=>$conMinisterios]);
    }

    public function searchConMinisterio(Request $request){
      if ($request->ajax()) {
        $conMinisterios = Miembro::_buscarConMinisterio($request['search'])->paginate(10);
        $search = $request['search'];
        $view = view('miembro.getListConMinisterio', compact('conMinisterios', 'search'));
        return Response($view);
      }
    }

    public function conMinisterioPaginateSearch(Request $request){
      if ($request->ajax()) {
        $conMinisterios = Miembro::_buscarConMinisterio($request['search'])->paginate(10);
        $search = $request['search'];
        return view('miembro.getListConMinisterio', compact('conMinisterios', 'search'));
      }
    }

    public function sinMinisterio()
    {
        $sinMinisterios = Miembro::_listaSinMinisterios()->paginate(8);
          return view ('miembro.sinMinisterio',['sinMinisterios'=>$sinMinisterios]);
    }

    public function searchSinMinisterio(Request $request){
      if ($request->ajax()) {
        $sinMinisterios = Miembro::_buscarSinMinisterio($request['search'])->paginate(8);
        $search = $request['search'];
        $view = view('miembro.getListSinMinisterio', compact('sinMinisterios', 'search'));
        return Response($view);
      }
    }

    public function sinMinisterioPaginateSearch(Request $request){
      if ($request->ajax()) {
        $sinMinisterios = Miembro::_buscarSinMinisterio($request['search'])->paginate(8);
        $search = $request['search'];
        return view('miembro.getListSinMinisterio', compact('sinMinisterios', 'search'));
      }
    }

    public function create()
    {
        return view('miembro.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
          'ci' => 'required|digits_between:4,10|exists:Personas,ci|unique:miembros,ci',
          'fechadeconversion' => 'required|date',
          'idministerio' => 'exists:ministerios,id',
          'idbautismo' => 'exists:bautismos,id',
        ]);

        if ($request['idministerio'] == '' && $request['idbautismo'] == '') {
          Miembro::create([
            'ci' => $request['ci'],
            'fechadeconversion' => $request['fechadeconversion'],
            'idministerio' => null,
            'idbautismo' => null
          ]);
        }elseif ($request['idministerio'] == '') {
          Miembro::create([
            'ci' => $request['ci'],
            'fechadeconversion' => $request['fechadeconversion'],
            'idministerio' => null,
            'idbautismo' => $request['idbautismo']
          ]);
        }elseif ($request['idbautismo'] == '') {
          Miembro::create([
            'ci' => $request['ci'],
            'fechadeconversion' => $request['fechadeconversion'],
            'idministerio' => $request['idministerio'],
            'idbautismo' => null
          ]);
        }else{
          Miembro::create([
            'ci' => $request['ci'],
            'fechadeconversion' => $request['fechadeconversion'],
            'idministerio' => $request['idministerio'],
            'idbautismo' => $request['idbautismo']
          ]);
        }
        return redirect('/miembro')->with('message', 'Miembro Registrado Exitosamente');
    }

    public function show(){

    }

    public function edit($ci)
    {
        $miembro = Miembro::where('ci', '=', $ci)->get()->first();
        $persona = Persona::where('ci', '=', $ci)->get()->first();
        return view('miembro.edit', ['miembro' => $miembro,'persona' => $persona]);
    }

    public function update(Request $request, $ci)
    {
        $this->validate( $request, [
          'ci'=>'required|numeric|min:5',
          'fechadeconversion' => 'required|date',
        ]);

        $miembro = Miembro::where('ci', '=', $ci)->get()->first();
        if ($request['idministerio'] == '' && $request['idbautismo'] == '') {
          $request['idministerio'] = null;
          $request['idbautismo'] = null;
        }elseif ($request['idministerio'] == '') {
          $request['idministerio'] = null;
        }elseif ($request['idbautismo'] == '') {
          $request['idbautismo'] = null;
        }
        $miembro->update($request->all());
        $miembro->save();
        Session::flash('message', 'Miembro Editado Correctamente');
        return Redirect::to('/miembro');
    }

    public function destroy($ci)
    {
        Miembro::destroy($ci);
        Session::flash('message', 'Miembro Eliminado Correctamente');
        return back();
    }
}
