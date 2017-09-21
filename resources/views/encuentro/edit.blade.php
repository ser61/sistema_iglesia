@extends('layouts.admin')
@section('content')
  @include('alerts.request')
  @include('alerts.success')
  <br>
  <h1 id="cabeza"></h1>
  <div class="panel panel-primary">
  <div class="panel-heading" align="center" style="font-size: 20px">
    <strong>Formulario Para Editar Encuentro {{$encuentro->nombre}}</strong>
  </div>
  <div class="panel-body">
    {!!Form::model($encuentro,['route'=> ['encuentro.update',$encuentro->id],'method'=>'PUT'])!!}
    	<br><br>
      <div class="form-group">
        {!! Form::label('Nombre del encuentro:') !!}
        {!! Form::text('nombre',null,['class'=>'form-control','placeholder'=>'ingresa el nombre del encuentro..']) !!}
        <span class="col-lg-6" style="color: #ff0000;">Dato obligatorio</span>
      </div>
      <br><br>
      <div class="form-group" align="center">
        {!! Form::submit('Actualizar Datos' , ['class'=>'btn btn-primary btn-lg btn-block']) !!}
      </div>
		{!! Form::close() !!}
	</div>
</div> 
@endsection