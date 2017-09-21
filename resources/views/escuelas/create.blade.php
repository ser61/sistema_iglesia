@extends('layouts.admin')
@section('content')
  @include('alerts.request')
  @include('alerts.existfail')
  <br>
  <div class="panel panel-primary">
    <div class="panel-heading" align="center" style="font-size: 20px">
      <strong>Formulario Para Registrar Escuela de Lideres</strong>
    </div>
    <div class="panel-body">
      {!! Form::open(['route' => 'escuela.store','method' => 'POST']) !!}
      <br>
      <div class="form-group">
        {!! Form::label('Numero de la Escuela de Lideres: ') !!}
        {!! Form::number('numero',null,['class'=>'form-control','placeholder'=>'Ingrese el Numero de la Ecuela de Lideres...']) !!}
        <span class="col-lg-6" style="color: #ff0000;">Dato obligatorio</span>
      </div>
      <br><br>
      <div class="form-group">
        {!! Form::label('CI del Miembro: ') !!}
        {!! Form::number('cimiembro',null,['class'=>'form-control','placeholder'=>'Ingrese el CI del Miembro...']) !!}
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