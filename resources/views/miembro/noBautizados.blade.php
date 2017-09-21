@extends('layouts.admin')
@section('content')
  <br>
  <div class="panel panel-primary">
    <div class="panel-body">
      @include('layouts.cabezera')  

      <h1 id="cabeza">Lista de Miembros No Bautizados</h1>

      <br>
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

          @foreach($noBautizados as $bautizado)
          <tr class="warning">
            <td>{{$bautizado->ci}}</td>
            <td>{{$bautizado->nombre}}</td>
            <td>{{$bautizado->apellido}}</td>

          </tr>
          @endforeach
        </table>
        {{$noBautizados->links()}}
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
        url : "{{url('miembro/searchNoBautizados/')}}",
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
      noBautizados(page,$('#search').val());
    });

    function noBautizados(page, search){
      var url = "{{url('miembro/noBautizadosPaginateSearch/')}}";
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