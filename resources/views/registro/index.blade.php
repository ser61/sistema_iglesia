@extends('layouts.admin')
@section('content')
  @include('alerts.success')
  @include('alerts.request')
  <br>
  <div class="panel panel-primary">
    <div class="panel-body">
      @include('layouts.cabezera')
      <br>

      <h1 id="cabeza">Registros de la Reunion {{$reunion->nombre}}</h1>
      <br>
      @if(count($registros) > 0)
        <div id="tbody">
          <table class="table table-hover">
            <tr class="info">
              <th>Id de Registro</th>
              <th>Fecha</th>
              <th>Nro de Asistentes</th>
              <th>Ofrenda</th>
              <th style="text-align: center">Opciones</th>
            </tr>

            @foreach($registros as $registro)
              <tr class="warning" metho>
                <td>{{$registro->id}}</td>
                <td><?php echo Carbon\Carbon::createFromFormat('Y-m-d', $registro->fecha)->format('d M Y') ?></td>
                <td>{{$registro->numerodeasistentes}}</td>
                <td>{{$registro->ofrenda}}</td>
                <td align="center">
                  {!!Form::model($registro,['route'=> ['registro.destroy',$registro->id],'method'=>'DELETE'])!!}
                  <a href="{{ route('registro.editar', [$registro->id, $reunion->id]) }}" class="btn btn-primary"
                     aria-label="Skip to main navigation">
                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i> Editar
                  </a>
                  <button class="btn btn-danger" type="submit"
                          data-toggle="confirmation"
                          data-placement="left"
                          data-title='¿Seguro quieres elimiar este Registro?'
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
          {{$registros->links()}}
        </div>
      @else
        <br>
        <div class="panel panel-default">
          <div class="panel-body">
            <h3 style="text-align: center;">
              <b style="text-align: center;">{{$reunion['nombre']}} no tiene ningun registro...</b>
            </h3>
          </div>
        </div>
      @endif
    </div>
  </div>
  <div class="form-group" align="center">
    <a href="{{route('registro.creating',$reunion->id)}}" class="btn btn-primary btn-lg btn-block">
      <strong>Agregar Nueva Registro</strong>
    </a>
  </div>
@endsection