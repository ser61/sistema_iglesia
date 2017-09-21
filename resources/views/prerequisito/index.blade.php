@extends('layouts.admin')
@section('content')
  @include('alerts.success')
  @include('alerts.request')
  <br>
  <div class="panel panel-primary">
    <div class="panel-body">
      @include('layouts.cabezera')  

      <h1 id="cabeza">Lista de Prerequisitos del Encuentro {{$encuentro['nombre']}}</h1>

      <br>
      @if(count($prerequisitos) > 0)
        <div id="tbody">
          <table class="table table-hover">
            <tr class="info">
              <th>ID del Prerequisito</th>
              <th>Nombre Prerequisito</th>
              <th style="text-align: center;">Opciones</th>
            </tr>

            @foreach($prerequisitos as $prerequisito)
            <tr class="warning">
              <td>{{$prerequisito->idPrerequisito}}</td>
              <td>{{$prerequisito->nombrePrerequisito}}</td>
              <td align="center">
                {!!Form::model($prerequisito,['route'=> ['prerequisito.destroy',$prerequisito->id],'method'=>'DELETE'])!!}
                  <a href="{{route('prerequisito.editar',[$encuentro->id, $prerequisito->idPrerequisito]) }}" 
                    class="btn btn-warning" rel="designates">
                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i> Editar
                  </a>
                  <button class="btn btn-danger" type="submit"
                          data-toggle="confirmation" 
                          data-placement="left" 
                          data-title="¿Seguro quieres eliminar este Prerequisito?"
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
        </div>
      @else
        <br>
        <div class="panel panel-default">
          <div class="panel-body">
              <h3 style="text-align: center;">
                <b style="text-align: center;">{{$encuentro['nombre']}} no tiene prerrequisitos...</b>
              </h3>
          </div>
        </div>
      @endif
    </div>
  </div>
  <div class="form-group" align="center">
    <a href="{{route('prerequisito.agregar',[$encuentro->id]) }}" class="btn btn-primary btn-lg btn-block">
      <strong>Agregar Prerequisito</strong>
    </a>
  </div>
@endsection
