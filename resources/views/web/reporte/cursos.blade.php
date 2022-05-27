<html>
	<title>REPORTE DE CALIFICACIONES CURSO</title>
    <head>
        <style>
            /** 
                Establezca los márgenes de la página en 0, por lo que el pie de página y el encabezado
                puede ser de altura y anchura completas.
             **/
            @page {
                margin: 0cm 0cm;
            }

            /** Defina ahora los márgenes reales de cada página en el PDF **/
            body {
                margin-top: 2cm;
                margin-left: 2cm;
                margin-right: 2cm;
                margin-bottom: 2cm;
            }

            /** Definir las reglas del encabezado **/
            header {
                position: fixed;
                top: 0cm;
                left: 0cm;
                right: 0cm;
                height: 2cm;

                /** Estilos extra personales **/
                background-color: white;
                color: black;
                text-align: center;
                line-height: 0.5cm;
            }

            /** Definir las reglas del pie de página **/
            footer {
                position: fixed; 
                bottom: 0cm; 
                left: 0cm; 
                right: 0cm;
                height: 5cm;

                /** Estilos extra personales **/
                background-color: white;
                color: black;
                text-align: center;
                line-height: 1.5cm;
            }

            .verticalText{
 
			 	text-orientation: upright; /*SI necesitas el textos sea orientado de este modo tambien*/
			  	font-size: 13px;
				margin-right: -15px;
				margin-left: 0px;
				float:left;
				transform: rotate(-90deg);
				padding-left: 0px;
			}

			
			.rotate {
			     -moz-transform: rotate(-90.0deg);  /* FF3.5+ */
			       -o-transform: rotate(-90.0deg);  /* Opera 10.5 */
			  -webkit-transform: rotate(-90.0deg);  /* Saf3.1+, Chrome */
			             filter:  progid:DXImageTransform.Microsoft.BasicImage(rotation=0.083);  /* IE6,IE7 */
			         -ms-filter: "progid:DXImageTransform.Microsoft.BasicImage(rotation=0.083)"; /* IE8 */
			}
        </style>
    </head>
    <body>
        <!-- Defina bloques de encabezado y pie de página antes de su contenido -->
        <header>
        	<table width="100%">
        		<tr>
        			<td style="width: {{$type == 'preview' ? 20 .'%' : 20 .'%'}}; text-align: center; padding-top: 10px;">
        				<img src="https://sgacademico.wilssoft.com/logo.jfif" style="width: 35%; text-align: center;">
        			</td>
        			<td style="width: {{$type == 'preview' ? 60 .'%' : 60 .'%'}}; text-align: center;">
        				<b>
        					FUERZA AÉREA ECUATORIANA <br>
							CENTRO DE OPERACIONES SECTORIALES NRO 1
						</b>
					</td>
					<td style="width: {{$type == 'preview' ? 20 .'%' : 20 .'%'}};">
						Fecha: {{date('d/m/Y')}}<br>
						Hora: {{date('H:i:s')}}
					</td>
        		</tr>
        	</table>
            <br><br>
        </header>

        <main>
        	<br><br><br><br>
			<h3><center>REPORTE DE CALIFICACIONES CURSO</center></h3>
			<table border=0 cellspacing=0 cellpadding=2 bordercolor="666633" style="font-size: 13px; width: 100%;"> 
				<tr>
					<td><b>Curso:</b></td>
					<td>{{$curso->nom_cur}}</td>
					<td><b>Periodo:</b></td>
					<td>{{$periodo->ano_per .' '. $periodo->peri_per}}</td>
				</tr>
			</table>
			<br>
			<table border=1 cellspacing=0 cellpadding=2 bordercolor="666633"style="font-size: 12px; width: 100%;">
				<tr style="font-size: 13px; width: 100%; font-weight: bold;">
					<td style="height: 150px; width: 2%;">Ord.</td>
					<td style="height: 150px; width: 2%;">Grado</td>
					<td style="height: 150px; width: 10%;">Apellidos y nombres</td>
					@foreach($materias as $materia)
						<td style="height: 150px; width: 5%; padding-left: -15px;"><div class="rotate">{{$materia->nom_mat}}</div></td>
					@endforeach
					<td style="height: 150px; width: 5%;"><div class="rotate">Promedio</div></td>
					<td style="height: 150px; width: 5%;"><div class="rotate">Observaciones</div></td>
				</tr>
				<?php $contador = 1; ?>
					@foreach($lista_reporte as $reporte)

						<?php
							$promedio = 0;
						?>

						<tr>
							<td style="width: 2%; text-align: center;">{{$contador++}}</td>
							<td style="width: 2%; text-align: center;">{{$reporte['grado']}}</td>
							<td style="width: auto; text-align: center;">{{$reporte['alumno']}}</td>
							@foreach($reporte['notas_materia'] as $nota)
								<td style="text-align: center;">{{$nota}}</td>
							@endforeach
							<td style="width: 5%; text-align: center;">
								{{$reporte['promedio_curso']}}
							</td>
							<td style="width: 5%; text-align: center;">
								{{$reporte['promedio_letra']}}
							</td>
						</tr>
					@endforeach
			</table>

			<br><br><br><br>
			
			<table style="font-size: 15px; text-align: center; width: 100%;">
				<tbody>
					<tr>
						<td style="width: 40%; text-align: center; align-items: center;">
							<hr>
							{{$jefe_departamento->nombre_completo}}<br>
							{{$jefe_departamento->grado}}<br>
							{{$jefe_departamento->cargo}} 
						</td>
						<td style="width: 20%; text-align: center; align-items: center;">
						</td>
						<td style="width: 40%; text-align: center;">
							<hr>
							{{$supervisor->nombre_completo}}<br>
							{{$supervisor->grado}}<br>
							{{$supervisor->cargo}} 
						</td>
					</tr>
				</tbody>
			</table>
        </main>
    </body>
</html>
<script>
	window.addEventListener('load', function () {
    var rotates = document.getElementsByClassName('rotate');
    for (var i = 0; i < rotates.length; i++) {
        rotates[i].style.height = rotates[i].offsetWidth + 'px';
    }
});
</script>