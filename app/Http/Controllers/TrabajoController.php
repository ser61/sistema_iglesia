<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Trabajo;
use App\Persona;
use App\Miembro;

use Session;
use Redirect;

class TrabajoController extends Controller
{
    public function index($ci)
    {
        $trabajos = Trabajo::where('cimiembro', '=', $ci)->get();
        $persona = Persona::where('ci', '=', $ci)->get()->first();
        return view('trabajo.index')->with(compact('trabajos'))->with('persona', $persona);
    }

    public function create()
    {
        return view('trabajo.create');
    }

    public function agregarTrabajo($ci, $nombre){
        $dato['ci']=$ci;
        $dato['nombre']=$nombre;
        return view('trabajo.create')->with('dato',$dato);
    }

    public function store(Request $request, $ci)
    {
        $this->validate($request,[
            'nombredescripcion' => 'required|max:100',
            'direccion' => 'required|max:100',
        ]);
        Trabajo::create([
            'cimiembro' => $ci,
            'nombredescripcion' => $request['nombredescripcion'],
            'direccion' => $request['direccion'],
        ]);

        $persona = Persona::where('ci', '=', $ci)->get()->first();
        return redirect('/trabajos/'.$ci)->with('message', 'Trabajo Registrado Exitosamente')->with('persona',$persona);
    }

    public function show($id)
    {
        //
    }

    public function edit($nrodetrabajo)
    {
        $trabajo = Trabajo::where('nrodetrabajo','=',$nrodetrabajo)->get()->first();
        $persona = Persona::where('ci', '=', $trabajo->cimiembro)->get()->first();
        return view('trabajo.edit', ['trabajo'=>$trabajo, 'persona'=>$persona]);
    }

    public function update(Request $request, $nrodetrabajo)
    {
        $this->validate($request,[
            'nombredescripcion' => 'required|max:100',
            'direccion' => 'required|max:100',
        ]);

        $trabajo = Trabajo::where('nrodetrabajo','=',$nrodetrabajo)->get()->first();
        $trabajo->update($request->all());
        $trabajo->save();

        $trabajos = Trabajo::where('cimiembro', '=', $trabajo->cimiembro)->get();
        $persona = Persona::where('ci', '=', $trabajo->cimiembro)->get()->first();
        Session::flash('message', 'Trabajo Editado Correctamente');
        return view('trabajo.index')->with('trabajos', $trabajos)->with('persona',$persona);
    }

    public function destroy($nrodetrabajo)
    {
        Trabajo::destroy($nrodetrabajo);
        Session::flash('message', 'Trabajo Eliminado Correctamente');
        return back();
    }
}
