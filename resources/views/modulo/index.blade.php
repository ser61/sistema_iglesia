@extends('layouts.admin')
@section('content')
  @include('alerts.success')
  @include('alerts.request')
  <br>
  <div class="panel panel-primary">
    <div class="panel-body">
      @include('layouts.cabezera')
      <br>
      <h1 id="cabeza">Lista de Modulos de la Escuela: {{$numero}}</h1>
      <br>
      @if((count($modulos)) > 0)
      <div id="tbody">
        <table class="table table-hover">
          <tr class="info">
            <th>Nro Modulo</th>
            <th>Fecha de Inicio</th>
            <th style="text-align: center">Opciones</th>
          </tr>

          @foreach($modulos as $modulo)
            <tr class="warning">
              <td style="text-align: center">{{$modulo->numero}}</td>
              <td><?php echo Carbon\Carbon::createFromFormat('Y-m-d', $modulo->fechainicio)->format('d M Y') ?></td>
              <td align="center">
                {!!Form::model($modulo,['route'=> ['modulo.destroy',$modulo->id],'method'=>'DELETE'])!!}
                <a href="{{ route('modulo.edit', $modulo->id) }}" class="btn btn-warning"
                   aria-label="Skip to main navigation">
                  <i class="fa fa-pencil-square-o" aria-hidden="true"></i> Editar
                </a>
                <button class="btn btn-danger" type="submit"
                        data-toggle="confirmation"
                        data-placement="left"
                        data-title="SI ELIMINA EL MODULO {{$modulo->numero}} ELIMINARA TAMBIEN TODOS LOS DATOS DE LA MISMA!!!"
                        data-btnOkClass="btn btn-primary"
                        data-btnOkLabel='<i class="fa fa-check-circle"></i> Si'
                        data-btnCancelClass="btn btn-default"
                        data-btnCancelLabel='<i class="fa fa-times-circle" aria-hidden="true"></i> No'>
                  <i class="fa fa-trash-o" aria-hidden="true"></i> Eliminar
                </button>
                <a href="{{ route('modulo.show', $modulo->id) }}" class="btn btn-success"
                   aria-label="Skip to main navigation">
                  <i class="fa fa-eye" aria-hidden="true"></i> Clases
                </a>
                {!! Form::close() !!}
              </td>
            </tr>
          @endforeach
        </table>
      </div>
      @else
        <div class="panel panel-default">
          <div class="panel-body">
            <h3 style="text-align: center;">
              <b style="text-align: center;">No existe ningun Modulo aun...</b>
            </h3>
          </div>
        </div>
      @endif
    </div>
  </div>
  @if(count($modulos) < 3)
  <div class="form-group" align="center">
    <a href="{{ route('modulo.agregar',$numero)}}" class="btn btn-primary btn-lg btn-block">
      <strong>Agregar Modulo</strong>
    </a>
  </div>
  @endif
@endsection
