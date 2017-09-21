@extends('layouts.admin')
@section('content')
  @include('alerts.success')
  @include('alerts.request')
  <br>
  <div class="panel panel-primary">
    <div class="panel-body">
      @include('layouts.cabezera')

      <h1 id="cabeza">Lista de Personas</h1>

      <br>
      <div align="center">
        <h4><strong> Total de Personas: </strong> {{$datos['personas']}}</h4>
      </div><!-- /.col-lg-6 -->
      
      <div class="row" align="center">
        <div class="col-lg-6">
          <p><strong> Total de Miembros: </strong>{{$datos['miembros']}}</p>
        </div><!-- /.col-lg-6 -->
        <div class="col-lg-6">
          <p><strong> Total de No miembros: </strong>{{$datos['noMiembros']}}</p>
        </div><!-- /.col-lg-6 -->
      </div><!-- /.row -->
      
      <div class="row" align="center">
        <div class="col-lg-3">
          <p><strong> Total de Hombres: </strong>{{$datos['hombresM']}}</p>
        </div><!-- /.col-lg-6 -->
        <div class="col-lg-3">
          <p><strong> Total de Mujeres: </strong>{{$datos['mujeresM']}}</p>
        </div><!-- /.col-lg-6 -->
        <div class="col-lg-3">
          <p><strong> Total de Hombres: </strong>{{$datos['hombresN']}}</p>
        </div><!-- /.col-lg-6 -->
        <div class="col-lg-3">
          <p><strong> Total de Mujeres: </strong>{{$datos['mujeresN']}}</p>
        </div><!-- /.col-lg-6 -->
      </div><!-- /.row -->

      <div class="row" align="center">
        <div class="col-lg-3">
          <p><strong> Mayores a 30 años: </strong>{{$datos['hombresMayoresM']}}</p>
        </div><!-- /.col-lg-6 -->
        <div class="col-lg-3">
          <p><strong> Mayores a 30 años: </strong>{{$datos['mujeresMayoresM']}}</p>
        </div><!-- /.col-lg-6 -->
        <div class="col-lg-3">
          <p><strong> Mayores a 30 años: </strong>{{$datos['hombresMayoresN']}}</p>
        </div><!-- /.col-lg-6 -->
        <div class="col-lg-3">
          <p><strong> Mayores a 30 años: </strong>{{$datos['mujeresMayoresN']}}</p>
        </div><!-- /.col-lg-6 -->
      </div><!-- /.row -->

      <div class="row" align="center">
        <div class="col-lg-3">
          <p><strong> Menores a 30 años: </strong>{{$datos['hombresJovenesM']}}</p>
        </div><!-- /.col-lg-6 -->
        <div class="col-lg-3">
          <p><strong> Menores a 30 años: </strong>{{$datos['mujeresJovenesM']}}</p>
        </div><!-- /.col-lg-6 -->
        <div class="col-lg-3">
          <p><strong> Menores a 30 años: </strong>{{$datos['hombresJovenesN']}}</p>
        </div><!-- /.col-lg-6 -->
        <div class="col-lg-3">
          <p><strong> Menores a 30 años: </strong>{{$datos['mujeresJovenesN']}}</p>
        </div><!-- /.col-lg-6 -->
      </div><!-- /.row -->
      <br>

      <div class="panel panel-default">
        <div class="panel-body">
          <input type="text" class="form-control" placeholder="Busqueda por nombre, apellido o carnet..." name="search" id="search">
        </div>
      </div>

      <div id="tbody">
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
          @foreach($personas as $persona)
          <tr class="warning">
            <td>{{$persona->ci}}</td>
            <td>{{$persona->nombre}}</td>
            <td>{{$persona->apellido}}</td>
            <td>{{$persona->sexo}}</td>
            <td><?php echo Carbon\Carbon::createFromFormat('Y-m-d', $persona->fechadenacimiento)->format('d M Y') ?></td>
            <td>{{$persona->direccion}}</td>
            <td>{{$persona->lugardenacimiento}}</td>
            <td>{{$persona->estadocivil}}</td>
            <td>{{$persona->gradoinstruccion}}</td>
            <td>{{$persona->tipo}}</td>
            <td>
              <a href="{{ route('persona.edit', $persona->ci) }}" class="btn btn-warning" aria-label="Skip to main navigation">
                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
              </a>
              <a href="{{ route('persona.report', $persona->ci) }}" class="btn btn-success" aria-label="Skip to main navigation">
                <i class="fa fa-eye" aria-hidden="true"></i>
              </a><br><br>
              {!! Form::open(['method'=>'DELETE', 'route'=>['persona.destroy',$persona->ci]]) !!}
                <button class="btn btn-danger" type="submit"
                        data-toggle="confirmation" 
                        data-placement="left" 
                        data-title="¿Quieres continuar eliminando a {{$persona->nombre}}?"
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
        {{$personas->links()}}
      </div>
    </div>
  </div>
  <div class="form-group" align="center">
    <a href="{{ url('persona/generarpdf')}}" class="btn btn-primary btn-lg btn-block" target="_blank">
      <strong>Generar archivo PDF</strong>
    </a>
  </div>
@endsection
@section('script')
  <script type="text/javascript">
    $('#search').on('keyup',function(){
      $value = $(this).val();
      $.ajax({
        type : 'GET',
        url : "{{url('persona/searchPersonas/')}}",
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
      persona(page,$('#search').val());
    });

    function persona(page, search){
      var url = "{{url('persona/PersonasPaginatesearch/')}}";
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