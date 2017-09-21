@extends('layouts.admin')
@section('content')
  @include('alerts.request')
  @include('alerts.existfail')
  <br>
  <div class="panel panel-primary">
    <div class="panel-heading" align="center" style="font-size: 20px">
      <strong>Formulario Para Registrar Informe de Celula</strong>
    </div>
    <div class="panel-body">
      {!! Form::open(['route' => ['informe.guardar', $nrocelula],'method' => 'POST']) !!}
      <br>
      <div class="form-group">
        {!! Form::label('CI del Lider de Celula:') !!}
        {!! Form::number('cilider',$cilider,['class'=>'form-control','placeholder'=>'Ingresa el carnet de identidad...']) !!}
        <span class="col-lg-6" style="color: #ff0000;">Dato obligatorio</span>
      </div>
      <br>
      <div class="row">
        <div class="col-lg-6" style="padding-left: 30px">
          {!! Form::label('Fecha de Informe: ') !!} <br>
          {!! Form::date('fecha', \Carbon\Carbon::now(),['class'=>'form-control']) !!}
          <span class="col-lg-6" style="color: #ff0000;">Dato obligatorio</span>
        </div><!-- /.col-lg-6 -->
        <div class="col-lg-6">
          {!! Form::label('Numero de nuevos:') !!}
          {!! Form::number('nronuevos',null,['class'=>'form-control','placeholder'=>'Ingresa el carnet de identidad...']) !!}
          <span class="col-lg-6" style="color: #ff0000;">Dato obligatorio</span>
        </div><!-- /.col-lg-6 -->
      </div><!-- /.row -->
      <br>
      <div class="row">
        <div class="col-lg-6" style="padding-left: 30px">
          {!! Form::label('Numero de visitas:') !!}
          {!! Form::number('nrovisitas',null,['class'=>'form-control','placeholder'=>'Ingresa el carnet de identidad...']) !!}
          <span class="col-lg-6" style="color: #ff0000;">Dato obligatorio</span>
        </div><!-- /.col-lg-6 -->
        <div class="col-lg-6">
          {!! Form::label('Ofrenda:') !!}
          {!! Form::number('ofrenda',null,['class'=>'form-control', 'step'=>'any','placeholder'=>'Ingresa el carnet de identidad...']) !!}
          <span class="col-lg-6" style="color: #ff0000;">Dato obligatorio</span>
        </div><!-- /.col-lg-6 -->
      </div><!-- /.row -->
      <br>
      <div class="form-group" align="center">
        {!! Form::submit('Registrar Informe' , ['class'=>'btn btn-primary btn-lg btn-block']) !!}
      </div>
      {!! Form::close() !!}
    </div>
  </div>
@endsection