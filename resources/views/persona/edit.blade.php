@extends('layouts.admin')
@section('content')
  @include('alerts.request')
  <br>
  <div class="panel panel-primary">
    <div class="panel-heading" align="center" style="font-size: 20px"><strong>{{$persona->nombre}}</strong>&nbsp;&nbsp;<strong>{{$persona->apellido}}</strong></div>
    <div class="panel-body">
      {!!Form::model($persona,['route'=> ['persona.update',$persona->ci],'method'=>'PUT'])!!}
      <div class="row">
        <div class="col-lg-6" style="padding-left: 30px">
          {!! Form::label('Carnet:') !!}
          {!! Form::number('ci',null,['class'=>'form-control','placeholder'=>'Ingresa el carnet de identidad...']) !!}    
          <span class="col-lg-6" style="color: #ff0000;">Dato obligatorio</span>
        </div><!-- /.col-lg-6 -->
        <div class="col-lg-6">
          {!! Form::label('Nombre:') !!}
          {!! Form::text('nombre',null,['class'=>'form-control','placeholder'=>'Ingresa el Nombre...']) !!}    
          <span class="col-lg-6" style="color: #ff0000;">Dato obligatorio</span>
        </div><!-- /.col-lg-6 -->
      </div><!-- /.row -->
      <br>
      <div class="row">
        <div class="col-lg-6" style="padding-left: 30px">
          {!! Form::label('Apellido:') !!}
          {!! Form::text('apellido',null,['class'=>'form-control','placeholder'=>'Ingresa el Apellido...']) !!}
          <span class="col-lg-6" style="color: #ff0000;">Dato obligatorio</span>
        </div><!-- /.col-lg-6 -->
        <div class="col-lg-6">
          {!! Form::label('Sexo: ') !!} <br>
          {!! Form::select('sexo', ['M' => 'Masculino', 'F' => 'Femenino'], null, ['class'=>'form-control', 'placeholder'=>'Ingrese el sexo...']) !!}
          <span class="col-lg-6" style="color: #ff0000;">Dato obligatorio</span>
        </div><!-- /.col-lg-6 -->
      </div><!-- /.row -->
      <br>
      <div class="row">
        <div class="col-lg-6" style="padding-left: 30px">
          {!! Form::label('Fecha de Nacimiento: ') !!} <br>
          {!! Form::date('fechadenacimiento', \Carbon\Carbon::now(),['class'=>'form-control']) !!}
          <span class="col-lg-6" style="color: #ff0000;">Dato obligatorio</span>
        </div><!-- /.col-lg-6 -->
        <div class="col-lg-6">
          {!! Form::label('Lugar de Nacimiento:') !!}
          {!! Form::text('lugardenacimiento',null,['class'=>'form-control','placeholder'=>'ingresa el Lugar donde Naciste']) !!}   
          <span class="col-lg-6" style="color: #ff0000;">Dato obligatorio</span>       
        </div><!-- /.col-lg-6 -->
      </div><!-- /.row -->
      <br>
      <div class="form-group">
        {!! Form::label('Direccion') !!}
        {!! Form::text('direccion',null,['class'=>'form-control','placeholder'=>'ingresa tu direccion']) !!}
        <span class="col-lg-6" style="color: #ff0000;">Dato obligatorio</span>
      </div>
      <br>
      <div class="row">
        <div class="col-lg-6" style="padding-left: 30px">
          {!! Form::label('Estado Civil: ') !!} <br>
          {!! Form::select('estadocivil', ['S' => 'Soltero', 'C' => 'Casado', 'V' =>'Viudo', 'D' => 'Divorciado'], null, ['class'=>'form-control', 'placeholder' => 'Seleccione estado civil...']) !!}
          <span class="col-lg-6" style="color: #ff0000;">Dato obligatorio</span>
        </div><!-- /.col-lg-6 -->
        <div class="col-lg-6">
          {!! Form::label('Grado de Instruccion: ') !!} <br>
          {!! Form::select('gradoinstruccion', ['Bachiller' => 'Bachiller', 'licenciado' => 'Licenciado', 'master' => 'Master', 'otro' => 'Otro'], null, ['class'=>'form-control', 'placeholder' => 'Seleccione grado de instruccion...']) !!}
          <span class="col-lg-6" style="color: #ff0000;">Dato obligatorio</span>
        </div><!-- /.col-lg-6 -->
      </div><!-- /.row -->
      <br>
      <div class="row">
        <div class="col-lg-6" style="padding-left: 30px">
          {!! Form::label('Carnet Padre:') !!}
          {!! Form::number('cipadre',null,['class'=>'form-control','placeholder'=>'ingresa el carnet de identidad']) !!}
        </div><!-- /.col-lg-6 -->
        <div class="col-lg-6">
          {!! Form::label('Carnet Madre:') !!}
          {!! Form::number('cimadre',null,['class'=>'form-control','placeholder'=>'ingresa el carnet de identidad']) !!}
        </div><!-- /.col-lg-6 -->
      </div><!-- /.row -->
      <br>
      <div class="form-group" align="center">
        {!! Form::submit('Registrar' , ['class'=>'btn btn-primary btn-lg btn-block']) !!}
      </div>      
      {!! Form::close() !!}
    </div>
  </div>
@endsection
