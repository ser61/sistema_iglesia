@extends('layouts.admin')
@section('content')
  @include('alerts.success')
  @include('alerts.request')
  <br>
  <div class="panel panel-primary">
    <div class="panel-body">
      @include('layouts.cabezera')
      <br>
      @if(count($aprobados) > 0)
        <h1 id="cabeza">Lista de Aprobados de la Escuela: {{$aprobados->first()->escuela}}</h1>
        <br>
        <div class="panel panel-default">
          <div class="panel-body">
            <input type="text" class="form-control" placeholder="Busqueda por numero o datos del Lider de Celula..."
                   id="search">
          </div>
        </div>
        <div id="tbody">
          <table class="table table-hover">
            <tr class="info">
              <th>CI</th>
              <th>Nombre</th>
              <th>Apellido</th>
              <th>Faltas</th>
              <th>Asistidas</th>
              <th>Nota Final</th>
            </tr>

            @foreach($aprobados as $aprobado)
              <tr class="warning">
                <td>{{$aprobado->ci}}</td>
                <td>{{$aprobado->nombre}}</td>
                <td>{{$aprobado->apellido}}</td>
                <td>{{$aprobado->faltas}}</td>
                <td>{{$aprobado->asistidas}}</td>
                <td>{{$aprobado->notafinal}}</td>
              </tr>
            @endforeach
          </table>
          {{$aprobados->links()}}
        </div>
      @else
        <div class="panel panel-default">
          <div class="panel-body">
            <h3 style="text-align: center;">
              <b style="text-align: center;">No Existen Alumnos Inscriptos...</b>
            </h3>
          </div>
        </div>
      @endif
    </div>
  </div>
@endsection
