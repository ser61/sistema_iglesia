@extends('layouts.admin')
@section('content')
  @include('alerts.request')
  @include('alerts.existfail')
  <br>
  <h1 id="cabeza"></h1>
  <div class="panel panel-primary">
  <div class="panel-heading" align="center" style="font-size: 20px">
    <strong>Formulario para agregar Version al encuentro {{$encuentro->nombre}}</strong>
  </div>
  <div class="panel-body">
      {!! Form::open(['route' => ['versiones.guardar', $encuentro['id']],'method' => 'POST']) !!}
      <br><br>
      <div class="row">
        <div class="col-lg-6" style="padding-left: 30px">
          {!! Form::label('Carnet del miembro:') !!}
          {!! Form::number('cimiembro',null,['class'=>'form-control','placeholder'=>'Ingresa el carnet de identidad del miembro...']) !!}    
          <span class="col-lg-12" style="color: #ff0000;">Dato obligatorio: Tiene que haber almenos un miembro para crear una version</span>
        </div><!-- /.col-lg-6 -->
        <div class="col-lg-6">
          {!! Form::label('Fecha de la version: ') !!} <br>
          {!! Form::date('fecha', \Carbon\Carbon::now(),['class'=>'form-control']) !!}
          <span class="col-lg-6" style="color: #ff0000;">Dato obligatorio</span>
        </div><!-- /.col-lg-6 -->
      </div><!-- /.row -->
      <br>
      <div class="form-group">
          {!! Form::label('Lugar de la version:') !!}
          {!! Form::text('lugar',null,['class'=>'form-control','placeholder'=>'Ingrese el lugar de la version...']) !!}
          <span class="col-lg-6" style="color: #ff0000;">Dato obligatorio</span>
      </div>
      <br><br>
      <div class="form-group" align="center">
        {!! Form::submit('Agregar Version' , ['class'=>'btn btn-primary btn-lg btn-block']) !!}
      </div>      
      {!! Form::close() !!}  
  </div>
</div> 
@endsection
