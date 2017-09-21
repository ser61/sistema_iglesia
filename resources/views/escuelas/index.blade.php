@extends('layouts.admin')
@section('content')
  @include('alerts.success')
  @include('alerts.request')
  <br>
  <div class="panel panel-primary">
    <div class="panel-body">
      @include('layouts.cabezera')

      <h1 id="cabeza">Lista de Escuelas de Lideres</h1>

      <br>

      <div class="panel panel-default">
        <div class="panel-body">
          <input type="text" class="form-control" placeholder="Busqueda por numero o datos del Lider de Celula..." id="search">
        </div>
      </div>
      <div id="tbody">
        <table class="table table-hover">
          <tr class="info">
            <th>Nro Escuela</th>
            <th>CI - Lider</th>
            <th>Nombre - Lider</th>
            <th>Apellido - Lider</th>
            <th style="text-align: center">Opciones</th>
          </tr>

          @foreach($escuelas as $escuela)
            <tr class="warning">
              <td style="text-align: center">{{$escuela->numero}}</td>
              <td>{{$escuela->ci}}</td>
              <td>{{$escuela->nombre}}</td>
              <td>{{$escuela->apellido}}</td>
              <td align="center">
                {!!Form::model($escuela,['route'=> ['escuela.destroy',$escuela->numero],'method'=>'DELETE'])!!}
                <a href="{{ route('escuela.edit', $escuela->numero) }}" class="btn btn-warning"
                   aria-label="Skip to main navigation">
                  <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                </a>
                <button class="btn btn-danger" type="submit"
                        data-toggle="confirmation"
                        data-placement="left"
                        data-title="SI ELIMINA LA ESCUELA {{$escuela->numero}} ELIMINARA TAMBIEN TODOS LOS DATOS DE LA MISMA!!!"
                        data-btnOkClass="btn btn-primary"
                        data-btnOkLabel='<i class="fa fa-check-circle"></i> Si'
                        data-btnCancelClass="btn btn-default"
                        data-btnCancelLabel='<i class="fa fa-times-circle" aria-hidden="true"></i> No'>
                  <i class="fa fa-trash-o" aria-hidden="true"></i>
                </button>
                <a href="{{ route('escuela.show', $escuela->numero) }}" class="btn btn-success"
                   aria-label="Skip to main navigation">
                  <i class="fa fa-eye" aria-hidden="true"></i> Modulos
                </a>
                <a href="{{ route('escuela.aprobados',$escuela->numero) }}" class="btn btn-primary"
                   aria-label="Skip to main navigation">
                  <i class="fa fa-eye" aria-hidden="true"></i> Aprobados
                </a>
                <a href="{{ route('escuela.reprobados',$escuela->numero) }}" class="btn btn-info"
                   aria-label="Skip to main navigation">
                  <i class="fa fa-eye" aria-hidden="true"></i> Reprobados
                </a>
                {!! Form::close() !!}
              </td>
            </tr>
          @endforeach
        </table>
        {{$escuelas->links()}}
      </div>
    </div>
  </div>
@endsection
