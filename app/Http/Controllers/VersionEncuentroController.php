<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Redirect;
use App\VersionEncuentro;
use App\Encuentro;
use App\Miembro;

class VersionEncuentroController extends Controller
{
    public function versiones($encuentro)
    {
        $versiones = VersionEncuentro::_getVersiones($encuentro)->paginate(8);
        $encuentro = Encuentro::find($encuentro);
        return view('version.lista', ['versiones' => $versiones, 'encuentro'=>$encuentro]);
    }

    public function searchVersiones(Request $request){
        if($request->ajax()){
            $versiones = VersionEncuentro::_buscarVersiones($request['search'], $request['encuentro'])->paginate(8);
            $search = $request['search'];
            $encuentro = Encuentro::find($request['encuentro']);
            $view = view('version.getList', compact('versiones','search','encuentro'));
            return Response($view);
        }
    }

    public function versionesPaginateSearch(Request $request){
        if($request->ajax()){
            $versiones = VersionEncuentro::_buscarVersiones($request['search'], $request['encuentro'])->paginate(8);
            $search = $request['search'];
            $encuentro = Encuentro::find($request['encuentro']);
            return view('version.getList', compact('versiones','search','encuentro'));
        }
    }

    public function asistentes($id, $encuentro){
        $asistentes = VersionEncuentro::_getAsistentes($id, $encuentro)->paginate(8);
        $encuentro = Encuentro::find($encuentro);
        return view('version.listaAsistentes', ['asistentes' => $asistentes, 'encuentro'=>$encuentro,'id'=>$id]);
    }

    public function searchAsistentes(Request $request){
        if($request->ajax()){
            $asistentes = VersionEncuentro::_buscarAsistentes($request['search'], $request['id'], $request['encuentro'])->paginate(8);
            $search = $request['search'];
            $id = $request['id'];
            $encuentro = Encuentro::find($request['encuentro']);
            $view = view('version.getListAsistentes', compact('asistentes','search','encuentro','id'));
            return Response($view);
        }
    }

    public function asistentesPaginateSearch(Request $request){
        if($request->ajax()){
            $asistentes = VersionEncuentro::_buscarAsistentes($request['search'], $request['id'], $request['encuentro'])->paginate(8);
            $search = $request['search'];
            $id = $request['id'];
            $encuentro = Encuentro::find($request['encuentro']);
            return view('version.getListAsistentes', compact('asistentes','search','encuentro','id'));
        }
    }

    public function searchHabilitados(Request $request){
        if ($request->ajax()) {
            $habilitados = Encuentro::_buscarHabilitados($request['search'], $request['encuentro'])->paginate(8);
            $search = $request['search'];
            $encuentro   = Encuentro::find($request['encuentro']);
            $view       = view('encuentro.getListHabilitados', compact('encuentro', 'search','habilitados'));
            return Response($view);
        }
    }

    public function habilitadosPaginateSearch(Request $request){
        if ($request->ajax()) {
            $habilitados = Encuentro::_buscarHabilitados($request['search'], $request['encuentro'])->paginate(8);
            $search = $request['search'];
            $encuentro   = Encuentro::find($request['encuentro']);
            return view('encuentro.getListHabilitados', compact('encuentro', 'search','habilitados'));
        }
    }

    public function index(){}

    public function create($encuentro)
    {
        $encuentro = Encuentro::find($encuentro);
        return view('version.create',compact('encuentro'));
    }

    public function store(Request $request, $encuentro)
    {
        $id     = VersionEncuentro::_siguienteVersion($encuentro);
        $id     = $id['id'] + 1;
        $this->validate( $request , [
            'cimiembro' => 'required|digits_between:4,10|exists:miembros,ci|',
            'fecha'=>'required|date',
            'lugar'=>'required|max:100',

        ]);
        $valido = VersionEncuentro::_valido( $request['cimiembro'], $encuentro);
        if ($valido['r'] == 0) {
            Session::flash('message-noexist', 'El miembro no cumple las condiciones esperadas!!');
            return back();
        }
        VersionEncuentro::create([
            'id'            => $id,
            'cimiembro'     => $request['cimiembro'],
            'idencuentro'=>$encuentro,
            'fecha'=>$request['fecha'],
            'lugar'=>$request['lugar'],
          ]);
        return redirect()->route('versiones.lista',[$encuentro])->with('message','Version Registrada Exitosamente!!');
    }

    public function agregarAsistente($id, $idencuentro){
        $version = VersionEncuentro::_getVersion($id, $idencuentro)->get()->first();
        $encuentro = Encuentro::find($idencuentro);
        $habilitados = Miembro::_getHabilitados($idencuentro)->paginate(8);
        return view('version.createAsistencia', compact('encuentro','version','habilitados'));
    }

    public function storeAsistente(Request $request, $id, $idencuentro, $fecha, $lugar){
        $this->validate( $request , [
            'cimiembro' => 'required|digits_between:4,10|exists:miembros,ci|',
        ]);
        if (count(VersionEncuentro::_getAsistente($id, $request['cimiembro'],$idencuentro)) > 0) {
            Session::flash('message-noexist', 'El miembro ya existe en esta version!!');
            return back();
        }
        $valido = VersionEncuentro::_valido( $request['cimiembro'], $idencuentro);
        if ($valido['r'] == 0) {
            Session::flash('message-noexist', 'El miembro no cumple las condiciones esperadas!!');
            return back();
        }
        VersionEncuentro::create([
            'id' => $id,
            'cimiembro' => $request['cimiembro'],
            'idencuentro'=>$idencuentro,
            'fecha'=>$fecha,
            'lugar'=>$lugar,
          ]);
        Session::flash('message', 'El miembro ha sido registrado Exitosamente!!');
        return back();
    }

    public function show($id){}

    public function edit($id, $encuentro)
    {
        $version = VersionEncuentro::_getVersion($id, $encuentro)->get()->first();
        $encuentro = Encuentro::find($encuentro);
        return view('version.edit',compact('encuentro','version'));
    }

    public function update(Request $request, $id, $encuentro)
    {
        VersionEncuentro::_actualizar($id, $encuentro, $request['fecha'], $request['lugar']);
        return redirect()->route('versiones.lista',[$encuentro])->with('message','Version '.$id.' Actualizada Exitosamente!!');
    }

    public function destroy($id, $idencuentro)
    {
        $idmax = VersionEncuentro::_siguienteVersion($idencuentro);
        if ($idmax['id'] <> $id) {
            Session::flash('message-noexist', 'No puede Eliminar esta version hasta eliminar las posteriores a esta!!');
            return back();
        }
        $eliminar = VersionEncuentro::where('id',$id)->where('idencuentro',$idencuentro)->delete();
        Session::flash('message', 'La Version ha sido eliminada Exitosamente!!');
        return back();
    }

    public function destroyAsist($id,$cimiembro,$idencuentro){
        $asistentes = VersionEncuentro::_getAsistentes($id, $idencuentro)->get();
        if (count($asistentes) < 2) {
            Session::flash('message-noexist', 'Solo queda un miembro. Regrase atras y elimine la Version!!');
            return back();
        }
        $delete = VersionEncuentro::where('id',$id)
                                ->where('cimiembro',$cimiembro)
                                ->where('idencuentro',$idencuentro)->delete();
        Session::flash('message', 'El miembro ha sido retirado Exitosamente!!');
        return back();
    }
}
