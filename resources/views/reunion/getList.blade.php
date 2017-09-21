@if (count($reuniones) > 0)
  <table class="table table-hover">
    <tr class="info">
      <th>Nombre</th>
      <th>Dia</th>
      <th>Hora de Inicio</th>
      <th>Hora Final</th>
      <th style="text-align: center">Opciones</th>
    </tr>

    @foreach($reuniones as $reunion)
      <tr class="warning" metho>
        <td>{{$reunion->nombre}}</td>
        <td>{{$reunion->dia}}</td>
        <td>{{$reunion->horadeinicio}}</td>
        <td>{{$reunion->horadefinal}}</td>
        <td align="center">
          {!!Form::model($reunion,['route'=> ['reunion.destroy',$reunion->id],'method'=>'DELETE'])!!}
          <a href="{{ route('reunion.edit',$reunion->id) }}" class="btn btn-primary" aria-label="Skip to main navigation">
            <i class="fa fa-pencil-square-o" aria-hidden="true"></i> Editar
          </a>
          <button class="btn btn-danger" type="submit"
                  data-toggle="confirmation"
                  data-placement="left"
                  data-title='¿Seguro quieres elimiar la reunion {{$reunion->nombre}}?'
                  data-btnOkClass="btn btn-primary"
                  data-btnOkLabel='<i class="fa fa-check-circle"></i> Si'
                  data-btnCancelClass="btn btn-default"
                  data-btnCancelLabel='<i class="fa fa-times-circle" aria-hidden="true"></i> No'>
            <i class="fa fa-trash-o" aria-hidden="true"></i> Eliminar
          </button>
          <a href="{{route('registro.lista', $reunion->id)}}" class="btn btn-success" aria-label="Skip to main navigation">
            <i class="fa fa-eye" aria-hidden="true"></i> Registros
          </a>
          {!! Form::close() !!}
        </td>
      </tr>
    @endforeach
  </table>
  {{$reuniones->links()}}

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