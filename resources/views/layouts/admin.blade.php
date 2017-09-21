<!DOCTYPE html>
<html lang="en">
<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Sistema de Informacion Iglesia Luz de Victoria</title>
  <title>SB Admin 2 - Bootstrap Admin Theme</title>

  {!!Html::style('css/bootstrap.min.css')!!}
  {!!Html::style('css/metisMenu.min.css')!!}
  {!!Html::style('css/bootstrap-datetimepicker.min.css')!!}
  {!!Html::style('css/sb-admin-2.css')!!}
  {!!Html::style('css/myStyle.css')!!}
  {!!Html::style('css/ie8.css')!!}
  {!!Html::style('css/font-awesome.min.css')!!}
  {!!Html::style('css/bootstrap-responsive.css')!!}
  {!!Html::style('css/bootstrap-timepicker.min.css')!!}
</head>

<body>
<div id="wrapper">

  <nav  class="navbar navbar-default navbar-fixed-top" role="navigation" style="margin-bottom: 0">
    <!-- Aqui el nav o cabezera -->
    
    <!-- Lado Izquierdo -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="{{ url('/home') }}"> Iglesia Luz De Victoria</a>
    </div>
    <!-- Fin del Lado Izquierdo -->

    <!-- Lado Derecho -->
    <ul class="nav navbar-top-links navbar-right">

      <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
          {{ Auth::user()->name }} <i class="fa fa-user fa-fw"></i><i class="fa fa-caret-down"></i>
        </a>

        <ul class="dropdown-menu dropdown-user">

          <li>
            <a href="{{ url('/login') }}"><i class="fa fa-gear fa-fw"></i> Registrar</a>
          </li>

          <li class="divider"></li>

          <li>
            <a href="{{ url('/login') }}"
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
              <i class="fa fa-sign-out fa-fw"></i> Logout
            </a>

            <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
              {{ csrf_field() }}
            </form>
          </li>

        </ul>
      </li>
    </ul>
    <!-- Fin Lado Derecho -->
    <!-- Aqui Finaliza el nav o cabezera -->


    <div class="navbar-default sidebar" role="navigation">
      <div class="sidebar-nav navbar-collapse">
        <ul class="nav" id="side-menu">

          <!-- *************************************-->
          <!-- * G E S T I O N  D E  P E R S O N A *-->
          <!-- *************************************-->
          <li>
            <a href="#">
              <i class="fa fa-users fa-fw"></i> Gestion de Personas<span class="fa arrow"></span>
            </a>

            <ul class="nav nav-second-level">
              <li>
                <a href="{{ url('/persona/create') }}">
                  <i class="fa fa-user-plus" aria-hidden="true"></i> Agregar Persona
                </a>
              </li>

              <li>
                <a href="{{ url('persona/personas') }}">
                  <i class='fa fa-list-ol fa-fw'></i> Lista de Personas
                </a>
              </li>

              <li>
                <a href="{{ url('persona/noMiembros') }}">
                  <i class='fa fa-list-ol fa-fw'></i> Lista de No Miembros
                </a>
              </li>
            </ul>
          </li>

          <!-- ***************************************-->
          <!-- * G E S T I O N  D E  M I E M B R O S *-->
          <!-- ***************************************-->
          <li>
            <a href="#">
              <i class="fa fa-users fa-fw"></i> Gestion de Miembros<span class="fa arrow"></span>
            </a>

            <ul class="nav nav-second-level">
              <li>
                <a href="#" style="background-color: #ffffff; border: 1px solid #e7e7e7">
                  <i class="fa fa-users fa-fw"></i> Miembros<span class="fa arrow"></span>
                </a>

                <ul class="nav nav-second-level">
                  <li>
                    <a href="{{ url('/miembro/create')}}"><i class='fa fa-user-plus'></i> Agregar Miembro</a>
                  </li>

                  <li>
                    <a href="{{ url('/miembro')}}"><i class='fa fa-list-ol fa-fw'></i> Lista de Miembros</a>
                  </li>

                  <li>
                    <a href="{{ url('miembro/bautizados')}}"><i class='fa fa-list-ol fa-fw'></i> Lista de Miembros &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;bautizados</a>
                  </li>

                  <li>
                    <a href="{{ url('miembro/noBautizados')}}"><i class='fa fa-list-ol fa-fw'></i> Lista de Miembros no &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;bautizados</a>
                  </li>

                  <li>
                    <a href="{{ url('miembro/conMinisterio')}}"><i class='fa fa-list-ol fa-fw'></i> Lista de Miembros con &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ministerios</a>
                  </li>

                  <li>
                    <a href="{{ url('miembro/sinMinisterio')}}"><i class='fa fa-list-ol fa-fw'></i> Lista de Miembros sin &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ministerio</a>
                  </li>
                </ul>
              </li>

              <li>
                <a href="#" style="background-color: #ffffff; border: 1px solid #e7e7e7">
                  <i class="fa fa-child fa-fw"></i> Bautismos<span class="fa arrow"></span>
                </a>
                <ul class="nav nav-second-level">
                  <li>
                    <a href="{{ url('/bautismo/create')}}">
                      <i class='fa fa-plus fa-fw'></i> Agregar Bautismo
                    </a>
                  </li>

                  <li>
                    <a href="{{ url('/bautismo')}}">
                      <i class='fa fa-list-ol fa-fw'></i> Lista de Bautismos
                    </a>
                  </li>
                </ul>
              </li>

              <li>
                <a href="#" style="background-color: #ffffff; border: 1px solid #e7e7e7">
                  <i class="fa fa-bell" aria-hidden="true"></i> Ministerios<span class="fa arrow"></span>
                </a>
                <ul class="nav nav-second-level">
                  <li>
                    <a href="{{ url('/ministerio/create')}}">
                      <i class='fa fa-plus fa-fw'></i> Agregar Ministerio
                    </a>
                  </li>

                  <li>
                    <a href="{{ url('/ministerio')}}">
                      <i class='fa fa-list-ol fa-fw'></i> Lista de Ministerios
                    </a>
                  </li>
                </ul>
              </li>
            </ul>
          </li>

          <!-- *******************************************-->
          <!-- * G E S T I O N  D E  E N C U E N T R O S *-->
          <!-- *******************************************-->
          <li>
            <a href="#">
              <i class="fa fa-child fa-fw"></i> Gestion de Encuentros<span class="fa arrow"></span>
            </a>

            <ul class="nav nav-second-level">
              <li>
                <a href="{{ url('/encuentro/create')}}">
                  <i class='fa fa-plus fa-fw'></i> Agregar Encuentro
                </a>
              </li>

              <li>
                <a href="{{ url('/encuentro')}}">
                  <i class='fa fa-list-ol fa-fw'></i> Lista de Encuentros
                </a>
              </li>
            </ul>
          </li>

          <!-- *************************************-->
          <!-- * G E S T I O N  D E  C E L U L A S *-->
          <!-- *************************************-->
          <li>
            <a href="#">
              <i class="fa fa-child fa-fw"></i> Gestion de Celulas<span class="fa arrow"></span>
            </a>

            <ul class="nav nav-second-level">
              <li>
                <a href="{{ url('/celula/create')}}">
                  <i class='fa fa-plus fa-fw'></i> Agregar Celula
                </a>
              </li>

              <li>
                <a href="{{ url('/celula')}}">
                  <i class='fa fa-list-ol fa-fw'></i> Lista de Celulas
                </a>
              </li>
            </ul>
          </li>

          <!-- *********************************************************-->
          <!-- * G E S T I O N  D E  E S C U E L A  D E  L I D E R E S *-->
          <!-- *********************************************************-->
          <li>
            <a href="#">
              <i class="fa fa-child fa-fw"></i> G. de Escuelas de Lideres<span class="fa arrow"></span>
            </a>

            <ul class="nav nav-second-level">
              <li>
                <a href="{{ url('escuela/create/') }}">
                  <i class='fa fa-plus fa-fw'></i> Agregar Escuela
                </a>
              </li>

              <li>
                <a href="{{ url('escuela/') }}">
                  <i class='fa fa-server'></i> Listas de Escuelas
                </a>
              </li>

              <li>
                <a href="{{ url('boleta/create/') }}">
                  <i class='fa fa-book'></i> Inscripcion
                </a>
              </li>

            </ul>
          </li>

          <!-- *****************************************-->
          <!-- * G E S T I O N  D E  R E U N I O N E S *-->
          <!-- *****************************************-->
          <li>
            <a href="#">
              <i class="fa fa-child fa-fw"></i> Gestion de Reuniones <span class="fa arrow"></span>
            </a>

            <ul class="nav nav-second-level">
              <li>
                <a href={{ url('reunion/')}}>
                  <i class='fa fa-list-ol fa-fw'></i> Reuniones
                </a>
              </li>
            </ul>
          </li>

        </ul>
      </div>
    </div>

  </nav>

  <div id="page-wrapper" role="main">
    <br><br>
    @yield('content')
  </div>
</div>
{!!Html::script('js/jquery.min.js')!!}
{!!Html::script('js/bootstrap-tooltip.js')!!}
{!!Html::script('js/bootstrap.min.js')!!}
{!!Html::script('js/bootstrap-datetimepicker.min.js')!!}
{!!Html::script('js/bootstrap-timepicker.min.js')!!}
{!!Html::script('js/metisMenu.min.js')!!}
{!!Html::script('js/sb-admin-2.js')!!}
{!!Html::script('js/bootstrap-confirmation.min.js')!!}

@yield('script')

<script>
  $('[data-toggle="confirmation"]').confirmation({
    href: function(elem){
      return $(elem).attr('href');
    }
  });
</script>

</body>

</html>
