<html>
	<title>REPORTE DE MATRICULACIÓN</title>
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
        	<br><br><br>
			<h3><center>REPORTE DE MATRICULACIÓN</center></h3>
			<table border=0 cellspacing=0 cellpadding=2 bordercolor="666633" style="width: 100%;">
				<tr>
					<td><b>Curso:</b></td>
					<td>{{$curso->nom_cur}}</td>
					<td><b>Periodo:</b></td>
					<td>{{$periodo->ano_per}} {{$periodo->peri_per}}</td>
				</tr>
			</table>
			<br>
			<table border=1 cellspacing=0 cellpadding=2 bordercolor="666633"style="font-size: 12px;" width="100%">
				<thead>
					<tr>
						<th>Ord</th>
						<th>Grado</th>
						<th>Cédula</th>
						<th>Apellidos y nombres</th>
						<th>Curso</th>
						<th>Sección</th>
						<th>Periodo</th>
					</tr>
				</thead>
				<tbody>
					<?php $contador = 1; ?>
					@foreach($lista_matriculas as $matricula)
						<tr>
							
							<td style="width: {{$type == 'preview' ? 5 .'%' : 10 .'px'}}; text-align: center;">{{$contador++}}</td>
							<td style="width: {{$type == 'preview' ? 15 .'%' : 50 .'px'}}; text-align: center;">{{isset($matricula->alumnos->tipogrado) ? $matricula->alumnos->tipogrado->nom_grado : ''}}</td>
							<td style="width: {{$type == 'preview' ? 10 .'%' : 60 .'px'}}; text-align: center;">{{$matricula->alumnos->dni_al}}</td>
							<td style="width: {{$type == 'preview' ? 25 .'%' : 120 .'px'}}; text-align: center;">
								{{$matricula->alumnos->ape_al}} {{$matricula->alumnos->nom_al}}
							</td>
							<td style="width: {{$type == 'preview' ? 15 .'%' : 100 .'px'}}; text-align: center;">{{$curso->nom_cur}}</td>
							<td style="width: {{$type == 'preview' ? 15 .'%' : 100 .'px'}}; text-align: center;">
								{{$matricula->seccions->nom_sec}}
							</td>
							<td style="width: {{$type == 'preview' ? 20 .'%' : 150 .'px'}}; text-align: center;">{{$periodo->ano_per}} {{$periodo->peri_per}}</td>
						</tr>
					@endforeach
				</tbody>
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