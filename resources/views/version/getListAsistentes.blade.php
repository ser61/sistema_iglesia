@if (count($asistentes) > 0)
    <table class="table table-hover">
        <tr class="info">
            <th>CI del Miembro</th>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Opciones</th>
        </tr>

        @foreach($asistentes as $asistente)
            <tr class="warning">
                <td>{{$asistente->ci}}</td>
                <td>{{$asistente->nombre}}</td>
                <td>{{$asistente->apellido}}</td>
                <td align="center">
                    {!! Form::open(['method'=>'DELETE', 'route'=>['Asist.destroy',$id,$asistente->ci,$encuentro->id]]) !!}
                    <button class="btn btn-danger" type="submit"
                            data-toggle="confirmation"
                            data-placement="left"
                            data-title="¿Seguro quieres quitar a este Miembro?"
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
    {{$asistentes->links()}}

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