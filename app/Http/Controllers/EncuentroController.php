<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Encuentro;
use App\Miembro;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use Session;
use Redirect;


class EncuentroController extends Controller
{
    public function index()
    {
        $encuentros = Encuentro::paginate(5);
        return view('encuentro.index', compact('encuentros'));
    }

    public function habilitados($idencuentro){
        $encuentro   = Encuentro::find($idencuentro);
        $habilitados = Miembro::_getHabilitados($idencuentro)->paginate(8);
        return view('encuentro.habilitados', compact('encuentro','habilitados'));
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

    public function searchEncuentro(Request $request){
      if ($request->ajax()) {
        $encuentros = Encuentro::_buscarEncuentro($request['search'])->paginate(5);
        $search     = $request['search'];
        $view       = view('encuentro.getList', compact('encuentros', 'search'));
        return Response($view);
      }
    }

    public function encuentroPaginateSearch(Request $request){
      if ($request->ajax()) {
        $encuentros = Encuentro::_buscarEncuentro($request['search'])->paginate(5);
        $search = $request['search'];
        return view('encuentro.getList', compact('encuentros', 'search'));
      }
    }

    public function create()
    {
        return view('encuentro.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
          'nombre' => 'required|min:5'
        ]);
        Encuentro::create([
          'nombre' =>$request['nombre']
        ]);
        return redirect('/encuentro')->with('message', 'Encuentro Registrado Exitosamente');
    }

    public function show($id)
    {
      $versiones  = DB::table('versionesencuentro')
        ->join('encuentros','encuentros.id','=','versionesencuentro.idencuentro')
        ->where('versionesencuentro.id','=',$id)
        ->distinct()
        ->select('versionesencuentro.id as id','encuentros.nombre as nombre ', 'versionesencuentro.fecha as fecha','versionesencuentro.lugar as lugar')
        //->distinct()
        ->get();
        return view ('encuentro.show',['versiones'=>$versiones]);
    }

    public function edit($id)
    {
        $encuentro = Encuentro::find($id);
        return view('encuentro.edit',['encuentro' => $encuentro]);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'nombre' => 'required|min:5',
        ]);
        $encuentro = Encuentro::find($id);
        $encuentro->update($request->all());
        $encuentro->save();
        Session::flash('message', 'Encuentro Editado Exitosamente!!');
        return Redirect::to('/encuentro');
    }

    public function destroy($id)
    {
      Encuentro::_eliminarDependencias($id);
      Encuentro::destroy($id);  
      Session::flash('message','Encuentro Eliminado Exitosamente!!');
      return back();
    }
}
