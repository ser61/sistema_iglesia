@extends('layouts.admin')
@section('content')
  @include('alerts.success')
  @include('alerts.request')
  <br>
  <div class="panel panel-primary">
    <div class="panel-body">
      @include('layouts.cabezera')  

      <h1 id="cabeza">Lista de Encuentros</h1>

      <br>
      <div class="panel panel-default">
        <div class="panel-body">
          <input type="text" class="form-control" placeholder="Busqueda por id o nombre del encuentro..." id="search">
        </div>
      </div>

      <div id="tbody">
        <table class="table table-hover">
          <tr class="info">
            <th width="220px">ID del Encuentro</th>
            <th width="220px">Nombre del Encuentro</th>
            <th style="text-align: center;">Opciones</th>
          </tr>

          @foreach($encuentros as $encuentro)
          <tr class="warning">
            <td>{{$encuentro->id}}</td>
            <td>{{$encuentro->nombre}}</td>
            <td align="center">
              {!! Form::open(['method'=>'DELETE', 'route'=>['encuentro.destroy',$encuentro->id]]) !!}
                <a href="{{route('encuentro.edit',$encuentro->id)}}" class="btn btn-warning">
                  <i class="fa fa-pencil-square-o" aria-hidden="true"></i> 
                </a>
                <button class="btn btn-danger" type="submit"
                        data-toggle="confirmation" 
                        data-placement="left" 
                        data-title="¿SEGURO QUIERE CONTINUAR? LOS REQUISITOS Y LAS VERSIONES SERAN ELIMINADAS TAMBIEN!!!"
                        data-btnOkClass="btn btn-primary"
                        data-btnOkLabel='<i class="fa fa-check-circle"></i> Si'
                        data-btnCancelClass="btn btn-default"
                        data-btnCancelLabel='<i class="fa fa-times-circle" aria-hidden="true"></i> No'>
                  <i class="fa fa-trash-o" aria-hidden="true"></i> 
                </button>
                <a href="{{route('prerequisito.lista',$encuentro->id)}}" 
                  class="btn btn-success" aria-label="Skip to main navigation">
                  <i class="fa fa-eye" aria-hidden="true"></i> Requisitos
                </a>
                <a href="{{route('versiones.lista',$encuentro->id)}}" class="btn btn-info" aria-label="Skip to main navigation">
                  <i class="fa fa-eye" aria-hidden="true"></i> Version
                </a>
                <a href="{{route('encuentro.habilitados',$encuentro->id)}}" class="btn btn-default" 
                    aria-label="Skip to main navigation" style="background-color: #c7bb85;">
                  <i class="fa fa-eye" aria-hidden="true"></i> Habilitados
                </a>
              {!! Form::close() !!}
            </td>
          </tr>
          @endforeach
        </table>
        {{$encuentros->links()}}
      </div>
    </div>
  </div>
@endsection
@section('script')
  <script type="text/javascript">
    $('#search').on('keyup',function(){
      $value = $(this).val();
      $.ajax({
        type : 'GET',
        url : "{{url('encuentro/searchEncuentro/')}}",
        data : {'search':$value},
        success: function(data){
          console.log(data);
          $('#tbody').html(data);
        }  
      });
    });

    $(document).on('click','.pagination a', function(e){
      e.preventDefault();
      var page=$(this).attr('href').split('page=')[1];
      encuentro(page,$('#search').val());
    });

    function encuentro(page, search){
      var url = "{{url('encuentro/encuentroPaginateSearch/')}}";
      $.ajax({
        type : 'GET',
        url : url+'?page='+page,
        data : {'search' : search},
      }).done(function(data){
        $('#tbody').html(data);
      })
    }
  </script>
@endsection
