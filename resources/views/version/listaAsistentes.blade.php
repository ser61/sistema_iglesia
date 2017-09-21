@extends('layouts.admin')
@section('content')
  @include('alerts.success')
  @include('alerts.request')
  @include('alerts.existfail')
  <br>
  <div class="panel panel-primary">
    <div class="panel-body">
      @include('layouts.cabezera')  

      <h1 id="cabeza">Lista de Asistentes del Encuentro <br/> {{$encuentro['nombre']}} Version {{$id}}</h1>

      <br>
      <div class="panel panel-default">
        <div class="panel-body">
          <input type="text" class="form-control" placeholder="Busqueda por nombre, apellido o carnet..." id="search">
        </div>
      </div>

      <div id="tbody">
        <table class="table table-hover">
          <tr class="info">
            <th>CI del Miembro</th>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Opciones</th>
          </tr>

          @foreach($asistentes as $asistente)
          <tr class="warning">
            <td>{{$asistente->ci}}</td>
            <td>{{$asistente->nombre}}</td>
            <td>{{$asistente->apellido}}</td>
            <td align="center">
              {!! Form::open(['method'=>'DELETE', 'route'=>['Asist.destroy',$id,$asistente->ci,$encuentro->id]]) !!}
                <button class="btn btn-danger" type="submit"
                        data-toggle="confirmation" 
                        data-placement="left" 
                        data-title="¿Seguro quieres quitar a este Miembro?"
                        data-btnOkClass="btn btn-primary"
                        data-btnOkLabel='<i class="fa fa-check-circle"></i> Si'
                        data-btnCancelClass="btn btn-default"
                        data-btnCancelLabel='<i class="fa fa-times-circle" aria-hidden="true"></i> No'>
                  <i class="fa fa-trash-o" aria-hidden="true"></i> Eliminar
                </button>
              {!! Form::close() !!}
            </td>
          </tr>
          @endforeach
        </table>
        {{$asistentes->links()}}
      </div>
    </div>
  </div>
  <div class="form-group" align="center">
    <a href="{{route('addAsistentes',[$id, $encuentro->id]) }}" class="btn btn-primary btn-lg btn-block">
      <strong>Agregar Miembro a la Version</strong>
    </a>
  </div>
@endsection
@section('script')
  <script type="text/javascript">
    $('#search').on('keyup',function(){
      $value = $(this).val();
      $.ajax({
        type : 'GET',
        url : "{{url('versiones/searchAsistentes/')}}",
        data : {'search':$value, 'id': {{$id}}, 'encuentro': {{$encuentro->id}} },
        success: function(data){
          console.log(data);
          $('#tbody').html(data);
        }
      });
    });

    $(document).on('click','.pagination a', function(e){
      e.preventDefault();
      var page=$(this).attr('href').split('page=')[1];
      asistente(page,$('#search').val());
    });

    function asistente(page, search){
      var url = "{{url('versiones/asistentesPaginateSearch/')}}";
      $.ajax({
        type : 'GET',
        url : url+'?page='+page,
        data : {'search' : search, 'id': {{$id}}, 'encuentro': {{$encuentro->id}} },
      }).done(function(data){
        $('#tbody').html(data);
      })
    }
  </script>
@endsection