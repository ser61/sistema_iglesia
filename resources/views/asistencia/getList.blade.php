@if (count($asistentes) > 0)
  <table class="table table-hover">
    <tr class="info">
      <th>Id de la Asistencia</th>
      <th>CI del miembro</th>
      <th>Nombre</th>
      <th>Apellido</th>
      <th style="text-align: center">Opciones</th>
    </tr>

    @foreach($asistentes as $asistente)
      <tr class="warning" metho>
        <td>{{$asistente->id}}</td>
        <td>{{$asistente->ci}}</td>
        <td>{{$asistente->nombre}}</td>
        <td>{{$asistente->apellido}}</td>
        <td align="center">
          {!!Form::model($asistente,['route'=> ['asistencia.destroy',$asistente->id],'method'=>'DELETE'])!!}
          <a href="{{ route('asistencia.edit',$asistente->id) }}" class="btn btn-warning"
             aria-label="Skip to main navigation">
            <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
          </a>
          <button class="btn btn-danger" type="submit"
                  data-toggle="confirmation"
                  data-placement="left"
                  data-title='¿Seguro quieres eliminar este miembro de la sistecia?'
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
  {{$asistentes->links()}}

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