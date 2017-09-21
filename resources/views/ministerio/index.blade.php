@extends('layouts.admin')
@section('content')
  @include('alerts.success')
  @include('alerts.request')
  <br>
  <div class="panel panel-primary">
    <div class="panel-body">
      @include('layouts.cabezera')  

      <h1 id="cabeza">Lista de Ministerios</h1>

      <br>
      <div class="panel panel-default">
        <div class="panel-body">
          <input type="text" class="form-control" placeholder="Busqueda por el id o el nombre del ministerio..." id="search">
        </div>
      </div>

      <div id="tbody">
        <table class="table table-hover">
          <tr class="info">
            <th>ID de Ministerio</th>
            <th>Nombre de Ministerio</th>
            <th>Operaciones</th>
          </tr>

          @foreach($ministerios as $ministerio)
          <tr class="warning">
            <td>{{$ministerio->id}}</td>
            <td>{{$ministerio->nombre}}</td>
            <td>
              {!! Form::open(['method'=>'DELETE', 'route'=>['ministerio.destroy',$ministerio->id]]) !!}
                <a href="{{route('ministerio.edit',$ministerio->id)}}" class="btn btn-warning">
                  <i class="fa fa-pencil-square-o" aria-hidden="true"></i> Editar
                </a>
                <button class="btn btn-danger" type="submit"
                        data-toggle="confirmation" 
                        data-placement="left" 
                        data-title="¿Seguro quieres eliminar este Bautismo?"
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
        url : "{{url('ministerio/searchMinisterio/')}}",
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
      ministerio(page,$('#search').val());
    });

    function ministerio(page, search){
      var url = "{{url('ministerio/ministerioPaginateSearch/')}}";
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