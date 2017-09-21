@extends('layouts.admin')
@section('content')
  @include('alerts.success')
  @include('alerts.request')
  <br>
  <div class="panel panel-primary">
    <div class="panel-body">
      @include('layouts.cabezera')
      <br>
      <h1 id="cabeza">Runiones</h1>
      <br>
      <div class="panel panel-default">
        <div class="panel-body">
          <input type="text" class="form-control" placeholder="Busqueda por nombre de la reunion..." id="search">
        </div>
      </div>

      <div id="tbody">
        <table class="table table-hover">
          <tr class="info">
            <th>Nombre</th>
            <th>Dia</th>
            <th>Hora de Inicio</th>
            <th>Hora Final</th>
            <th style="text-align: center">Opciones</th>
          </tr>

          @foreach($reuniones as $reunion)
            <tr class="warning" metho>
              <td>{{$reunion->nombre}}</td>
              <td>{{$reunion->dia}}</td>
              <td>{{$reunion->horadeinicio}}</td>
              <td>{{$reunion->horadefinal}}</td>
              <td align="center">
                {!!Form::model($reunion,['route'=> ['reunion.destroy',$reunion->id],'method'=>'DELETE'])!!}
                <a href="{{ route('reunion.edit',$reunion->id) }}" class="btn btn-primary" aria-label="Skip to main navigation">
                  <i class="fa fa-pencil-square-o" aria-hidden="true"></i> Editar
                </a>
                <button class="btn btn-danger" type="submit"
                        data-toggle="confirmation"
                        data-placement="left"
                        data-title='¿Seguro quieres elimiar la reunion {{$reunion->nombre}}?'
                        data-btnOkClass="btn btn-primary"
                        data-btnOkLabel='<i class="fa fa-check-circle"></i> Si'
                        data-btnCancelClass="btn btn-default"
                        data-btnCancelLabel='<i class="fa fa-times-circle" aria-hidden="true"></i> No'>
                  <i class="fa fa-trash-o" aria-hidden="true"></i> Eliminar
                </button>
                <a href="{{route('registro.lista', $reunion->id)}}" class="btn btn-success" aria-label="Skip to main navigation">
                   <i class="fa fa-eye" aria-hidden="true"></i> Registros
                </a>
                {!! Form::close() !!}
              </td>
            </tr>
          @endforeach
        </table>
        {{$reuniones->links()}}
      </div>
    </div>
  </div>
  <div class="form-group" align="center">
    <a href="{{ url('reunion/create')}}" class="btn btn-primary btn-lg btn-block">
      <strong>Agregar una Nueva Reunion</strong>
    </a>
  </div>
@endsection
@section('script')
  <script type="text/javascript">
    $('#search').on('keyup',function(){
      $value = $(this).val();
      $.ajax({
        type : 'GET',
        url : "{{url('reunion/searchReunion/')}}",
        data : {'search':$value},
        success: function(data){
          console.log(data);
          $('#tbody').html(data);
        }
      });
    });

    $(document).on('click','.pagination a', function(e){
      e.preventDefault();
      var page=$(this).attr('href').split('page=')[1];
      reunion(page,$('#search').val());
    });

    function reunion(page, search){
      var url = "{{url('reunion/reunionPaginateSearch/')}}";
      $.ajax({
        type : 'GET',
        url : url+'?page='+page,
        data : {'search' : search},
      }).done(function(data){
        $('#tbody').html(data);
      })
    }
  </script>
@endsection