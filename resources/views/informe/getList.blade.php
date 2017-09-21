@if (count($informes) > 0)
  <table class="table table-hover">
    <tr class="info">
      <th>Id de Informe</th>
      <th>Fecha</th>
      <th>Nro Nuevos</th>
      <th>Nro Visitas</th>
      <th>Ofrenda</th>
      <th style="text-align: center">Opciones</th>
    </tr>

    @foreach($informes as $informe)
      <tr class="warning" metho>
        <td>{{$informe->id}}</td>
        <td><?php echo Carbon\Carbon::createFromFormat('Y-m-d', $informe->fecha)->format('d M Y') ?></td>
        <td>{{$informe->nronuevos}}</td>
        <td>{{$informe->visitas}}</td>
        <td>{{$informe->ofrenda}}</td>
        <td align="center">
          {!!Form::model($informe,['route'=> ['informe.destroy',$informe->id],'method'=>'DELETE'])!!}
          <a href="{{ route('informe.editar',[$informe->id, $nrocelula]) }}" class="btn btn-warning"
             aria-label="Skip to main navigation">
            <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
          </a>
          <button class="btn btn-danger" type="submit"
                  data-toggle="confirmation"
                  data-placement="left"
                  data-title='¿Seguro quieres eliminar este informe?'
                  data-btnOkClass="btn btn-primary"
                  data-btnOkLabel='<i class="fa fa-check-circle"></i> Si'
                  data-btnCancelClass="btn btn-default"
                  data-btnCancelLabel='<i class="fa fa-times-circle" aria-hidden="true"></i> No'>
            <i class="fa fa-trash-o" aria-hidden="true"></i>
          </button>
          <a href="{{ route('informe.show',$informe->id) }}" class="btn btn-success"
             aria-label="Skip to main navigation">
            <i class="fa fa-eye" aria-hidden="true"></i> Asistentes
          </a>
          {!! Form::close() !!}
        </td>
      </tr>
    @endforeach
  </table>
  {{$informes->links()}}

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