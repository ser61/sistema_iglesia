<?php

namespace App\Http\Controllers;

use App\Informe;
use App\Persona;
use Illuminate\Http\Request;
use App\Celula;
use Session;
use Redirect;
use Illuminate\Support\Facades\DB;

class CelulaController extends Controller
{
    public function index()
    {
      $celulas = Celula::_getCel()->paginate(8);
      return view('celula.index',compact('celulas'));
    }

    public function searchCelula(Request $request){
        if ($request->ajax()) {
            $celulas = Celula::_buscarCelula($request['search'])->paginate(8);
            $search     = $request['search'];
            $view       = view('celula.getList', compact('celulas', 'search'));
            return Response($view);
        }
    }

    public function celulaPaginateSearch(Request $request){
        if ($request->ajax()) {
            $celulas = Celula::_buscarCelula($request['search'])->paginate(8);
            $search = $request['search'];
            return view('celula.getList', compact('celulas', 'search'));
        }
    }

    public function create()
    {
        return view('celula.create');
    }

    public function store(Request $request)
    {
        $this->validate( $request , [
            'numero' => 'required|numeric|unique:celulas,numero',
            'fechadecreacion'=>'required|date',
        ]);
        Celula::create([
            'numero' => $request['numero'],
            'fechadecreacion'=>$request['fechadecreacion'],
          ]);
        return redirect('/celula')->with('message','Celula Registrada Exitosamente!!');
    }

    public function show($nrocelula, $cilider)
    {
        $informes = Informe::_getInformes($nrocelula)->paginate(8);
        $lider['ci'] = $cilider;
        if($cilider <> 0){
            $lider = Persona::find($cilider);
        }
        return view ('informe.index',compact('informes','nrocelula','lider'));
    }

    public function edit($numero)
    {
        $celula = Celula::find($numero);
        return view('celula.edit',compact('celula'));
    }

    public function update(Request $request, $numero)
    {
        $this->validate($request, [
            'numero' => 'required|numeric|unique:celulas,numero',
            'fechadecreacion'=>'required|date',
        ]);
        $celula = Celula::find($numero);
        $celula->update($request->all());
        $celula->save();
        Session::flash('message','Celula Editada Exitosamente!!');
        return Redirect::to('/celula');
    }

    public function destroy($id)
    {
      Celula::destroy($id);
      Session::flash('message', 'Celula Eliminada Exitosamente!!');
      return back();
    }
}
