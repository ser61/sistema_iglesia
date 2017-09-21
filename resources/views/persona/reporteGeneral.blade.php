<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
    {!!Html::style('css/myStyle.css')!!}
</head>
<style type="text/css">
.ser-tabla {
    border-collapse: collapse;
}

.ser-tabla, .ser-th, .ser-td {
    border: 1px solid black;
}
.ser-data{
	text-align: center;
}
.anch-tb{
	width: 100%;
}
</style>
<body>

      <table class="anch-tb" align="center" style="border: 3px solid #286090;">
        <tr>
          <td style="border-right: 3px solid #286090; padding: 3px;" align="center">
            {!!Html::image('images/iglesia.png')!!}
            <p style="text-align: left;">
            <b>&nbsp;&nbsp;Reporte: </b>0001<br>
            <b>&nbsp;&nbsp;Fecha: </b>{{\Carbon\Carbon::now()->toFormattedDateString()}}
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

      <h1 id="cabeza">Reporte de Personas</h1>

	  <table class="anch-tb" align="center">
		<tr>
		  <td class="ser-data" colspan="4">
		    <h4><strong> Total de Personas:</strong> {{$datos['personas']}}</h4>
	      </td>
		</tr>
		<tr>
		  <td class="ser-data" colspan="2">
			<strong> Total de Miembros:</strong> {{$datos['miembros']}}
		  </td>
		  <td class="ser-data" colspan="2">
			<strong> Total de No miembros:</strong> {{$datos['noMiembros']}}
		  </td>
		</tr>
		<tr>
		  <td class="ser-data">
			<strong> Total de Hombres:</strong> {{$datos['hombresM']}}
		  </td>
		  <td class="ser-data">
			<strong> Total de Mujeres:</strong> {{$datos['mujeresM']}}
		  </td>
		  <td class="ser-data">
			<strong> Total de Hombres:</strong> {{$datos['hombresN']}}
		  </td>
		  <td class="ser-data">
			<strong> Total de Mujeres:</strong> {{$datos['mujeresN']}}
		  </td>
		</tr>
		<tr>
		  <td class="ser-data">
		  	<strong> Mayores a 30 años:</strong> {{$datos['hombresMayoresM']}}
		  </td>
		  <td class="ser-data">
		  	<strong> Mayores a 30 años:</strong> {{$datos['mujeresMayoresM']}}
		  </td>
		  <td class="ser-data">
		  	<strong> Mayores a 30 años:</strong> {{$datos['hombresMayoresN']}}
		  </td>
		  <td class="ser-data">
		  	<strong> Mayores a 30 años:</strong> {{$datos['mujeresMayoresN']}}
		  </td>
		</tr>
		<tr>
		  <td class="ser-data">
		   <strong> Menores a 30 años:</strong> {{$datos['hombresJovenesM']}} 
		  </td>
		  <td class="ser-data">
		   <strong> Menores a 30 años:</strong> {{$datos['mujeresJovenesM']}} 
		  </td>
		  <td class="ser-data">
		   <strong> Menores a 30 años:</strong> {{$datos['hombresJovenesN']}} 
		  </td>
		  <td class="ser-data">
		   <strong> Menores a 30 años:</strong> {{$datos['mujeresJovenesN']}} 
		  </td>
		</tr>
	  </table>

	<br>
      <div>
        <table class="ser-tabla">
          <tr style="background-color: #C3DFEE">
            <th class="ser-tabla">Carnet</th>
            <th class="ser-tabla">Nombre</th>
            <th class="ser-tabla">Apellido</th>
            <th class="ser-tabla">Sexo</th>
            <th class="ser-tabla">Fecha de Nacimiento</th>
            <th class="ser-tabla">Direccion</th>
            <th class="ser-tabla">Lugar de Nacimiento</th>
            <th class="ser-tabla">Estado Civil</th>
            <th class="ser-tabla">Grado de Instruccion</th>
            <th class="ser-tabla">Tipo</th>
          </tr>
          @foreach($personas as $persona)
          <tr style="background-color: #FCF8E3">
            <td class="ser-td" style="text-align: center;">{{$persona->ci}}</td>
            <td class="ser-td">{{$persona->nombre}}</td>
            <td class="ser-td">{{$persona->apellido}}</td>
            <td class="ser-td" style="text-align: center;">{{$persona->sexo}}</td>
            <td class="ser-td">{{$persona->fechadenacimiento}}</td>
            <td class="ser-td">{{$persona->direccion}}</td>
            <td class="ser-td" style="text-align: center;">{{$persona->lugardenacimiento}}</td>
            <td class="ser-td" style="text-align: center;">{{$persona->estadocivil}}</td>
            <td class="ser-td" style="text-align: center;">{{$persona->gradoinstruccion}}</td>
            <td class="ser-td" style="text-align: center;">{{$persona->tipo}}</td>
          </tr>
          @endforeach
        </table>
      </div>
</body>
</html>