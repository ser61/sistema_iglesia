@extends('layouts.admin')
@section('content')
  @include('alerts.success')
  @include('alerts.request')
  <br>
  <div class="panel panel-primary">
    <div class="panel-body">
      @include('layouts.cabezera') 
      <br>
      <h1 id="cabeza">Trabajos de {{ $persona->nombre}}</h1>
      <br>
      @if(count($trabajos) > 0)
        <table class="table table-hover">
          <tr class="info">
            <th>Numero</th>
            <th>Descripcion o Nombre</th>
            <th>Dirección</th>
            <th>Opciones</th>
          </tr>

          @foreach($trabajos as $trabajo)
          <tr class="warning" metho>
            <td>{{$trabajo->nrodetrabajo}}</td>
            <td>{{$trabajo->nombredescripcion}}</td>
            <td>{{$trabajo->direccion}}</td>
            <td>
              {!!Form::model($trabajo,['route'=> ['trabajo.destroy',$trabajo->nrodetrabajo],'method'=>'DELETE'])!!}
                <a href="{{ route('trabajo.edit',$trabajo->nrodetrabajo) }}" class="btn btn-primary" aria-label="Skip to main navigation">
                  <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                </a>  
                <button class="btn btn-danger" type="submit"
                        data-toggle="confirmation" 
                        data-placement="left" 
                        data-title='¿Seguro quieres elimiar el trabajo {{$trabajo->nombredescripcion}}?'
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
                <b style="text-align: center;">{{ $persona->nombre}} no tiene ningun trabajo...</b>
              </h3>
          </div>
        </div>
      @endif
    </div>
</div>
<div class="form-group" align="center">
    <a href="{{ route('agregarTrabajo',['ci'=>$persona->ci, 'nombre'=>$persona->nombre])}}" class="btn btn-primary btn-lg btn-block">
      <strong>Agregar Trabajo</strong>
    </a>
</div>
@endsection
