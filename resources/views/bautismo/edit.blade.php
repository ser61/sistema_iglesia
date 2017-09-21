@extends('layouts.admin')
@section('content')
  @include('alerts.request')
  <br>
  <h1 id="cabeza"></h1>
  <div class="panel panel-primary">
  <div class="panel-heading" align="center" style="font-size: 20px">
    <strong>Edicion de datos del Bautismo</strong>
  </div>
  <div class="panel-body">
  {!!Form::model($bautismo,['route'=> ['bautismo.update',$bautismo->id],'method'=>'PUT'])!!}
  <br>
    <div class="row">
      <div class="col-lg-6" style="padding-left: 30px">
        {!! Form::label('Fecha del Bautismo: ') !!}
        {!! Form::date('fecha', \Carbon\Carbon::now(),['class'=>'form-control']) !!}
        <span class="col-lg-6" style="color: #ff0000;">Dato obligatorio</span>
      </div><!-- /.col-lg-6 -->
      <div class="col-lg-6">
        {!! Form::label('Lugar del Bautismo:') !!} <br>
        {!! Form::text('lugar',null,['class'=>'form-control','placeholder'=>'Ingresa lugar de bautismo']) !!}
        <span class="col-lg-6" style="color: #ff0000;">Dato obligatorio</span>
      </div><!-- /.col-lg-6 -->
    </div><!-- /.row -->
    <br><br>
    <div class="form-group" align="center">
      {!! Form::submit('Actualizar' , ['class'=>'btn btn-primary btn-lg btn-block']) !!}
    </div>
  {!! Form::close() !!}
  </div>
</div> 
@endsection
