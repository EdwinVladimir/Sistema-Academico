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
			<h3><center>REPORTE DE HISTORIAL ACADÉMICO ESTUDIANTE</center></h3>
			<table border=0 cellspacing=0 cellpadding=2 bordercolor="666633" style="font-size: 13px; width: 100%;"> 
				<tr>
					<td><b>Estudiante:</b></td>
					<td>{{$alumno->nom_al .' '. $alumno->ape_al}}</td>
					<td><b>Grado:</b></td>
					<td>{{$alumno->nom_grado}}</td>
				</tr>
			</table>
			<br>
			@foreach($lista_reporte as $reporte)
				<table border=1 cellspacing=0 cellpadding=2 bordercolor="666633"style="font-size: 12px; width: 100%;">
					<tr style="font-size: 13px; width: 100%; font-weight: bold; background: #C70039; color: white;">
						<td style="height: 35px; width: 100%; text-align: center;" colspan="3">{{$reporte['curso'] .' | '. $reporte['periodo'] }}</td>
					</tr>
					<tr>
						<td style="height: 10px; width: 2%;">ORD.</td>
						<td style="height: 10px; width: 80%; text-align: center;"><b>MATERIAS</b></td>
						<td style="height: 10px; width: 18%; text-align: center;"><b>NOTAS</b></td>
					</tr>

					<?php
						$promedio = 0;
						$contador = 1;
						$promedio = 0;
						$materias = 0;
					?>

					@foreach($reporte['materias'] as $materia)
						<?php
							$promedio = $promedio + $materia['promedio_materia'];

							$materias++;
						?>
						<tr>
							<td style="width: 2%; text-align: center;">{{$contador++}}</td>
							<td style="width: 80%; text-align: left;">{{$materia['materia']}}</td>
							<td style="width: 18%; text-align: center;">{{$materia['promedio_materia']}}</td>
						</tr>
					@endforeach

					<tr>
						<td style="width: 2%; text-align: center;"></td>
						<td style="width: 80%; text-align: right;"><b>Promedio</b></td>
						<td style="width: 18%; text-align: center;">{{number_format($promedio / $materias, 2)}}</td>
					</tr>
				</table>
				<br><br>
			@endforeach

			<br><br><br><br>
			
			<table style="font-size: 18px; text-align: center; width: 100%;">
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