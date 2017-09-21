@if (count($habilitados) > 0)
    <table class="table table-hover">
        <tr class="info">
            <th>CI</th>
            <th>Nombre</th>
            <th>Apellido</th>
        </tr>

        @foreach($habilitados as $habilitado)
            <tr class="warning">
                <td>{{$habilitado->ci}}</td>
                <td>{{$habilitado->nombre}}</td>
                <td>{{$habilitado->apellido}}</td>
            </tr>
        @endforeach
    </table>
    {{$habilitados->links()}}

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