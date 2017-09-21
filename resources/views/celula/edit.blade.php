@extends('layouts.admin')
@section('content')
  @include('alerts.request')
  @include('alerts.existfail')
  <br>
  <div class="panel panel-primary">
    <div class="panel-heading" align="center" style="font-size: 20px">
      <strong>Formulario Para Actualizar Celulas</strong>
    </div>
    <div class="panel-body">
      {!!Form::model($celula,['route'=> ['celula.update',$celula->numero],'method'=>'PUT'])!!}
      <br>
      <div class="form-group">
        {!! Form::label('Numero de Celula: ') !!}
        {!! Form::number('numero',null,['class'=>'form-control','placeholder'=>'Ingrese el Numero de Celula...']) !!}
        <span class="col-lg-6" style="color: #ff0000;">Dato obligatorio</span>
      </div>
      <br><br>
      <div class="form-group">
        {!! Form::label('Fecha de Creacion: ') !!}
        {!! Form::date('fechadecreacion', \Carbon\Carbon::now(),['class'=>'form-control']) !!}
        <span class="col-lg-6" style="color: #ff0000;">Dato obligatorio</span>
      </div>
      <br><br>
      <div class="form-group" align="center">
        {!! Form::submit('Actualizar Celula' , ['class'=>'btn btn-primary btn-lg btn-block']) !!}
      </div>
      {!! Form::close() !!}
    </div>
  </div>
@endsection