@extends('layouts.admin')
@section('content')
    @include('alerts.request')
    @include('alerts.success')
    @include('alerts.existfail')
    <br>
    <div class="panel panel-primary">
        <div class="panel-heading" align="center" style="font-size: 20px">
            <strong>Formulario Para Agregar Asistente</strong>
        </div>
        <div class="panel-body">
            {!! Form::open(['route' => ['asistecia.guardar', $idInforme],'method' => 'POST']) !!}
            <br><br>
            <div class="form-group">
                {!! Form::label('CI del Miembro a Asistir:') !!}
                {!! Form::number('cimiembro',null,['class'=>'form-control','placeholder'=>'Ingresa el carnet de identidad...']) !!}
                <span class="col-lg-6" style="color: #ff0000;">Dato obligatorio</span>
            </div>
            <br><br>
            <div class="form-group" align="center">
                {!! Form::submit('Registrar Asistencia' , ['class'=>'btn btn-primary btn-lg btn-block']) !!}
            </div>
            {!! Form::close() !!}
        </div>
    </div>
    <div class="panel panel-primary">
        <div class="panel-heading" align="center" style="font-size: 20px">
            <strong>Lista de Miembros</strong>
        </div>
        <div class="panel-body">
            <div class="panel panel-default">
                <div class="panel-body">
                    <input type="text" class="form-control" placeholder="Busqueda por nombre, apellido o carnet..." id="search">
                </div>
            </div>

            <div id="tbody">
                <table class="table table-hover">
                    <tr class="info">
                        <th>CI</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                    </tr>

                    @foreach($miembros as $miembro)
                        <tr class="warning">
                            <td>{{$miembro->ci}}</td>
                            <td>{{$miembro->nombre}}</td>
                            <td>{{$miembro->apellido}}</td>
                        </tr>
                    @endforeach
                </table>
                {{$miembros->links()}}
            </div>
        </div>
    </div>
@endsection
@section('script')
  <script type="text/javascript">
    $('#search').on('keyup',function(){
      $value = $(this).val();
      $.ajax({
        type : 'GET',
        url : "{{url('asistencia/searchMiembros/')}}",
        data : {'search':$value, 'idinforme':{{$idInforme}} },
        success: function(data){
          console.log(data);
          $('#tbody').html(data);
        }
      });
    });

    $(document).on('click','.pagination a', function(e){
      e.preventDefault();
      var page=$(this).attr('href').split('page=')[1];
      posAsistentes(page,$('#search').val());
    });

    function posAsistentes(page, search){
      var url = "{{url('asistencia/miembrosPaginateSearch/')}}";
      $.ajax({
        type : 'GET',
        url : url+'?page='+page,
        data : {'search' : search, 'idinforme':{{$idInforme}} },
      }).done(function(data){
        $('#tbody').html(data);
      })
    }
  </script>
@endsection