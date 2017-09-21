<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\BautismoCreateRequest;
use App\Http\Requests\BautismoUpdateRequest;
use App\Bautismo;
use Session;
use Redirect;

class BautismoController extends Controller
{
    public function index()
    {
        $bautismos = Bautismo::paginate(6);
        return view('bautismo.index',compact('bautismos'));
    }

    public function searchBautismo(Request $request){
      if ($request->ajax()) {
        $bautismos = Bautismo::_buscarBautismo($request['search'])->paginate(5);
        $search = $request['search'];
        $view = view('bautismo.getList', compact('bautismos', 'search'));
        return Response($view);
      }
    }

    public function bautismoPaginateSearch(Request $request){
      if ($request->ajax()) {
        $bautismos = Bautismo::_buscarBautismo($request['search'])->paginate(5);
        $search = $request['search'];
        return view('bautismo.getList', compact('bautismos', 'search'));
      }
    }

    public function create()
    {
        return view('bautismo.create');
    }

    public function store(BautismoCreateRequest $request)
    {
        Bautismo::create([
            'fecha'=>$request['fecha'],
            'lugar'=>$request['lugar']
          ]);
        return redirect('/bautismo')->with('message','Bautismo Registrado Exitosamente');
    }

    public function show($id){}

    public function edit($id)
    {
        $bautismo = Bautismo::find($id);
        return view('bautismo.edit',['bautismo'=>$bautismo]);
    }

    public function update(BautismoCreateRequest $request, $id)
    {
        $bautismo = Bautismo::find($id);
        $bautismo->update($request->all());
        $bautismo->save();
        Session::flash('message','Bautismo Editado Correctamente');
        return Redirect::to('/bautismo');
    }

    public function destroy($id)
    {
      Bautismo::destroy($id);
      Session::flash('message','Bautismo Eliminado Exitosamente!!');
      return back();
    }
}
