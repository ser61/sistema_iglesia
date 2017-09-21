@extends('layouts.admin')
@section('content')
    @include('alerts.request')
    @include('alerts.existfail')
    <br>
    <h1 id="cabeza"></h1>
    <div class="panel panel-primary">
      <div class="panel-heading" align="center" style="font-size: 20px">
        <strong>Formulario Para Agregar Reunion</strong>
      </div>
      <div class="panel-body">
        {!! Form::open(['route' => 'reunion.store','method' => 'POST']) !!}
          <br><br>
          <div class="row">
            <div class="col-lg-6" style="padding-left: 30px">
              {!! Form::label('Nombre de la Reunion:') !!}
              {!! Form::text('nombre',null,['class'=>'form-control','placeholder'=>'Ingresa el nombre de la Reunion...']) !!}
              <span class="col-lg-6" style="color: #ff0000;">Dato obligatorio</span>
            </div><!-- /.col-lg-6 -->
            <div class="col-lg-6">
              {!! Form::label('Dia de la Reunion:') !!}
              {!! Form::text('dia',null,['class'=>'form-control','placeholder'=>'Ingrese el dia...']) !!}
              <span class="col-lg-6" style="color: #ff0000;">Dato obligatorio</span>
            </div><!-- /.col-lg-6 -->
          </div><!-- /.row -->
          <br><br>
          <div class="row">
            <div class="col-lg-6" style="padding-left: 30px">
              {!! Form::label('Hora de Inicion:') !!}
              <div class="input-group bootstrap-timepicker timepicker">
                <input id="time1" name="horadeinicio" type="text"
                       class="form-control input-small" data-show-Meridian="false">
                <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
              </div>
              <span class="col-lg-6" style="color: #ff0000;">Dato obligatorio</span>
            </div><!-- /.col-lg-6 -->
            <div class="col-lg-6">
              {!! Form::label('Hora de Finalizacion:') !!}
              <div class="input-group bootstrap-timepicker timepicker">
                <input id="time2" name="horadefinal" type="text" class="form-control input-small" data-show-Meridian="false">
                <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
              </div>
              <span class="col-lg-6" style="color: #ff0000;">Dato obligatorio</span>
            </div><!-- /.col-lg-6 -->
          </div><!-- /.row -->
          <br><br>
          <div class="form-group" align="center">
            {!! Form::submit('Agregar Nueva Reunion' , ['class'=>'btn btn-primary btn-lg btn-block']) !!}
          </div>
        {!! Form::close() !!}
      </div>
    </div>
@endsection
@section('script')
  <script type="text/javascript">
    $('#time1').timepicker({
      icons: {
        up: "fa fa-chevron-up",
        down: 'fa fa-chevron-down'
      }
    });

    $('#time2').timepicker({
      icons: {
        up: "fa fa-chevron-up",
        down: 'fa fa-chevron-down'
      }
    });
  </script>
@endsection