@if (count($noBautizados) > 0)
<table class="table table-hover">
  <tr class="info">
    <th>CI</th>
    <th>Nombre</th>
    <th>Apellido</th>
  </tr>

  @foreach($noBautizados as $bautizado)
  <tr class="warning">
    <td>{{$bautizado->ci}}</td>
    <td>{{$bautizado->nombre}}</td>
    <td>{{$bautizado->apellido}}</td>

  </tr>
  @endforeach
</table>
{{$noBautizados->links()}}
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