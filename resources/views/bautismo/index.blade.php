@extends('layouts.admin')
@section('content')
  @include('alerts.success')
  @include('alerts.request')
  <br>
  <div class="panel panel-primary">
    <div class="panel-body">
      @include('layouts.cabezera')  

      <h1 id="cabeza">Lista de Bautismo</h1>

      <br>
      <div class="panel panel-default">
        <div class="panel-body">
          <input type="text" class="form-control" placeholder="Busqueda por id o lugar del bautismo..." id="search">
        </div>
      </div>

      <div id="tbody">
        <table class="table table-hover">
          <tr class="info">
            <th>ID</th>
            <th>Fecha</th>
            <th>Lugar</th>
            <th>Operaciones</th>
          </tr>

          @foreach($bautismos as $bautismo)
          <tr class="warning">
            <td>{{$bautismo->id}}</td>
            <td><?php echo Carbon\Carbon::createFromFormat('Y-m-d', $bautismo->fecha)->format('d M Y') ?></td>
            <td>{{$bautismo->lugar}}</td>
            <td align="center">
              {!! Form::open(['method'=>'DELETE', 'route'=>['bautismo.destroy',$bautismo->id]]) !!}
                <a href="{{route('bautismo.edit',$bautismo->id)}}" class="btn btn-warning">
                  <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                </a>
                <button class="btn btn-danger" type="submit"
                        data-toggle="confirmation" 
                        data-placement="left" 
                        data-title="¿Seguro quieres eliminar este Bautismo?"
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
        {{$bautismos->links()}}
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
        url : "{{url('bautismo/searchBautismo/')}}",
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
      bautismo(page,$('#search').val());
    });

    function bautismo(page, search){
      var url = "{{url('bautismo/bautismoPaginateSearch/')}}";
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