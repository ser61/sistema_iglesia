@extends('layouts.admin')
@section('content')
  @include('alerts.request')
  @include('alerts.success')
  <br>
  <h1 id="cabeza"></h1>
  <div class="panel panel-primary">
  <div class="panel-heading" align="center" style="font-size: 20px">
    <strong>Formulario Para Editar Version {{$version->id}} del Encuentro {{$encuentro->nombre}}</strong>
  </div>
  <div class="panel-body">
    {!! Form::model($version, ['route' => ['versiones.update', $version->id,$encuentro->id],'method' => 'PUT']) !!}
    <br><br>
    <div class="row">
      <div class="col-lg-6" style="padding-left: 30px">
        {!! Form::label('Fecha de la version: ') !!} <br>
        {!! Form::date('fecha', null,['class'=>'form-control']) !!}
        <span class="col-lg-6" style="color: #ff0000;">Dato obligatorio</span>
      </div><!-- /.col-lg-6 -->
      <div class="col-lg-6">
        {!! Form::label('Lugar de la version:') !!}
        {!! Form::text('lugar',null,['class'=>'form-control','placeholder'=>'Ingrese el lugar de la version...']) !!}
        <span class="col-lg-6" style="color: #ff0000;">Dato obligatorio</span>
      </div><!-- /.col-lg-6 -->
    </div><!-- /.row -->
    <br><br>
    <div class="form-group" align="center">
      {!! Form::submit('Actualizar Version' , ['class'=>'btn btn-primary btn-lg btn-block']) !!}
    </div>      
    {!! Form::close() !!}  
  </div>
</div> 
@endsection
