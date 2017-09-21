@if (count($miembros) > 0)
  <table class="table table-hover">
    <tr class="info">
      <th>CI</th>
      <th>Nombre</th>
      <th>Apellido</th>
    </tr>

    @foreach($miembros as $miembro)
      <tr class="warning">
        <td>{{$miembro->ci}}</td>
        <td>{{$miembro->nombre}}</td>
        <td>{{$miembro->apellido}}</td>
      </tr>
    @endforeach
  </table>
  {{$miembros->links()}}

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