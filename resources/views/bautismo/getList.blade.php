@if (count($bautismos) > 0)
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