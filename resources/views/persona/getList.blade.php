@if (count($personas) > 0)
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

<script>
   $('[data-toggle="confirmation"]').confirmation({
      href: function(elem){
      return $(elem).attr('href');
      }
    });
</script>
@else
  <br>
  <div class="panel panel-default">
    <div class="panel-body">
        <h3 style="text-align: center;">
          <b style="text-align: center;">{{$search}}</b> no fue encontrado.
        </h3>
    </div>
  </div>
@endif