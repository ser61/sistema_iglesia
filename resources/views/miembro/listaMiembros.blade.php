@extends('layouts.admin')
@section('content')
  @include('alerts.success')
  @include('alerts.request')
  <br>
  <div class="panel panel-primary">
    <div class="panel-body">
      @include('layouts.cabezera')

      <h1 id="cabeza">Lista de Miembros</h1>

      <br>

      <div class="panel panel-default">
        <div class="panel-body">
          <input type="text" class="form-control" placeholder="Busqueda por nombre, apellido o carnet..." id="search">
        </div>
      </div>
      <div id="tbody">
        <div class="container form-group" style="width: 100%;">
          <div class="table-responsive">
            <table class="table table-hover" style="width: 1000px">
              <tr class="info">
                <th>CI</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Fecha de Converción</th>
                <th>ID de Ministerio</th>
                <th>ID de Bautismo</th>
                <th>Opciones</th>
              </tr>

              @foreach($miembros as $miembro)
                <tr class="warning">
                  <td>{{$miembro->ci}}</td>
                  <td>{{$miembro->nombre}}</td>
                  <td>{{$miembro->apellido}}</td>
                  <td><?php echo Carbon\Carbon::createFromFormat('Y-m-d', $miembro->fechadeconversion)->format('d M Y') ?></td>
                  <td>{{$miembro->idministerio}}</td>
                  <td>{{$miembro->idbautismo}}</td>
                  <td>
                    {!!Form::model($miembro,['route'=> ['miembro.destroy',$miembro->ci],'method'=>'DELETE'])!!}
                    <a href="{{ route('miembro.edit', $miembro->ci) }}" class="btn btn-warning"
                       aria-label="Skip to main navigation">
                      <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                    </a>
                    <button class="btn btn-danger" type="submit"
                            data-toggle="confirmation"
                            data-placement="left"
                            data-title="¿Quieres continuar eliminando a {{$miembro->nombre}}?"
                            data-btnOkClass="btn btn-primary"
                            data-btnOkLabel='<i class="fa fa-check-circle"></i> Si'
                            data-btnCancelClass="btn btn-default"
                            data-btnCancelLabel='<i class="fa fa-times-circle" aria-hidden="true"></i> No'>
                      <i class="fa fa-trash-o" aria-hidden="true"></i>
                    </button>
                    <a href="{{ url('/telefonos',$miembro->ci) }}" class="btn btn-info"
                       aria-label="Skip to main navigation">
                      <i class="fa fa-phone" aria-hidden="true"></i>
                    </a>
                    <a href="{{ url('/trabajos',$miembro->ci) }}" class="btn btn-success"
                       aria-label="Skip to main navigation">
                      <i class="fa fa-briefcase" aria-hidden="true"></i>
                    </a>
                    {!! Form::close() !!}
                  </td>
                </tr>
              @endforeach
            </table>
            {{$miembros->links()}}
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- <div class="form-group" align="center">
    <a href="{{ url('persona/generarpdf')}}" class="btn btn-primary btn-lg btn-block" target="_blank">
      <strong>Generar archivo PDF</strong>
    </a>
  </div> -->
@endsection
@section('script')
  <script type="text/javascript">
    $('#search').on('keyup', function () {
      $value = $(this).val();
      $.ajax({
        type: 'GET',
        url: "{{url('miembro/searchMiembros/')}}",
        data: {'search': $value},
        success: function (data) {
          console.log(data);
          $('#tbody').html(data);
        }
      });
    });

    $(document).on('click', '.pagination a', function (e) {
      e.preventDefault();
      var page = $(this).attr('href').split('page=')[1];
      miembro(page, $('#search').val());
    });

    function miembro(page, search) {
      var url = "{{url('miembro/miembrosPaginateSearch/')}}";
      $.ajax({
        type: 'GET',
        url: url + '?page=' + page,
        data: {'search': search},
      }).done(function (data) {
        $('#tbody').html(data);
      })
    }
  </script>
@endsection