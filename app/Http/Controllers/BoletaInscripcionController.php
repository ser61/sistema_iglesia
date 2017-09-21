<?php

namespace App\Http\Controllers;

use App\BoletaInscripcion;
use App\EscuelaDeLideres;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class BoletaInscripcionController extends Controller
{
    public function index()
    {
        //
    }

    public function create()
    {
      return view('boleta.create');
    }

    public function store(Request $request)
    {
      $this->validate( $request , [
        'numero' => 'required|numeric|exists:escuelasdelideres,numero',
        'cimiembro' => 'required|numeric|exists:miembros,ci',
      ]);
      $existeModulo = EscuelaDeLideres::_existeMod($request['numero'],$request['numeromodulo'])->get()->first();
      if( count($existeModulo) < 1){
        Session::flash('message-noexist','El Modulo No ha sido Abierto Aun o Es Invalido!!!');
        return back();
      }
      BoletaInscripcion::create([
        'numeromodulo' => $existeModulo['id'],
        'cimiembro'=>$request['cimiembro'],
        'fecha'=> Carbon::now(),
      ]);
      Session::flash('message','Miembro Registrado Exitosamente!!!');
      return back();
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
