@extends('layouts.admin')
@section('content')
  @include('alerts.request')
  @include('alerts.existfail')
  <br>
  <h1 id="cabeza"></h1>
  <div class="panel panel-primary">
  <div class="panel-heading" align="center" style="font-size: 20px">
    <strong>Formulario Para Agregar Telefono a {{$dato['nombre']}}</strong>
  </div>
  <div class="panel-body">
    {!! Form::open(['route' => ['guardarTelefono',$dato['ci']],'method' => 'POST']) !!}
    <br><br>
    <div class="row">
      <div class="col-lg-6" style="padding-left: 30px">
        {!! Form::label('Tefono de Miembro:') !!}
        {!! Form::number('numero',null,['class'=>'form-control','placeholder'=>'Ingresa numero de telefono...']) !!}    
        <span class="col-lg-6" style="color: #ff0000;">Dato obligatorio</span>
      </div><!-- /.col-lg-6 -->
      <div class="col-lg-6">
        {!! Form::label('Descripcion del numero:') !!} <br>
        {!! Form::text('descripcion',null,['class'=>'form-control','placeholder'=>'Ingrese la descripcion de telefono...']) !!}
        <span class="col-lg-6" style="color: #ff0000;">Dato obligatorio</span>
      </div><!-- /.col-lg-6 -->
    </div><!-- /.row -->
    <br><br>
    <div class="form-group" align="center">
        {!! Form::submit('Agregar numero de telefono' , ['class'=>'btn btn-primary btn-lg btn-block']) !!}
    </div>
    {!! Form::close() !!}  
  </div>
</div> 
@endsection
