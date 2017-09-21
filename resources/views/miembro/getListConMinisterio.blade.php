@if (count($conMinisterios) > 0)
<table class="table table-hover">
  <tr class="info">
    <th>CI</th>
    <th>Nombre</th>
    <th>Apellido</th>
    <th>Nombre Ministerio</th>
  </tr>

  @foreach($conMinisterios as $conMinisterio)
  <tr class="warning">
    <td>{{$conMinisterio->ci}}</td>
    <td>{{$conMinisterio->nombre}}</td>
    <td>{{$conMinisterio->apellido}}</td>
    <td>{{$conMinisterio->nombreministerio}}</td>
  </tr>
  @endforeach
</table>
{{$conMinisterios->links()}}

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