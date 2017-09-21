<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ministerio;
use Session;
use Redirect;

class MinisterioController extends Controller
{
    public function index()
    {
        $ministerios = Ministerio::All();
        return view('ministerio.index',compact('ministerios'));
    }

    public function searchMinisterio(Request $request){
      if ($request->ajax()) {
        $ministerios = Ministerio::_buscarMinisterio($request['search'])->get();
        $search = $request['search'];
        $view = view('ministerio.getList', compact('ministerios', 'search'));
        return Response($view);
      }
    }

    public function ministerioPaginateSearch(Request $request){
      if ($request->ajax()) {
        $ministerios = Ministerio::_buscarMinisterio($request['search'])->get();
        $search = $request['search'];
        return view('ministerio.getList', compact('ministerios', 'search'));
      }
    }

    public function create()
    {
        return view('ministerio.create');
    }

    public function store(Request $request)
    {
        $this->validate( $request , [
          'nombre'=>'required|max:50'
        ]);

        Ministerio::create([
          'nombre'=>$request['nombre']
        ]);
        return redirect('/ministerio')->with('message','Ministerio Registrado Exitosamente!!');
    }

    public function show($id){}

    public function edit($id)
    {
        $ministerio = Ministerio::find($id);
        return view('ministerio.edit',['ministerio'=>$ministerio]);
    }

    public function update(Request $request, $id)
    {
        $this->validate( $request , [
          'nombre'=>'required|max:50'
        ]);
        //
        $ministerio = Ministerio::find($id);
        $ministerio->update($request->all());
        $ministerio->save();
        Session::flash('message','Ministerio Editado Correctamente');
        return Redirect::to('/ministerio');
    }

    public function destroy($id)
    {
      Ministerio::destroy($id);
      Session::flash('message','Bautismo Eliminado Exitosamente!!');
      return back();
    }
}
