@if (count($encuentros) > 0)
<table class="table table-hover">
  <tr class="info">
    <th width="220px">ID del Encuentro</th>
    <th width="220px">Nombre del Encuentro</th>
    <th style="text-align: center;">Opciones</th>
  </tr>

  @foreach($encuentros as $encuentro)
  <tr class="warning">
    <td>{{$encuentro->id}}</td>
    <td>{{$encuentro->nombre}}</td>
    <td align="center">
      {!! Form::open(['method'=>'DELETE', 'route'=>['encuentro.destroy',$encuentro->id]]) !!}
        <a href="{{route('encuentro.edit',$encuentro->id)}}" class="btn btn-warning">
          <i class="fa fa-pencil-square-o" aria-hidden="true"></i> 
        </a>
        <button class="btn btn-danger" type="submit"
                data-toggle="confirmation" 
                data-placement="left" 
                data-title="¿SEGURO QUIERE CONTINUAR? LOS REQUISITOS Y LAS VERSIONES SERAN ELIMINADAS TAMBIEN!!!"
                data-btnOkClass="btn btn-primary"
                data-btnOkLabel='<i class="fa fa-check-circle"></i> Si'
                data-btnCancelClass="btn btn-default"
                data-btnCancelLabel='<i class="fa fa-times-circle" aria-hidden="true"></i> No'>
          <i class="fa fa-trash-o" aria-hidden="true"></i> 
        </button>
        <a href="{{route('prerequisito.lista',$encuentro->id)}}" 
          class="btn btn-success" aria-label="Skip to main navigation">
          <i class="fa fa-eye" aria-hidden="true"></i> Requisitos
        </a>
        <a href="{{route('versiones.lista',$encuentro->id)}}" class="btn btn-info" aria-label="Skip to main navigation">
          <i class="fa fa-eye" aria-hidden="true"></i> Version
        </a>
        <a href="{{route('encuentro.habilitados',$encuentro->id)}}" class="btn btn-default" 
            aria-label="Skip to main navigation" style="background-color: #c7bb85;">
          <i class="fa fa-eye" aria-hidden="true"></i> Habilitados
        </a>
      {!! Form::close() !!}
    </td>
  </tr>
  @endforeach
</table>
{{$encuentros->links()}}

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