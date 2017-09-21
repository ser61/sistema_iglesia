@extends('layouts.admin')
@section('content')
  @include('alerts.request')
  <br>
  <h1 id="cabeza"></h1>
  <div class="panel panel-primary">
  <div class="panel-heading" align="center" style="font-size: 20px">
    <strong>Formulario para agregar Prerrequisito al encuentro {{$encuentro->nombre}}</strong>
  </div>
  <div class="panel-body">
      {!! Form::open(['route' => ['prerequisito.guardar', $encuentro['id']],'method' => 'POST']) !!}
      <br><br>
      <div class="form-group">
          {!! Form::label('Requisito: ') !!} <br>
          {!! Form::select('idprerequisito',$encuentros, null, ['class'=>'form-control']) !!}
          <span class="col-lg-6" style="color: #ff0000;">Dato obligatorio</span>
      </div>
      <br><br>
      <div class="form-group" align="center">
        {!! Form::submit('Agregar Prerrequisito' , ['class'=>'btn btn-primary btn-lg btn-block']) !!}
      </div>      
      {!! Form::close() !!}  
  </div>
</div> 
@endsection
