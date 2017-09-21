@extends('layouts.admin')
@section('content')
  @include('alerts.request')
  @include('alerts.existfail')
  <br>
  <div class="panel panel-primary">
    <div class="panel-heading" align="center" style="font-size: 20px">
      <strong>Formulario Para Registrar Clase del Modulo: {{$modulo->numero}}</strong>
    </div>
    <div class="panel-body">
      {!! Form::open(['route' => ['clase.guardar',$modulo->id],'method' => 'POST']) !!}
      <br><br>
      <div class="form-group">
        {!! Form::label('Fecha de inicio de la Clase: ') !!}
        {!! Form::date('fecha', \Carbon\Carbon::now(),['class'=>'form-control']) !!}
        <span class="col-lg-6" style="color: #ff0000;">Dato obligatorio</span>
      </div>
      <br><br>
      <div class="form-group" align="center">
        {!! Form::submit('Registrar' , ['class'=>'btn btn-primary btn-lg btn-block']) !!}
      </div>
      {!! Form::close() !!}
    </div>
  </div>
@endsection