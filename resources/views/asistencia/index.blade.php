@extends('layouts.admin')
@section('content')
    @include('alerts.success')
    <br>
    <div class="panel panel-primary">
        <div class="panel-body">
            @include('layouts.cabezera')
            <br>
            <h1 id="cabeza">Lista de Asistencia del Informe: {{$idInforme}}</h1>
            <br>
            <div class="panel panel-default">
                <div class="panel-body">
                    <input type="text" class="form-control" placeholder="Busqueda por datos del Miembro..." id="search">
                </div>
            </div>
            @if(count($asistentes) > 0)

                <div id="tbody">
                    <table class="table table-hover">
                        <tr class="info">
                            <th>Id de la Asistencia</th>
                            <th>CI del miembro</th>
                            <th>Nombre</th>
                            <th>Apellido</th>
                            <th style="text-align: center">Opciones</th>
                        </tr>

                        @foreach($asistentes as $asistente)
                            <tr class="warning" metho>
                                <td>{{$asistente->id}}</td>
                                <td>{{$asistente->ci}}</td>
                                <td>{{$asistente->nombre}}</td>
                                <td>{{$asistente->apellido}}</td>
                                <td align="center">
                                    {!!Form::model($asistente,['route'=> ['asistencia.destroy',$asistente->id],'method'=>'DELETE'])!!}
                                    <a href="{{ route('asistencia.edit',$asistente->id) }}" class="btn btn-warning"
                                       aria-label="Skip to main navigation">
                                        <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                    </a>
                                    <button class="btn btn-danger" type="submit"
                                            data-toggle="confirmation"
                                            data-placement="left"
                                            data-title='¿Seguro quieres eliminar este miembro de la sistecia?'
                                            data-btnOkClass="btn btn-primary"
                                            data-btnOkLabel='<i class="fa fa-check-circle"></i> Si'
                                            data-btnCancelClass="btn btn-default"
                                            data-btnCancelLabel='<i class="fa fa-times-circle" aria-hidden="true"></i> No'>
                                        <i class="fa fa-trash-o" aria-hidden="true"></i>
                                    </button>
                                    {!! Form::close() !!}
                                </td>
                            </tr>
                        @endforeach
                    </table>
                    {{$asistentes->links()}}
                </div>
            @else
                <div class="panel panel-default">
                    <div class="panel-body">
                        <h3 style="text-align: center;">
                            <b style="text-align: center;">No existe ninguna asistencia aun...</b>
                        </h3>
                    </div>
                </div>
            @endif
        </div>
    </div>
    <div class="form-group" align="center">
        <a href="{{ route('agregarAsistecia',$idInforme) }}" class="btn btn-primary btn-lg btn-block">
            <strong>Agregar Nuevo Asistente</strong>
        </a>
    </div>
@endsection
@section('script')
  <script type="text/javascript">
    $('#search').on('keyup',function(){
      $value = $(this).val();
      $.ajax({
        type : 'GET',
        url : "{{url('asistencia/searchAsistencia/')}}",
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
      asistencia(page,$('#search').val());
    });

    function asistencia(page, search){
      var url = "{{url('asistencia/asistenciaPaginateSearch/')}}";
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