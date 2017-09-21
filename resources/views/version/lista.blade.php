@extends('layouts.admin')
@section('content')
  @include('alerts.success')
  @include('alerts.request')
  @include('alerts.existfail')
  <br>
  <div class="panel panel-primary">
    <div class="panel-body">
      @include('layouts.cabezera')  

      <h1 id="cabeza">Lista de Versiones del Encuentro {{$encuentro['nombre']}}</h1>

      <br>
      @if(count($versiones) > 0)
        <div class="panel panel-default">
          <div class="panel-body">
            <input type="text" class="form-control" placeholder="Busqueda por version, lugar o fecha del encuentro..." id="search">
          </div>
        </div>

        <div id="tbody">
          <table class="table table-hover">
            <tr class="info">
              <th>Version del Encuentro</th>
              <th>Fecha del Encuentro</th>
              <th>Lugar del Encuentro</th>
              <th>Opciones</th>
            </tr>

            @foreach($versiones as $version)
            <tr class="warning">
              <td>{{$version->version}}</td>
              <td><?php echo Carbon\Carbon::createFromFormat('Y-m-d', $version->fecha)->format('d M Y') ?></td>
              <td>{{$version->lugar}}</td>
              <td align="center">
                {!! Form::open(['method'=>'DELETE', 'route'=>['versiones.destroy',$version->version, $encuentro->id]]) !!}
                  <a href="{{route('versiones.editar',[$version->version, $encuentro->id]) }}" class="btn btn-warning">
                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i> Editar
                  </a>
                  <button class="btn btn-danger" type="submit"
                          data-toggle="confirmation" 
                          data-placement="left" 
                          data-title="¿Seguro quieres eliminar esta Version?"
                          data-btnOkClass="btn btn-primary"
                          data-btnOkLabel='<i class="fa fa-check-circle"></i> Si'
                          data-btnCancelClass="btn btn-default"
                          data-btnCancelLabel='<i class="fa fa-times-circle" aria-hidden="true"></i> No'>
                    <i class="fa fa-trash-o" aria-hidden="true"></i> Eliminar
                  </button>
                  <a href="{{route('asistentes',[$version->version, $encuentro->id]) }}" class="btn btn-info" 
                      aria-label="Skip to main navigation">
                    <i class="fa fa-eye" aria-hidden="true"></i> Asistentes
                  </a>
                {!! Form::close() !!}
              </td>
            </tr>
            @endforeach
          </table>
          {{$versiones->links()}}
        </div>
      @else
        <br>
        <div class="panel panel-default">
          <div class="panel-body">
              <h3 style="text-align: center;">
                <b style="text-align: center;">{{$encuentro['nombre']}} no tiene ninguna version...</b>
              </h3>
          </div>
        </div>
      @endif
    </div>
  </div>
  <div class="form-group" align="center">
    <a href="{{route('versiones.agregar',[$encuentro->id]) }}" class="btn btn-primary btn-lg btn-block">
      <strong>Agregar Nueva Version</strong>
    </a>
  </div>
@endsection
@section('script')
    <script type="text/javascript">
        $('#search').on('keyup',function(){
            $value = $(this).val();
            $.ajax({
                type : 'GET',
                url : "{{url('versiones/searchVersiones/')}}",
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
            version(page,$('#search').val());
        });

        function version(page, search){
            var url = "{{url('versiones/versionesPaginateSearch/')}}";
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