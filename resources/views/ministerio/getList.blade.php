@if (count($ministerios) > 0)
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