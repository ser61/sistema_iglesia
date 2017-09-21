@extends('layouts.admin')
@section('content')
  @include('alerts.request')
  @include('alerts.existfail')
  <br>
  <h1 id="cabeza"></h1>
  <div class="panel panel-primary">
  <div class="panel-heading" align="center" style="font-size: 20px">
    <strong>Formulario Para Editar Ministerio {{$ministerio->nombre}}</strong>
  </div>
  <div class="panel-body">
  	{!!Form::model($ministerio,['route'=> ['ministerio.update',$ministerio->id],'method'=>'PUT'])!!}
			<br><br>
	    <div class="form-group">
	      {!! Form::label(' Nombre:') !!}
	      {!! Form::text('nombre',null,['class'=>'form-control','placeholder'=>'ingresa el Nombre del Ministerio']) !!}
	      <span class="col-lg-6" style="color: #ff0000;">Dato obligatorio</span>
	    </div>
	    <br><br>
	    <div class="form-group" align="center">
	      {!! Form::submit('Actulizar Datos' , ['class'=>'btn btn-primary btn-lg btn-block']) !!}
	    </div>
		{!! Form::close() !!}
	</div>
</div> 
@endsection
