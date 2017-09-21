@if (count($versiones) > 0)
    <table class="table table-hover">
        <tr class="info">
            <th>Version del Encuentro</th>
            <th>Fecha del Encuentro</th>
            <th>Lugar del Encuentro</th>
            <th>Opciones</th>
        </tr>

        @foreach($versiones as $version)
            <tr class="warning">
                <td>{{$version->version}}</td>
                <td><?php echo Carbon\Carbon::createFromFormat('Y-m-d', $version->fecha)->format('d M Y') ?></td>
                <td>{{$version->lugar}}</td>
                <td align="center">
                    {!! Form::open(['method'=>'DELETE', 'route'=>['versiones.destroy',$version->version, $encuentro->id]]) !!}
                    <a href="{{route('versiones.editar',[$version->version, $encuentro->id]) }}" class="btn btn-warning">
                        <i class="fa fa-pencil-square-o" aria-hidden="true"></i> Editar
                    </a>
                    <button class="btn btn-danger" type="submit"
                            data-toggle="confirmation"
                            data-placement="left"
                            data-title="¿Seguro quieres eliminar esta Version?"
                            data-btnOkClass="btn btn-primary"
                            data-btnOkLabel='<i class="fa fa-check-circle"></i> Si'
                            data-btnCancelClass="btn btn-default"
                            data-btnCancelLabel='<i class="fa fa-times-circle" aria-hidden="true"></i> No'>
                        <i class="fa fa-trash-o" aria-hidden="true"></i> Eliminar
                    </button>
                    <a href="{{route('asistentes',[$version->version, $encuentro->id]) }}" class="btn btn-info"
                       aria-label="Skip to main navigation">
                        <i class="fa fa-eye" aria-hidden="true"></i> Asistentes
                    </a>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
    </table>
    {{$versiones->links()}}

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