<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\PersonaUpdateRequest;
use App\Http\Requests\PersonaCreateRequest;
use App\Persona;
use Session;
use Redirect;

class PersonaController extends Controller
{
    public function listaPersonas(){
        $personas = Persona::paginate(6);
        $datos = $this->getDatos();
        return view('persona.listaPersonas',compact('personas','datos'));
    }

    public function searchPersonas(Request $request){
        if($request->ajax()){
            $personas = Persona::_buscarPersonas($request['search'])->paginate(6);
            $search = $request['search'];
            $view = view('persona.getList', compact('personas','search'));
            return Response($view);
        }
    }

    public function searchPersonasPaginate(Request $request){
        if($request->ajax()){
            $personas = Persona::_buscarPersonas($request['search'])->paginate(6);
            $search = $request['search'];
            return view('persona.getList', compact('personas','search'));
        }  
    }

    public function listaNoMiembros(){
        $noMiembros = Persona::_noMiembros()->paginate(5);
        return view('persona.listaNoMiembros',compact('noMiembros'));
    }

    public function searchNoMiembros(Request $request){
        if($request->ajax()){
            $personas = Persona::_buscarNoMiembros($request['search'])
                        ->where('tipo','=','N')->paginate(5);
            $search = $request['search'];
            $view = view('persona.getList', compact('personas','search'));
            return Response($view);
        }
    }

    public function searchNoMiembrosPaginate(Request $request){
        if($request->ajax()){
            $personas = Persona::_buscarNoMiembros($request['search'])
            ->where('tipo','=','N')->paginate(5);
            $search = $request['search'];
            return view('persona.getList', compact('personas','search'));
      }   
    }

    public function getDatos(){
        $datos['personas'] = $cantidad = count(Persona::all());

        $datos['noMiembros'] = count(Persona::_noMiembros()->get());
        $datos['hombresN'] = count(Persona::_hombres(0)->get());
        $datos['hombresMayoresN'] = count(Persona::_hombresMayores(0)->get());
        $datos['hombresJovenesN'] = count(Persona::_hombresJovenes(0)->get());
        $datos['mujeresN'] = count(Persona::_mujeres(0)->get());
        $datos['mujeresMayoresN'] = count(Persona::_mujeresMayores(0)->get());
        $datos['mujeresJovenesN'] = count(Persona::_mujeresJovenes(0)->get());


        $datos['miembros'] = count(Persona::_miembros()->get());
        $datos['hombresM'] = count(Persona::_hombres(1)->get());
        $datos['hombresJovenesM'] = count(Persona::_hombresJovenes(1)->get());
        $datos['hombresMayoresM'] = count(Persona::_hombresMayores(1)->get());
        $datos['mujeresM'] = count(Persona::_mujeres(1)->get());
        $datos['mujeresJovenesM'] = count(Persona::_mujeresJovenes(1)->get());
        $datos['mujeresMayoresM'] = count(Persona::_mujeresMayores(1)->get());
        return $datos;
    }

    public function create()
    {
        return view('persona.create');
    }

    public function store(PersonaCreateRequest $request)
    {
        if ($request['cimadre']=='' && $request['cipadre']=='') {
          \App\Persona::create([
            'ci'=>$request['ci'],
            'nombre'=>$request['nombre'],
            'apellido'=>$request['apellido'],
            'sexo'=>$request['sexo'],
            'fechadenacimiento'=>$request['fechadenacimiento'],
            'direccion'=>$request['direccion'],
            'lugardenacimiento'=>$request['lugardenacimiento'],
            'estadocivil'=>$request['estadocivil'],
            'gradoinstruccion'=>$request['gradoinstruccion'],
            'cipadre'=>null,
            'cimadre'=>null,
            'tipo'=>'N',
          ]);
        }
        else if ($request['cipadre']=='') {
          \App\Persona::create([
            'ci'=>$request['ci'],
            'nombre'=>$request['nombre'],
            'apellido'=>$request['apellido'],
            'sexo'=>$request['sexo'],
            'fechadenacimiento'=>$request['fechadenacimiento'],
            'direccion'=>$request['direccion'],
            'lugardenacimiento'=>$request['lugardenacimiento'],
            'estadocivil'=>$request['estadocivil'],
            'gradoinstruccion'=>$request['gradoinstruccion'],
            'cipadre'=>null,
            'cimadre'=>$request['cimadre'],
            'tipo'=>'N',
          ]);
        }
        else if ($request['cimadre']=='') {
          \App\Persona::create([
            'ci'=>$request['ci'],
            'nombre'=>$request['nombre'],
            'apellido'=>$request['apellido'],
            'sexo'=>$request['sexo'],
            'fechadenacimiento'=>$request['fechadenacimiento'],
            'direccion'=>$request['direccion'],
            'lugardenacimiento'=>$request['lugardenacimiento'],
            'estadocivil'=>$request['estadocivil'],
            'gradoinstruccion'=>$request['gradoinstruccion'],
            'cipadre'=>$request['cipadre'],
            'cimadre'=>null,
            'tipo'=>'N',
          ]);
        }
        else {
          \App\Persona::create([
            'ci'=>$request['ci'],
            'nombre'=>$request['nombre'],
            'apellido'=>$request['apellido'],
            'sexo'=>$request['sexo'],
            'fechadenacimiento'=>$request['fechadenacimiento'],
            'direccion'=>$request['direccion'],
            'lugardenacimiento'=>$request['lugardenacimiento'],
            'estadocivil'=>$request['estadocivil'],
            'gradoinstruccion'=>$request['gradoinstruccion'],
            'cipadre'=>$request['cipadre'],
            'cimadre'=>$request['cimadre'],
            'tipo'=>'N',
          ]);
        }
        return redirect('persona/personas')->with('message','Persona Regitrada Exitosamente');
    }

    public function edit($ci)
    {
        $persona = Persona::where('ci','=',$ci)->get()->first();
        return view('persona.edit',['persona'=>$persona]);
    }

    public function update(PersonaUpdateRequest $request,$ci)
    {
        $persona = Persona::where('ci','=',$ci)->get()->first();
        if($request['cipadre']=='' && $request['cimadre']=='')
        {
        //  return "ambos";
          $request['cipadre']=null;
          $request['cimadre'] = null;
        }
        else if($request['cipadre']=='')
        {
        //  return "padre";
          $request['cipadre'] = null;
        }
        else if($request['cimadre']=='')
        {
          //return "madre";
          $request['cimadre'] = null;
        }
        $persona->update($request->all());
        $persona->save();
        Session::flash('message','Persona Editada Correctamente');
        return Redirect::to('persona/personas');
    }

    public function destroy($ci)
    {
      Persona::_eliminar($ci);
      Session::flash('message', 'Persona Eliminada Correctamente');
      return back();
    }

    public function report($ci){
      $persona = Persona::_buscarPersona($ci)->get()->first();
      $datos = $this->traducir($persona);
      $persona['sexo'] = $datos['sexo'];
      $persona['estadocivil'] = $datos['estadocivil'];
      $persona['tipo'] = $datos['tipo'];
      $persona['cipadre'] = $datos['cipadre'];
      $persona['cimadre'] = $datos['cimadre'];
      return view('persona.report', ['persona' => $persona]);
    }

    public function traducir($persona){
      $dato = [];
      if ($persona['sexo'] == 'M') {$dato['sexo'] = "Masculino";}else{$dato['sexo'] = "Femenino";}
      if ($persona['tipo'] == 'N') {$dato['tipo'] = "No es miembro";}else{$dato['tipo'] = "Es miembro";}
      if (is_null($persona['cipadre'])) {
          $dato['cipadre'] = "Su padre no es miembro";
      }else{
        $dato['cipadre'] = $persona['cipadre'];
      }
      if (is_null($persona['cimadre'])) {
          $dato['cimadre'] = "Su madre no es miembro";
      }else{
        $dato['cimadre'] = $persona['cimadre'];
      }
      switch ($persona['estadocivil']) {
          case 'S':
              $dato['estadocivil'] = "Soltero";
              break;
          case 'C':
              $dato['estadocivil'] = "Casado";
              break;
          case 'V':
              $dato['estadocivil'] = "Viudo";
              break;
          default:
              $dato['estadocivil'] = "Divorciado";
              break;
      }
      return $dato;
    }

    public function pdf($ci, Request $dato){
      $persona = Persona::_buscarPersona($ci)->get()->first();
      $datos = $this->traducir($persona);
      $persona['sexo'] = $datos['sexo'];
      $persona['estadocivil'] = $datos['estadocivil'];
      $persona['tipo'] = $datos['tipo'];
      $persona['cipadre'] = $datos['cipadre'];
      $persona['cimadre'] = $datos['cimadre'];
      $pdf = \PDF::loadView('persona.reporte', ['persona' => $persona]);

      if ($dato['bt'] == 1) {
        return $pdf->download('Reporte_de_Persona.pdf');
      }else{
        return $pdf->stream('Reporte_de_Persona.pdf');
      }
    }

    public function generarpdf(){
        $personas = Persona::orderBy('tipo','desc')->get();
        $datos = $this->getDatos();
        $pdf = \PDF::loadView('persona.reporteGeneral', ['personas' => $personas, 'datos' => $datos]);
        return $pdf->stream('Reporte_General_de_Personas.pdf');
    }
}