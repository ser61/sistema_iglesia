@extends('layouts.admin')
@section('content')
  @include('alerts.request')
  <br>
  <h1 id="cabeza"></h1>
  <div class="panel panel-primary">
  <div class="panel-heading" align="center" style="font-size: 20px">
    <strong>{{ $persona->nombre }}</strong>&nbsp;&nbsp;<strong>{{ $persona->apellido }}</strong>
  </div>
  <div class="panel-body">
    {!!Form::model($miembro,['route'=> ['miembro.update',$miembro->ci],'method'=>'PUT'])!!}
      <br>
      <div class="row">
        <div class="col-lg-6" style="padding-left: 30px">
          {!! Form::label('Carnet:') !!}
          {!! Form::number('ci',null,['class'=>'form-control','placeholder'=>'Ingresa el carnet de identidad...']) !!}    
          <span class="col-lg-6" style="color: #ff0000;">Dato obligatorio</span>
        </div><!-- /.col-lg-6 -->
        <div class="col-lg-6">
          {!! Form::label('Fecha de Convercion: ') !!} <br>
          {!! Form::date('fechadeconversion', \Carbon\Carbon::now(),['class'=>'form-control']) !!}
          <span class="col-lg-6" style="color: #ff0000;">Dato obligatorio</span>
        </div><!-- /.col-lg-6 -->
      </div><!-- /.row -->
      <br><br>
      <div class="row">
        <div class="col-lg-6" style="padding-left: 30px">
          {!! Form::label('ID de Ministerio:') !!}
          {!! Form::number('idministerio',null,['class'=>'form-control','placeholder'=>'Ingresa codigo de ministerio...']) !!}    
        </div><!-- /.col-lg-6 -->
        <div class="col-lg-6">
          {!! Form::label('ID de Bautismo: ') !!} <br>
          {!! Form::number('idbautismo',null,['class'=>'form-control','placeholder'=>'Ingresa codigo de bautismo...']) !!}
        </div><!-- /.col-lg-6 -->
      </div><!-- /.row -->
      <br><br>
      <div class="form-group" align="center">
        {!! Form::submit('Guardar Edición' , ['class'=>'btn btn-primary btn-lg btn-block']) !!}
      </div>
    {!! Form::close() !!}
    </div>
  </div> 
@endsection
