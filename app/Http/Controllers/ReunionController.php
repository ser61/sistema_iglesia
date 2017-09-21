<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Redirect;
use App\Reunion;

class ReunionController extends Controller
{
    public function index()
    {
        $reuniones = Reunion::_getReuniones()->paginate(8);
        return view('reunion.index',compact('reuniones'));
    }

    public function searchReunion(Request $request){
      if ($request->ajax()) {
        $reuniones = Reunion::_buscarReunion($request['search'])->paginate(8);
        $search     = $request['search'];
        $view       = view('reunion.getList', compact('reuniones', 'search'));
        return Response($view);
      }
    }

    public function reunionPaginateSearch(Request $request){
      if ($request->ajax()) {
        $reuniones = Reunion::_buscarReunion($request['search'])->paginate(8);
        $search = $request['search'];
        return view('reunion.getList', compact('reuniones', 'search'));
      }
    }

    public function create()
    {
        return view('reunion.create');
    }

    public function store(Request $request)
    {
        $this->validate( $request , [
            'nombre' => 'required|serg_alfabeto',
            'dia'=>'required|alpha',
            'horadeinicio'=>'required|date_format:"H:i"',
            'horadefinal'=>'required|date_format:"H:i"',
        ]);
        Reunion::create([
            'nombre' => $request['nombre'],
            'dia'=>$request['dia'],
            'horadeinicio'=>$request['horadeinicio'],
            'horadefinal'=>$request['horadefinal'],
          ]);
        return redirect('/reunion')->with('message','Reunion Registrada Exitosamente!!');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $reunion = Reunion::find($id);
        return view('reunion.edit',['reunion'=>$reunion]);
    }

    public function update(Request $request, $id)
    {
        $this->validate( $request , [
            'nombre' => 'required|serg_alfabeto',
            'dia'=>'required|alpha',
            'horadeinicio'=>'required|date_format:"H:i"',
            'horadefinal'=>'required|date_format:"H:i"',
        ]);
        $reunion = Reunion::find($id);
        $reunion->update($request->all());
        $reunion->save();
        Session::flash('message','Reunion Actualizada Exitosamente!!');
        return Redirect::to('/reunion');
    }

    public function destroy($id)
    {
        Reunion::destroy($id);
        Session::flash('message', 'Reunion Eliminada Exitosamente!!');
        return back();
    }
}
