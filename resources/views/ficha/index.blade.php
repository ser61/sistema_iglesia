@extends('layouts.admin')
@section('content')
  @include('alerts.success')
  @include('alerts.request')
  <br>
  <div class="panel panel-primary">
    <div class="panel-body">
      @include('layouts.cabezera')

      <h1 id="cabeza">Lista de Alumonos de la Escuela: {{$escuela}}, Modulo: {{$modulo}}</h1>
      <br>
      @if((count($fichasControl)) > 0)
        <div class="panel panel-default">
          <div class="panel-body">
            <input type="text" class="form-control" placeholder="Busqueda por numero o estado de Clase..." id="search">
          </div>
        </div>
        <div id="tbody">
          <table class="table table-hover">
            <tr class="info">
              <th>CI</th>
              <th>Nombre</th>
              <th>Apellido</th>
              <th>Asistencia</th>
              <th>Notas</th>
              <th style="text-align: center">Opciones</th>
            </tr>

            @foreach($fichasControl as $fichaControl)
              <tr class="warning">
                <td>{{$fichaControl->ci}}</td>
                <td>{{$fichaControl->nombre}}</td>
                <td>{{$fichaControl->apellido}}</td>
                <td>{{$fichaControl->asistencia}}</td>
                <td>{{$fichaControl->nota}}</td>
                <td align="center">
                  {!!Form::model($fichaControl,['route'=> ['ficha.destroy',$fichaControl->id],'method'=>'DELETE'])!!}
                  <a href="{{ route('ficha.edit', $fichaControl->id) }}" class="btn btn-warning"
                     aria-label="Skip to main navigation">
                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i> Editar
                  </a>
                  <button class="btn btn-danger" type="submit"
                          data-toggle="confirmation"
                          data-placement="left"
                          data-title="¿Seguro quieres eliminar a {{$fichaControl->nombre}}?"
                          data-btnOkClass="btn btn-primary"
                          data-btnOkLabel='<i class="fa fa-check-circle"></i> Si'
                          data-btnCancelClass="btn btn-default"
                          data-btnCancelLabel='<i class="fa fa-times-circle" aria-hidden="true"></i> No'>
                    <i class="fa fa-trash-o" aria-hidden="true"></i> Eliminar
                  </button>
                  {!! Form::close() !!}
                </td>
              </tr>
            @endforeach
          </table>
          {{$fichasControl->links()}}
        </div>
      @else
        <div class="panel panel-default">
          <div class="panel-body">
            <h3 style="text-align: center;">
              <b style="text-align: center;">No existe ningun Inscripto aun...</b>
            </h3>
          </div>
        </div>
      @endif
    </div>
  </div>
  @if(count($fichasControl) < $nroInscriptos)
    <div class="form-group" align="center">
      <a href="{{ route('ficha.agregar',$idclase)}}" class="btn btn-primary btn-lg btn-block">
        <strong>Agregar Modulo</strong>
      </a>
    </div>
  @endif
@endsection
