@if (count($sinMinisterios) > 0)
<table class="table table-hover">
  <tr class="info">
    <th>CI</th>
    <th>Nombre</th>
    <th>Apellido</th>
  </tr>

  @foreach($sinMinisterios as $sinMinisterio)
  <tr class="warning">
    <td>{{$sinMinisterio->ci}}</td>
    <td>{{$sinMinisterio->nombre}}</td>
    <td>{{$sinMinisterio->apellido}}</td>

  </tr>
  @endforeach
</table>
{{$sinMinisterios->links()}}

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