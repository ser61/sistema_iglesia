@extends('layouts.admin')
@section('content')
  @include('alerts.request')
  <br>
  <h1 id="cabeza"></h1>
  <div class="panel panel-primary">
  <div class="panel-heading" align="center" style="font-size: 20px">
    <strong>Formulario Para Editar Trabajo de: {{ $persona->nombre }}</strong>
  </div>
  <div class="panel-body">
    {!! Form::model($trabajo, ['route' => ['trabajo.update', $trabajo->nrodetrabajo],'method' => 'PUT']) !!}
    <br><br>
    <div class="row">
      <div class="col-lg-6" style="padding-left: 30px">
        {!! Form::label('Nombre o Descripcion Del Trabajo:') !!}
        {!! Form::text('nombredescripcion',null,['class'=>'form-control','placeholder'=>'Ingrese descripcion del trabajo...']) !!}
        <span class="col-lg-6" style="color: #ff0000;">Dato obligatorio</span>
      </div><!-- /.col-lg-6 -->
      <div class="col-lg-6">
        {!! Form::label('Direccion Del Trabajo:') !!} <br>
        {!! Form::text('direccion',null,['class'=>'form-control','placeholder'=>'Ingrese la direccion del trabajo...']) !!}
        <span class="col-lg-6" style="color: #ff0000;">Dato obligatorio</span>
      </div><!-- /.col-lg-6 -->
    </div><!-- /.row -->
    <br><br>
    <div class="form-group" align="center">
        {!! Form::submit('Agregar numero de trabao' , ['class'=>'btn btn-primary btn-lg btn-block']) !!}
    </div>
    {!! Form::close() !!}  
  </div>
</div> 
@endsection
