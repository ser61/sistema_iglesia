@extends('layouts.admin')
@section('content')
  @include('alerts.success')
  @include('alerts.request')
  @include('alerts.existfail')
  <br>
  <h1 id="cabeza"></h1>
  <div class="panel panel-primary">
  <div class="panel-heading" align="center" style="font-size: 20px">
    <strong>Formulario para agregar Asistente al Encuentro <br/> {{$encuentro->nombre}} Version {{$version->id}}</strong>
  </div>
  <div class="panel-body">
      {!! Form::open(
        ['route' => ['guardarAsistente',$version['id'], $encuentro['id'], $version['fecha'], $version['lugar']],
        'method' => 'POST']) !!}
      <br><br>
      <div class="form-group">
          {!! Form::label('Carnet del miembro:') !!}
          {!! Form::number('cimiembro',null,['class'=>'form-control','placeholder'=>'Ingresa el carnet de identidad del miembro...']) !!}    
          <span class="col-lg-6" style="color: #ff0000;">Dato obligatorio</span>
      </div>
      <br><br>
      <div class="form-group" align="center">
        {!! Form::submit('Agregar Asistente' , ['class'=>'btn btn-primary btn-lg btn-block']) !!}
      </div>      
      {!! Form::close() !!}  
  </div>
</div>
<div class="panel panel-primary">
  <div class="panel-heading" align="center" style="font-size: 20px">
      <strong>Lista de Habilitados Para <br/> {{$encuentro->nombre}} Version {{$version->id}}</strong>
  </div>
  <div class="panel-body">
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
                url : "{{url('versiones/searchHabilitados/')}}",
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
            var url = "{{url('versiones/habilitadosPaginateSearch/')}}";
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