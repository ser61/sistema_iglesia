@extends('layouts.admin')
@section('content')
  @include('alerts.request')
  <br>
  <h1 id="cabeza"></h1>
  <div class="panel panel-primary">
    <div class="panel-heading" align="center" style="font-size: 20px">
      <strong>Formulario para registrar notas</strong>
    </div>
    <div class="panel-body">
      {!! Form::open(['route' => ['ficha.guardar', $idclase],'method' => 'POST']) !!}
      <br><br>
      <div class="form-group">
        {!! Form::label('Estudiante: ') !!} <br>
        {!! Form::select('cimiembro',$faltantes, null, ['class'=>'form-control']) !!}
        <span class="col-lg-6" style="color: #ff0000;">Dato obligatorio</span>
      </div>
      <br><br>
      <div class="row">
        <div class="col-lg-6" style="padding-left: 30px">
          {!! Form::label('Asistencia: ') !!} <br>
          {!! Form::select('asistencia', ['0' => 'Ausente', '1' => 'Presente'], null, ['class'=>'form-control', 'placeholder'=>'Asistencia...']) !!}
          <span class="col-lg-6" style="color: #ff0000;">Dato obligatorio</span>
        </div><!-- /.col-lg-6 -->
        <div class="col-lg-6">
          {!! Form::label('Calificacion:') !!}
          {!! Form::number('nota','0',['class'=>'form-control', 'step'=>'any','placeholder'=>'Ingresa la nota del estudiante...']) !!}
          <span class="col-lg-6" style="color: #ff0000;">Dato obligatorio</span>
        </div><!-- /.col-lg-6 -->
      </div><!-- /.row -->
      <br>
      <div class="form-group" align="center">
        {!! Form::submit('Agregar Nota' , ['class'=>'btn btn-primary btn-lg btn-block']) !!}
      </div>
      {!! Form::close() !!}
    </div>
  </div>
@endsection
