@extends('layouts.admin')
@section('content')
  @include('alerts.request')
  @include('alerts.success')
  @include('alerts.existfail')
  <br>
  <div class="panel panel-primary">
    <div class="panel-heading" align="center" style="font-size: 20px">
      <strong>Formulario Para Inscripcion</strong>
    </div>
    <div class="panel-body">
      {!! Form::open(['route' => 'boleta.store','method' => 'POST']) !!}
      <br>
      <div class="form-group">
        {!! Form::label('Numero de Escuela:') !!}
        {!! Form::number('numero',null,['class'=>'form-control','placeholder'=>'Ingresa el numero de la escuela...']) !!}
        <span class="col-lg-6" style="color: #ff0000;">Dato obligatorio</span>
      </div>
      <br>
      <br>
      <div class="form-group">
        {!! Form::label('Numero de Modulo:') !!}
        {!! Form::number('numeromodulo',null,['class'=>'form-control','placeholder'=>'Ingresa el numero del modulo debe ser del 1 al 3...']) !!}
        <span class="col-lg-6" style="color: #ff0000;">Dato obligatorio</span>
      </div>
      <br>
      <br>
      <div class="form-group">
        {!! Form::label('CI del Miembro:') !!}
        {!! Form::number('cimiembro',null,['class'=>'form-control','placeholder'=>'Ingresa el CI del miembro a inscribirse...']) !!}
        <span class="col-lg-6" style="color: #ff0000;">Dato obligatorio</span>
      </div>
      <br>
      <div class="form-group" align="center">
        {!! Form::submit('Registrar Inscripcion' , ['class'=>'btn btn-primary btn-lg btn-block']) !!}
      </div>
      {!! Form::close() !!}
    </div>
  </div>
@endsection