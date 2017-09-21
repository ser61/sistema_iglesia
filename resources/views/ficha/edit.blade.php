@extends('layouts.admin')
@section('content')
  @include('alerts.request')
  <br>
  <h1 id="cabeza"></h1>
  <div class="panel panel-primary">
    <div class="panel-heading" align="center" style="font-size: 20px">
      <strong>Formulario para editar nota de: {{$nombre->nombre}}</strong>
    </div>
    <div class="panel-body">
      {!! Form::model($ficha, ['route' => ['ficha.update', $ficha->id],'method' => 'PUT']) !!}
      <br><br>
      <div class="row">
        <div class="col-lg-6" style="padding-left: 30px">
          {!! Form::label('Asistencia: ') !!} <br>
          {!! Form::select('asistencia', ['0' => 'Ausente', '1' => 'Presente'], null, ['class'=>'form-control', 'placeholder'=>'Asistencia...']) !!}
          <span class="col-lg-6" style="color: #ff0000;">Dato obligatorio</span>
        </div><!-- /.col-lg-6 -->
        <div class="col-lg-6">
          {!! Form::label('Calificacion:') !!}
          {!! Form::number('nota',null,['class'=>'form-control', 'step'=>'any','placeholder'=>'Ingresa la nota del estudiante...']) !!}
          <span class="col-lg-6" style="color: #ff0000;">Dato obligatorio</span>
        </div><!-- /.col-lg-6 -->
      </div><!-- /.row -->
      <br>
      <div class="form-group" align="center">
        {!! Form::submit('Actualizar Nota' , ['class'=>'btn btn-primary btn-lg btn-block']) !!}
      </div>
      {!! Form::close() !!}
    </div>
  </div>
@endsection
