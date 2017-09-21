@extends('layouts.admin')
@section('content')
  @include('alerts.request')
  <br>
  <h1 id="cabeza"></h1>
  <div class="panel panel-primary">
  <div class="panel-heading" align="center" style="font-size: 20px">
    <strong>Formulario Para Editar Prerrequisito del Encuentro {{$encuentro->nombre}}</strong>
  </div>
  <div class="panel-body">
    {!! Form::model($prerequisito, ['route' => ['prerequisito.update', $prerequisito->id],'method' => 'PUT']) !!}
    <br><br>
    <div class="form-group">
        {!! Form::label('Requisito: ') !!} <br>
        {!! Form::select('idprerequisito',$encuentros, null, ['class'=>'form-control']) !!}
        <span class="col-lg-6" style="color: #ff0000;">Dato obligatorio</span>
    </div>
    <br><br>
    <div class="form-group" align="center">
      {!! Form::submit('Actualizar Prerrequisito' , ['class'=>'btn btn-primary btn-lg btn-block']) !!}
    </div>      
    {!! Form::close() !!}  
  </div>
</div> 
@endsection
