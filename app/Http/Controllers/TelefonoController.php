<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Telefono;
use App\Persona;
use App\Miembro;

use Session;
use Redirect;

class TelefonoController extends Controller
{
    public function index($ci)
    {
        $telefonos = Telefono::where('cimiembro', '=', $ci)->get();
        $persona = Persona::where('ci', '=', $ci)->get()->first();
        return view('telefono.index')->with(compact('telefonos'))->with('persona', $persona);
    }

    public function agregarTelefono($ci, $nombre){
        $dato['ci']=$ci;
        $dato['nombre']=$nombre;
        return view('telefono.create')->with('dato',$dato);
    }

    public function store(Request $request, $ci)
    {
        $this->validate($request,[
            'numero'    => 'required|unique:telefonos,numero|digits_between:5,10',
            'descripcion' => 'required|max:50',
        ]);
        Telefono::create([
            'cimiembro' => $ci,
            'numero' => $request['numero'],
            'descripcion' => $request['descripcion'],
        ]);

        $persona = Persona::where('ci', '=', $ci)->get()->first();
        return redirect('/telefonos/'.$ci)->with('message', 'Telefono Registrado Exitosamente')->with('persona',$persona);
    }

    public function show($id)
    {
        //
    }

    public function edit($cod)
    {
        $telefono = Telefono::where('cod','=',$cod)->get()->first();
        $persona = Persona::where('ci', '=', $telefono->cimiembro)->get()->first();
        return view('telefono.edit', ['telefono'=>$telefono, 'persona'=>$persona]);
    }

    public function update(Request $request, $cod)
    {
        $this->validate($request, [
            'numero'    => 'required|digits_between:5,10',
            'descripcion' => 'required|max:50',
        ]);
        $telefono = Telefono::where('cod','=',$cod)->get()->first();
        $telefono->update($request->all());
        $telefono->save();

        $telefonos = Telefono::where('cimiembro', '=', $telefono->cimiembro)->get();
        $persona = Persona::where('ci', '=', $telefono->cimiembro)->get()->first();
        Session::flash('message', 'Telefono Editado Correctamente');
        return view('telefono.index')->with('telefonos', $telefonos)->with('persona',$persona);
    }

    public function destroy($cod)
    {
        Telefono::destroy($cod);
        Session::flash('message', 'Telefono Eliminado Correctamente');
        return back();
    }
}
