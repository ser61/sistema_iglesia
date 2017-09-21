@extends('layouts.reporte')
@section('content')
<div class="panel panel-primary">
  <div class="panel-body">
	<table class="table" align="center" style="border: 3px solid #286090;">
	  <tr>
        <td style="border-right: 3px solid #286090; padding: 10px;" align="center">
		  {!!Html::image('images/iglesia.png')!!}
		  <p style="text-align: left;">
			<b>Reporte: </b>0001<br>
			<b>Fecha: </b>{{\Carbon\Carbon::now()->toFormattedDateString()}}
		  </p>
		</td>
		<td style="padding-left: 50px;">
		  <p style="vertical-align: middle;">
		  	<br>
		    <b>Pastor: </b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Pr. Ademar Narciso da Silva<br>
			<b>Pastora: </b>&nbsp;&nbsp;&nbsp;Pra. Beatriz Landívar de Narciso <br>
			<b>Teléfono: </b>&nbsp;3-491370<br>
			<b>Email: </b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;luzdevictoria@cotas.com.bo <br>
			<b>Dirección: </b>Canal Cotoca Calle 13 (San Luís Cáceres esq. Las Petas)
		  </p>
		</td>
	  </tr>
	</table>
	<h1 id="cabeza">Reporte de Persona</h1>
	<h2 id="subCabeza">
		{{$persona->nombre}}<br>
		{{$persona->apellido}} <br><br>
	</h2>
	<table id="sergio-tabla" align="center">
	  <tr>
	  	<td>
	      <p id="s-r-persona-datos-I">
		  	<b>Carnet de Identidad: </b> <br>
		    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$persona->ci}} <br><br>
			  
			<b>Nombre(s): </b> <br>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$persona->nombre}} <br><br>

			<b>Apellido(s): </b> <br>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$persona->apellido}} <br><br>

			<b>Sexo: </b> <br>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$persona->sexo}} <br><br>

			<b>Fecha de Nacimiento: </b> <br>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$persona->fechadenacimiento}} <br><br>

			<b>Dirección: </b> <br>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$persona->direccion}} <br><br>
		  </p>
		</td>
		<td>
		  <p id="s-r-persona-datos-D">
		    <b>Lugar de Nacimiento: </b> <br>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$persona->lugardenacimiento}} <br><br>

			<b>Estado Civil: </b> <br>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$persona->estadocivil}} <br><br>

			<b>Grado de Instrucción: </b> <br>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$persona->gradoinstruccion}} <br><br>

			<b>Carnet del Padre: </b> <br>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$persona->cipadre}} <br><br>

			<b>Carnet de la Madre: </b> <br>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$persona->cimadre}} <br><br>

			<b>Tipo: </b> <br>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$persona->tipo}} <br><br>
		  </p>
		</td>
	  </tr>
	</table>
  </div>
</div>
@endsection