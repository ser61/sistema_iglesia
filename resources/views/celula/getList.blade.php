@if (count($celulas) > 0)
    <table class="table table-hover">
        <tr class="info">
            <th>Nro de Celula</th>
            <th>Creacion</th>
            <th>CI - Lider</th>
            <th>Nombre - Lider</th>
            <th>Apellido - Lider</th>
            <th>Informes</th>
            <th style="text-align: center">Opciones</th>
        </tr>

        @foreach($celulas as $celula)
            <tr class="warning" metho>
                <td>{{$celula->numero}}</td>
                <td><?php echo Carbon\Carbon::createFromFormat('Y-m-d', $celula->fechadecreacion)->format('d M Y') ?></td>
                <td>{{$celula->ci}}</td>
                <td>{{$celula->nombre}}</td>
                <td>{{$celula->apellido}}</td>
                <td>{{$celula->informenes}}</td>
                <td align="center">
                    {!!Form::model($celula,['route'=> ['celula.destroy',$celula->numero],'method'=>'DELETE'])!!}
                    <a href="{{ route('celula.edit',$celula->numero) }}" class="btn btn-warning" aria-label="Skip to main navigation">
                        <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                    </a>
                    <button class="btn btn-danger" type="submit"
                            data-toggle="confirmation"
                            data-placement="left"
                            data-title='¿Seguro quieres eliminar esta celula?'
                            data-btnOkClass="btn btn-primary"
                            data-btnOkLabel='<i class="fa fa-check-circle"></i> Si'
                            data-btnCancelClass="btn btn-default"
                            data-btnCancelLabel='<i class="fa fa-times-circle" aria-hidden="true"></i> No'>
                        <i class="fa fa-trash-o" aria-hidden="true"></i>
                    </button>
                    <a href="{{ route('celula.mostrar',[$celula->numero, $celula->ci]) }}" class="btn btn-success" aria-label="Skip to main navigation">
                        <i class="fa fa-eye" aria-hidden="true"></i> Informes
                    </a>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
    </table>
    {{$celulas->links()}}

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