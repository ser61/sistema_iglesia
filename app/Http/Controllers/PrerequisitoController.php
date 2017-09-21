<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;
use Redirect;
use App\Prerequisito;
use App\Encuentro;

class PrerequisitoController extends Controller
{
    public function index($encuentro){}

    public function prerequisitos($encuentro){
      $prerequisitos = Prerequisito::_getPrerequisitos($encuentro)->get();
      $encuentro = Encuentro::find($encuentro);
      return view('prerequisito.index', ['prerequisitos' => $prerequisitos, 'encuentro'=>$encuentro]);
    }

    public function create(){}

    public function agregar($encuentro){
        $encuentros = Encuentro::_requisitosFaltantes($encuentro)->get()->pluck('nombre','id');
        $encuentro = Encuentro::find($encuentro);
        return view('prerequisito.create',compact('encuentros','encuentro'));
    }

    public function store(Request $request, $encuentro)
    {
        Prerequisito::create([
            'idencuentro' => $encuentro,
            'idprerequisito' => $request['idprerequisito'],
            ]);
        Session::flash('message', 'Prerrequisito Guardado Exitosamente!!');
        return redirect()->route('prerequisito.lista',[$encuentro]);
    }

    public function show($id)
    {
        //
    }

    public function editar($encuentro, $idpre)
    {
        $prerequisito = Prerequisito::_getPrerequisito($encuentro, $idpre)->get()->first();
        $encuentros = Encuentro::_requisitosFaltantes($encuentro)->pluck('nombre','id');
        $encuentro = Encuentro::find($encuentro);
        return view('prerequisito.edit', compact('prerequisito','encuentros','encuentro'));
    }

    public function edit($id){}

    public function update(Request $request, $id)
    {
        $prerequisito = Prerequisito::find($id);
        $prerequisito->update($request->all());
        $prerequisito->save();
        Session::flash('message', 'Prerrequisito Editado Exitosamente!!');
        return redirect()->route('prerequisito.lista',[$prerequisito->idencuentro]);
    }

    public function destroy($id)
    {
        Prerequisito::destroy($id);
        Session::flash('message', 'Prerrequisito Eliminado Exitosamente!!');
        return back();
    }
}
