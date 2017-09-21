@extends('layouts.admin')
@section('content')
  <br>
  <div class="panel panel-primary">
    <div class="panel-body">
      @include('layouts.cabezera')  

      <h1 id="cabeza">Miembros que pertenecen a algún Ministerio</h1>

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
            <th>Nombre Ministerio</th>
          </tr>

          @foreach($conMinisterios as $conMinisterio)
          <tr class="warning">
            <td>{{$conMinisterio->ci}}</td>
            <td>{{$conMinisterio->nombre}}</td>
            <td>{{$conMinisterio->apellido}}</td>
            <td>{{$conMinisterio->nombreministerio}}</td>
          </tr>
          @endforeach
        </table>
      {{$conMinisterios->links()}}
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
        url : "{{url('miembro/searchConMinisterio/')}}",
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
      conMinisterio(page,$('#search').val());
    });

    function conMinisterio(page, search){
      var url = "{{url('miembro/conMinisterioPaginateSearch/')}}";
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