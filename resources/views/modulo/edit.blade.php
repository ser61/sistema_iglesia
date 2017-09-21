@extends('layouts.admin')
@section('content')
  @include('alerts.request')
  @include('alerts.existfail')
  <br>
  <div class="panel panel-primary">
    <div class="panel-heading" align="center" style="font-size: 20px">
      <strong>Formulario Para Editar Modulo de la Escuela: {{$modulo->numeroescuela}}</strong>
    </div>
    <div class="panel-body">
      {!!Form::model($modulo,['route'=> ['modulo.update', $modulo->id],'method'=>'PUT'])!!}
      <br><br>
      <div class="form-group">
        {!! Form::label('Fecha de inicio del Modulo: ') !!}
        {!! Form::date('fechainicio', null,['class'=>'form-control']) !!}
        <span class="col-lg-6" style="color: #ff0000;">Dato obligatorio</span>
      </div>
      <br><br>
      <div class="form-group" align="center">
        {!! Form::submit('Actualizar' , ['class'=>'btn btn-primary btn-lg btn-block']) !!}
      </div>
      {!! Form::close() !!}
    </div>
  </div>
@endsection