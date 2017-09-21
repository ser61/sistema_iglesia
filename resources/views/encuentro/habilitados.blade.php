@extends('layouts.admin')
@section('content')
  <br>
  <div class="panel panel-primary">
    <div class="panel-body">
      @include('layouts.cabezera')  

      <h1 id="cabeza">Lista de Habilitados del Encuentro {{$encuentro['nombre']}}</h1>

      <br>
      @if(count($habilitados) > 0)
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

            @foreach($habilitados as $habilitado)
            <tr class="warning">
              <td>{{$habilitado->ci}}</td>
              <td>{{$habilitado->nombre}}</td>
              <td>{{$habilitado->apellido}}</td>
            </tr>
            @endforeach
          </table>
          {{$habilitados->links()}}
        </div>
      @else
        <br>
        <div class="panel panel-default">
          <div class="panel-body">
            <h3 style="text-align: center;">
              <b style="text-align: center;">{{$encuentro['nombre']}} no tiene ninguna habilitado...</b>
            </h3>
          </div>
        </div>
      @endif
    </div>
  </div>
@endsection
@section('script')
  <script type="text/javascript">
    $('#search').on('keyup',function(){
      $value = $(this).val();
      $.ajax({
        type : 'GET',
        url : "{{url('encuentro/searchHabilitados/')}}",
        data : {'search':$value, 'encuentro':{{$encuentro->id}} },
        success: function(data){
          console.log(data);
          $('#tbody').html(data);
        }
      });
    });

    $(document).on('click','.pagination a', function(e){
      e.preventDefault();
      var page=$(this).attr('href').split('page=')[1];
      habilitados(page,$('#search').val());
    });

    function habilitados(page, search){
      var url = "{{url('encuentro/habilitadosPaginateSearch/')}}";
      $.ajax({
        type : 'GET',
        url : url+'?page='+page,
        data : {'search' : search, 'encuentro':{{$encuentro->id}} },
      }).done(function(data){
        $('#tbody').html(data);
      })
    }
  </script>
@endsection