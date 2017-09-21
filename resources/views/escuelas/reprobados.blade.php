@extends('layouts.admin')
@section('content')
  @include('alerts.success')
  @include('alerts.request')
  <br>
  <div class="panel panel-primary">
    <div class="panel-body">
      @include('layouts.cabezera')
      <br>
      @if(count($reprobados) > 0)
        <h1 id="cabeza" style="color: red">Lista de Reprobados de la Escuela: {{$reprobados->first()->escuela}}</h1>
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
              <th>Modulos Asistidos</th>
              <th>Nota Final</th>
            </tr>

            @foreach($reprobados as $reprobado)
              <tr class="warning">
                <td>{{$reprobado->ci}}</td>
                <td>{{$reprobado->nombre}}</td>
                <td>{{$reprobado->apellido}}</td>
                <td>{{$reprobado->faltas}}</td>
                <td>{{$reprobado->asistidas}}</td>
                <td>{{$reprobado->modulos}}</td>
                <td>{{$reprobado->notafinal}}</td>
              </tr>
            @endforeach
          </table>
          {{$reprobados->links()}}
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
