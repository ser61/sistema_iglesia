@extends('layouts.admin')

@section('content')
<br>
<div class="container">
    <div class="row" align="center">
        <div class="col-md-8 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading" id="cabeza">¡¡ Bienvenido {{ Auth::user()->name }} !!</div>

                <div class="panel-body">
                  <section class="box">
                        <a class="image featured"><img src="images/iglesia.jpg" alt="" /></a>
                        <header>
                          <h3>Iglesia Mision Cristiana Luz De Victoria</h3>
                        </header>
                        <p id="parafo">La Iglesia Luz de Victoria comenzó sus actividades en un local en alquiler, en el pasillo El Carmen #143, cerca de la plazuela Humboldt, zona de la 8va. División, mientras se realizaba el trámite respectivo para obtener la personería jurídica.</p>
                        <P id="parafo">En el año 1999 se hace la compra de un terreno de 1.000 Mt/2 en la tercera cuadra del Canal Cotoca o Av. Guapay.</p>
                        <p id="parafo">El 5 de diciembre del año 2.000 fue fundada oficialmente con el nombre de Misión Cristiana Luz de Victoria. Dicha institución tiene su sede y domicilio legal en la ciudad de Santa Cruz de la Sierra – Bolivia, la misma que se la concibe como una organización con derecho privado sin fines de lucro, creada con el propósito de la proclamación del evangelio de Jesucristo y que encamina sus acciones de acuerdo a lo establecido en la Palabra de Dios.</p>
                        <p id="parafo">A inicios del 2001 se trasladó definitivamente a sus nuevas instalaciones, dicho proyecto constaba de oficinas, aulas para clases, además de una segunda planta para la administración y un auditorio para aproximadamente 1.100 personas. La Misión está ubicadas a una cuadra del Canal Cotoca o Av. Guapay, en el Barrio Gualberto Villarroel, en la Calle San Luis de Cáceres # 2235 esq. Las Petas, UV 019, Distrito 3, Manzano 13</p>
                        <footer>
                          <a href="https://www.facebook.com/luzdevictoriasantacruz/info" class="button alt">Mas Informacion aqui.</a>
                        </footer>
                  </section>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
