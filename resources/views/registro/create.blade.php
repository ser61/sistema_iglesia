@extends('layouts.admin')
@section('content')
  @include('alerts.request')
  @include('alerts.existfail')
  <br>
  <h1 id="cabeza"></h1>
  <div class="panel panel-primary">
    <div class="panel-heading" align="center" style="font-size: 20px">
      <strong>Formulario Para Agregar Registro al Reunion {{$reunion->nombre}}</strong>
    </div>
    <div class="panel-body">
      {!! Form::open(['route' => ['registro.guardar', $reunion->id],'method' => 'POST']) !!}
      <br><br>
      <div class="row">
        <div class="col-lg-4" style="padding-left: 30px">
          {!! Form::label('Fecha del Registro:') !!}
          {!! Form::date('fecha', \Carbon\Carbon::now(),['class'=>'form-control']) !!}
          <span class="col-lg-6" style="color: #ff0000;">Dato obligatorio</span>
        </div><!-- /.col-lg-6 -->
        <div class="col-lg-4">
          {!! Form::label('Nro de Asistentes:') !!}
          {!! Form::number('numerodeasistentes',null,['class'=>'form-control','placeholder'=>'Ingresa el carnet de identidad...']) !!}
          <span class="col-lg-6" style="color: #ff0000;">Dato obligatorio</span>
        </div><!-- /.col-lg-6 -->
        <div class="col-lg-4">
          {!! Form::label('Ofrenda:') !!}
          {!! Form::number('ofrenda',null,['class'=>'form-control', 'step'=>'any', 'placeholder'=>'Ingresa el carnet de identidad...']) !!}
          <span class="col-lg-6" style="color: #ff0000;">Dato obligatorio</span>
        </div><!-- /.col-lg-6 -->
      </div><!-- /.row -->
      <br><br>
      <div class="form-group" align="center">
        {!! Form::submit('Agregar Nueva Registro' , ['class'=>'btn btn-primary btn-lg btn-block']) !!}
      </div>
      {!! Form::close() !!}
    </div>
  </div>
@endsection