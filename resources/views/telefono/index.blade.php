@extends('layouts.admin')
@section('content')
  @include('alerts.success')
  @include('alerts.request')
  <br>
  <div class="panel panel-primary">
    <div class="panel-body">
      @include('layouts.cabezera') 
      <br>
      <h1 id="cabeza">Telefonos de {{ $persona->nombre}}</h1>
      <br>
      @if(count($telefonos) > 0)
        <table class="table table-hover">
          <tr class="info">
            <th>Codigo</th>
            <th>Numero</th>
            <th>Descripción</th>
            <th>Opciones</th>
          </tr>

          @foreach($telefonos as $telefono)
          <tr class="warning" metho>
            <td>{{$telefono->cod}}</td>
            <td>{{$telefono->numero}}</td>
            <td>{{$telefono->descripcion}}</td>
            <td>
              {!!Form::model($telefono,['route'=> ['telefono.destroy',$telefono->cod],'method'=>'DELETE'])!!}
                <a href="{{ route('telefono.edit',$telefono->cod) }}" class="btn btn-primary" aria-label="Skip to main navigation">
                  <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                </a>  
                <button class="btn btn-danger" type="submit"
                        data-toggle="confirmation" 
                        data-placement="left" 
                        data-title='¿Seguro quieres elimiar el telefono {{$telefono->numero}}? de {{$telefono->descripcion}}'
                        data-btnOkClass="btn btn-primary"
                        data-btnOkLabel='<i class="fa fa-check-circle"></i> Si'
                        data-btnCancelClass="btn btn-default"
                        data-btnCancelLabel='<i class="fa fa-times-circle" aria-hidden="true"></i> No'>
                  <i class="fa fa-trash-o" aria-hidden="true"></i>
                </button>
              {!! Form::close() !!}  
            </td>
          </tr>
          @endforeach
        </table>
      @else
        <div class="panel panel-default">
          <div class="panel-body">
            <h3 style="text-align: center;">
              <b style="text-align: center;">{{ $persona->nombre}} no tiene telefonos...</b>
            </h3>
          </div>
        </div>
      @endif
    </div>
</div>
<div class="form-group" align="center">
    <a href="{{ route('agregarTelefono',['ci'=>$persona->ci, 'nombre'=>$persona->nombre])}}" class="btn btn-primary btn-lg btn-block">
      <strong>Agregar Telfono</strong>
    </a>
</div>
@endsection
