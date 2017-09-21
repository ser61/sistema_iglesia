@if (count($bautizados) > 0)
<table class="table table-hover">
  <tr class="info">
    <th>CI</th>
    <th>Nombre</th>
    <th>Apellido</th>
    <th>Lugar</th>
    <th>Fecha</th>
  </tr>

  @foreach($bautizados as $bautizado)
  <tr class="warning">
    <td>{{$bautizado->ci}}</td>
    <td>{{$bautizado->nombre}}</td>
    <td>{{$bautizado->apellido}}</td>
    <td>{{$bautizado->lugar}}</td>
    <td><?php echo Carbon\Carbon::createFromFormat('Y-m-d', $bautizado->fecha)->format('d M Y') ?></td>
  </tr>
  @endforeach
</table>
{{$bautizados->links()}}

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