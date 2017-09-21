@extends('layouts.admin')
@section('content')
  @include('alerts.success')
  @include('alerts.request')
  <br>
  <div class="panel panel-primary">
    <div class="panel-body">
      @include('layouts.cabezera')

      <h1 id="cabeza">Lista de No Miembros</h1>

      <br>
      <div class="panel panel-default">
        <div class="panel-body">
          <input type="text" class="form-control" placeholder="Busqueda por nombre, apellido o carnet..." id="search">
        </div>
      </div>

      <div id="body">
        <table class="table table-hover">
          <tr class="info">
            <th>Carnet</th>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Sexo</th>
            <th>Fecha de Nacimiento</th>
            <th>Direccion</th>
            <th>Lugar de Nacimiento</th>
            <th>Estado Civil</th>
            <th>Grado de Instruccion</th>
            <th>Tipo</th>
            <th>Operaciones</th>
          </tr>
          @foreach($noMiembros as $noMiembro)
          <tr class="warning">
            <td>{{$noMiembro->ci}}</td>
            <td>{{$noMiembro->nombre}}</td>
            <td>{{$noMiembro->apellido}}</td>
            <td>{{$noMiembro->sexo}}</td>
            <td><?php echo Carbon\Carbon::createFromFormat('Y-m-d', $noMiembro->fechadenacimiento)->format('d M Y') ?></td>
            <td>{{$noMiembro->direccion}}</td>
            <td>{{$noMiembro->lugardenacimiento}}</td>
            <td>{{$noMiembro->estadocivil}}</td>
            <td>{{$noMiembro->gradoinstruccion}}</td>
            <td>{{$noMiembro->tipo}}</td>
            <td>
              <a href="{{ route('persona.edit', $noMiembro->ci) }}" class="btn btn-warning" aria-label="Skip to main navigation">
                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
              </a>
              <a href="{{ route('persona.report', $noMiembro->ci) }}" class="btn btn-success" aria-label="Skip to main navigation">
                <i class="fa fa-eye" aria-hidden="true"></i>
              </a><br><br>
              {!! Form::open(['method'=>'DELETE', 'route'=>['persona.destroy',$noMiembro->ci]]) !!}
                <button class="btn btn-danger" type="submit"
                        data-toggle="confirmation" 
                        data-placement="left" 
                        data-title="¿Quieres continuar eliminando a {{$noMiembro->nombre}}?"
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
        {{$noMiembros->links()}}
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
          url : "{{url('persona/searchNoMiembros/')}}",
          data : {'search':$value},
        }).done(function(data){
            console.log(data);
            $('#body').html(data);
          })
    });

    $(document).on('click','.pagination a', function(e){
      e.preventDefault();
      var page=$(this).attr('href').split('page=')[1];
      noMiembros(page,$('#search').val());
    });

    function noMiembros(page, search){
      var url = "{{url('persona/searchNoMiembrosPaginate/')}}";
      $.ajax({
        type : 'GET',
        url : url+'?page='+page,
        data : {'search' : search},
      }).done(function(data){
        $('#body').html(data);
      })
    }
  </script>
@endsection