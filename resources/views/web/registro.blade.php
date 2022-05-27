<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="csrf-token" content="{{ csrf_token() }}" />
	<title>Document</title>
	<link rel="stylesheet" href="{{asset('vendor/fontawesome-free/css/all.min.css')}}">
	<link rel="stylesheet" href="{{asset('vendor/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<?php
	$cantidad_individual  = 0;
	$cantidad_grupal 	  = 0;
	$cantidad_actitudinal = 0;

	$porcentaje_individual  = $asignadoc->porcentaje_individual;
	$porcentaje_grupal 		= $asignadoc->porcentaje_grupal;
	$porcentaje_actitudinal = $asignadoc->porcentaje_actitudinal;
?>
@foreach($lista_planes as $plan)
	@if($plan->detalplanevas[0]->tipoact_acti == 'Aporte individual')
		<?php $cantidad_individual++; ?>
	@elseif($plan->detalplanevas[0]->tipoact_acti == 'Aporte grupal')
		<?php $cantidad_grupal++; ?>
	@elseif($plan->detalplanevas[0]->tipoact_acti == 'Aporte actitudinal')
		<?php $cantidad_actitudinal++; ?>
	@endif
@endforeach
<body>
	<div class="container">
		<div class="row">
			<div class="col-lg-12 text-center">
				<div class="form-group">
					
				</div>
				<h3 class="text-primary">REGISTRO DE NOTAS</h3>
			</div>
			<div class="col-lg-12">
				<div class="form-group">
					<table border="1" style="width: 100%;" class="table-hover">
						<?php 
							$colspan = 10 +  $cantidad_individual + $cantidad_grupal + $cantidad_actitudinal; 
						?>
						<thead>
							<tr>
								<th colspan="{{$colspan}}" class="text-center">CENTRO DE OPERACIONES SECTORIAL</th>
							</tr>
							<tr>
								<th colspan="{{$colspan}}" class="text-center">DEPARTAMENTO DE CAPACITACIÓN</th>
							</tr>
							<tr>
								<th colspan="{{$colspan}}" class="text-center">REPORTE DE CALIFICACIONES BAJO EL MODELO EDUCATIVO POR COMPETENCIAS</th>
							</tr>
							<tr>
								<th colspan="3">CURSO: </th>
								<th colspan="{{8 +  $cantidad_individual + $cantidad_grupal + $cantidad_actitudinal}}">MATERIA:</th>
							</tr>
							<tr>
								<th>N°</th>
								<th>GRADO</th>
								<th class="text-center" >NOMINA DE ALUMNOS</th>
								<th class="text-center"  colspan="{{$cantidad_individual + 1}}">INDIVIDUAL</th>
								<th class="text-center" >PROMEDIO</th>
								<th class="text-center"  colspan="{{$cantidad_grupal + 1}}">GRUPAL</th>
								<th class="text-center" >PROMEDIO</th>
								<th class="text-center"  colspan="{{$cantidad_actitudinal + 1}}">ACTITUDINAL</th>
								<th class="text-center" >PROMEDIO</th>
								<th class="text-center"> PROMEDIO FINAL</th>
							</tr>
						</thead>
						<tbody>
							<?php $numero = 1; ?>
							@foreach($lista_matriculas as $matricula)
								<tr class="text-center">
									<td></td>
									<td></td>
									<td>
									</td>
									@foreach($lista_planes as $plan)
										@if($plan->detalplanevas[0]->tipoact_acti == 'Aporte individual')
											<td class="text-center">{{$plan->detalplanevas[0]->descrip_detac}}</td>
										@endif
									@endforeach
									<td>NOTA</td>
									<td>
										<b>{{$asignadoc->porcentaje_individual}} %</b>
									</td>
									@foreach($lista_planes as $plan)
										@if($plan->detalplanevas[0]->tipoact_acti == 'Aporte grupal')
											<td class="text-center">{{$plan->detalplanevas[0]->descrip_detac}}</td>
										@endif
									@endforeach
									<td>NOTA</td>
									<td>
										<b>{{$asignadoc->porcentaje_grupal}} %</b>
									</td>
									@foreach($lista_planes as $plan)
										@if($plan->detalplanevas[0]->tipoact_acti == 'Aporte actitudinal')
											<td class="text-center">{{$plan->detalplanevas[0]->descrip_detac}}</td>
										@endif
									@endforeach
									<td>NOTA</td>
									<td>
										<b>{{$asignadoc->porcentaje_actitudinal}} %</b>
									</td>
									<td>
									</td>
								</tr>
								@break
							@endforeach
							@foreach($lista_matriculas as $matricula)
								<tr>
									<input type="hidden" name="ids_alumnos[]" value="{{$matricula->alumno_id}}">
									<td>{{$numero++}}</td>
									<td>{{$matricula->alumnos->tipogrado->nom_grado}}</td>
									<td style="width: 300px;">
										{{$matricula->alumnos->ape_al}} {{$matricula->alumnos->nom_al}}
									</td>
									@foreach($lista_planes as $plan)
										@if($plan->detalplanevas[0]->tipoact_acti == 'Aporte individual')

											@if(count($matricula->periodos->evaluaciones) > 0)

												<?php $existe_nota = false; ?>
												@foreach($matricula->periodos->evaluaciones as $evaluacion)
													@if($evaluacion->alumno_id == $matricula->alumno_id && $evaluacion->periodo_id == $matricula->periodo_id && $evaluacion->materia_id == $materia_id && $evaluacion->detalplaneva_id  == $plan->detalplanevas[0]->id)

														<td>
															<input type="hidden" name="ids_nota_individual[]" value="{{$matricula->alumno_id}}{{$matricula->periodo_id}}{{$materia_id}}{{$plan->detalplanevas[0]->id}}">
															<input type="text" id="nota_{{$matricula->alumno_id}}{{$matricula->periodo_id}}{{$materia_id}}{{$plan->detalplanevas[0]->id}}" value="{{$evaluacion->nota_deteva}}" class="form-control" onkeyup="GuardarNota('{{$matricula->alumno_id}}', '{{$matricula->periodo_id}}' ,'{{$materia_id}}' ,'{{$plan->detalplanevas[0]->id}}', this.value);">
														</td>

														<?php $existe_nota = true; ?>
													@endif
												@endforeach

												@if($existe_nota == 0)
													<td>
														<input type="hidden" name="ids_nota_individual[]" value="{{$matricula->alumno_id}}{{$matricula->periodo_id}}{{$materia_id}}{{$plan->detalplanevas[0]->id}}">
														<input type="text" id="nota_{{$matricula->alumno_id}}{{$matricula->periodo_id}}{{$materia_id}}{{$plan->detalplanevas[0]->id}}" value="0" class="form-control" onkeyup="GuardarNota('{{$matricula->alumno_id}}', '{{$matricula->periodo_id}}' ,'{{$materia_id}}' ,'{{$plan->detalplanevas[0]->id}}', this.value);">
													</td>
												@endif
											@else
												<td>
													<input type="hidden" name="ids_nota_individual[]" value="{{$matricula->alumno_id}}{{$matricula->periodo_id}}{{$materia_id}}{{$plan->detalplanevas[0]->id}}">
													<input type="text" id="nota_{{$matricula->alumno_id}}{{$matricula->periodo_id}}{{$materia_id}}{{$plan->detalplanevas[0]->id}}" value="0" class="form-control" onkeyup="GuardarNota('{{$matricula->alumno_id}}', '{{$matricula->periodo_id}}' ,'{{$materia_id}}' ,'{{$plan->detalplanevas[0]->id}}', this.value);">
												</td>
											@endif
										@endif
									@endforeach
									<td>
										<input type="text" id="promedio_individual_{{$matricula->alumno_id}}" class="form-control" readonly>
									</td>
									<td>
										<input type="text" id="promedio_individual_porcentaje_{{$matricula->alumno_id}}" class="form-control" readonly>
									</td>
									@foreach($lista_planes as $plan)
										@if($plan->detalplanevas[0]->tipoact_acti == 'Aporte grupal')

											@if(count($matricula->periodos->evaluaciones) > 0)

												<?php $existe_nota = false; ?>
												@foreach($matricula->periodos->evaluaciones as $evaluacion)
													@if($evaluacion->alumno_id == $matricula->alumno_id && $evaluacion->periodo_id == $matricula->periodo_id && $evaluacion->materia_id == $materia_id && $evaluacion->detalplaneva_id  == $plan->detalplanevas[0]->id)

														<td>
															<input type="hidden" name="ids_nota_grupal[]" value="{{$matricula->alumno_id}}{{$matricula->periodo_id}}{{$materia_id}}{{$plan->detalplanevas[0]->id}}">
															<input type="text" id="nota_{{$matricula->alumno_id}}{{$matricula->periodo_id}}{{$materia_id}}{{$plan->detalplanevas[0]->id}}" value="{{$evaluacion->nota_deteva}}" class="form-control" onkeyup="GuardarNota('{{$matricula->alumno_id}}', '{{$matricula->periodo_id}}' ,'{{$materia_id}}' ,'{{$plan->detalplanevas[0]->id}}', this.value);">
														</td>

														<?php $existe_nota = true; ?>
													@endif
												@endforeach

												@if($existe_nota == 0)
													<td>
														<input type="hidden" name="ids_nota_grupal[]" value="{{$matricula->alumno_id}}{{$matricula->periodo_id}}{{$materia_id}}{{$plan->detalplanevas[0]->id}}">
														<input type="text" id="nota_{{$matricula->alumno_id}}{{$matricula->periodo_id}}{{$materia_id}}{{$plan->detalplanevas[0]->id}}" value="0" class="form-control" onkeyup="GuardarNota('{{$matricula->alumno_id}}', '{{$matricula->periodo_id}}' ,'{{$materia_id}}' ,'{{$plan->detalplanevas[0]->id}}', this.value);">
													</td>
												@endif
											@else
												<td>
													<input type="hidden" name="ids_nota_grupal[]" value="{{$matricula->alumno_id}}{{$matricula->periodo_id}}{{$materia_id}}{{$plan->detalplanevas[0]->id}}">
													<input type="text" id="nota_{{$matricula->alumno_id}}{{$matricula->periodo_id}}{{$materia_id}}{{$plan->detalplanevas[0]->id}}" value="0" class="form-control" onkeyup="GuardarNota('{{$matricula->alumno_id}}', '{{$matricula->periodo_id}}' ,'{{$materia_id}}' ,'{{$plan->detalplanevas[0]->id}}', this.value);">
												</td>
											@endif
										@endif
									@endforeach
									<td>
										<input type="text" id="promedio_grupal_{{$matricula->alumno_id}}" class="form-control" readonly>
									</td>
									<td>
										<input type="text" id="promedio_grupal_porcentaje_{{$matricula->alumno_id}}" class="form-control" readonly>
									</td>
									@foreach($lista_planes as $plan)
										@if($plan->detalplanevas[0]->tipoact_acti == 'Aporte actitudinal')

											@if(count($matricula->periodos->evaluaciones) > 0)

												<?php $existe_nota = false; ?>
												@foreach($matricula->periodos->evaluaciones as $evaluacion)
													@if($evaluacion->alumno_id == $matricula->alumno_id && $evaluacion->periodo_id == $matricula->periodo_id && $evaluacion->materia_id == $materia_id && $evaluacion->detalplaneva_id  == $plan->detalplanevas[0]->id)

														<td>
															<input type="hidden" name="ids_nota_actitudinal[]" value="{{$matricula->alumno_id}}{{$matricula->periodo_id}}{{$materia_id}}{{$plan->detalplanevas[0]->id}}">
															<input type="text" id="nota_{{$matricula->alumno_id}}{{$matricula->periodo_id}}{{$materia_id}}{{$plan->detalplanevas[0]->id}}" value="{{$evaluacion->nota_deteva}}" class="form-control" onkeyup="GuardarNota('{{$matricula->alumno_id}}', '{{$matricula->periodo_id}}' ,'{{$materia_id}}' ,'{{$plan->detalplanevas[0]->id}}', this.value);">
														</td>

														<?php $existe_nota = true; ?>
													@endif
												@endforeach

												@if($existe_nota == 0)
													<td>
														<input type="hidden" name="ids_nota_actitudinal[]" value="{{$matricula->alumno_id}}{{$matricula->periodo_id}}{{$materia_id}}{{$plan->detalplanevas[0]->id}}">
														<input type="text" id="nota_{{$matricula->alumno_id}}{{$matricula->periodo_id}}{{$materia_id}}{{$plan->detalplanevas[0]->id}}" value="0" class="form-control" onkeyup="GuardarNota('{{$matricula->alumno_id}}', '{{$matricula->periodo_id}}' ,'{{$materia_id}}' ,'{{$plan->detalplanevas[0]->id}}', this.value);">
													</td>
												@endif
											@else
												<td>
													<input type="hidden" name="ids_nota_actitudinal[]" value="{{$matricula->alumno_id}}{{$matricula->periodo_id}}{{$materia_id}}{{$plan->detalplanevas[0]->id}}">
													<input type="text" id="nota_{{$matricula->alumno_id}}{{$matricula->periodo_id}}{{$materia_id}}{{$plan->detalplanevas[0]->id}}" value="0" class="form-control" onkeyup="GuardarNota('{{$matricula->alumno_id}}', '{{$matricula->periodo_id}}' ,'{{$materia_id}}' ,'{{$plan->detalplanevas[0]->id}}', this.value);">
												</td>
											@endif
										@endif
									@endforeach
									<td>
										<input type="text" id="promedio_actitudinal_{{$matricula->alumno_id}}" class="form-control" readonly>
									</td>
									<td>
										<input type="text" id="promedio_actitudinal_porcentaje_{{$matricula->alumno_id}}" class="form-control" readonly>
									</td>
									<td>
										<input type="text" id="promedio_final_{{$matricula->alumno_id}}" class="form-control" readonly>
									</td>
								</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</body>
<script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>
<script src="{{asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('vendor/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
<script>
	function GuardarNota(alumno_id, periodo_id, materia_id, detalplaneva_id, nota_deteva)
	{
		let data = new FormData();

		data.append('alumno_id', alumno_id);
		data.append('periodo_id', periodo_id);
		data.append('materia_id', materia_id);
		data.append('detalplaneva_id', detalplaneva_id);
		data.append('nota_deteva', nota_deteva);

		let url = "{{url('/')}}/";
		let token = $('meta[name="csrf-token"]').attr('content');

		$.ajax({
            type: "POST",
            url: url +'api/evaluacion/guadar/nota',
            headers : {'X-CSRF-TOKEN': token},
            data: data,
            processData: false,
            contentType: false,
            success: function(response)
            {
            	CalcularPromedio();
            },
            error: function(xhr)
            {
            }
        });
	}

	function CalcularPromedio()
	{
		let ids_alumnos 		 = document.getElementsByName('ids_alumnos[]');
		let ids_nota_individual  = document.getElementsByName('ids_nota_individual[]');
		let ids_nota_grupal 	 = document.getElementsByName('ids_nota_grupal[]');
		let ids_nota_actitudinal = document.getElementsByName('ids_nota_actitudinal[]');

		let cantidad_individual  = '{{$cantidad_individual}}';
		let cantidad_grupal 	 = '{{$cantidad_grupal}}';
		let cantidad_actitudinal = '{{$cantidad_actitudinal}}';

		let promedio_individual  = 0;
		let promedio_grupal 	 = 0;
		let promedio_actitudinal = 0;

		let porcentaje_individual  = '{{$porcentaje_individual}}' / 100;
		let porcentaje_grupal 	   = '{{$porcentaje_grupal}}' / 100;
		let porcentaje_actitudinal = '{{$porcentaje_actitudinal}}' / 100;

		let notas_individuales  = [];
		let notas_grupales 	    = [];
		let notas_actitudinales = [];

		let contador_individual = 1;

		let posicion_alumno = 0;

		for(var i = 0; i < ids_nota_individual.length; i++)
		{
			if(contador_individual <= cantidad_individual)
			{
				promedio_individual = parseFloat(promedio_individual) + parseFloat(($('#nota_'+ ids_nota_individual[i].value).val() == '' ? 0 : $('#nota_'+ ids_nota_individual[i].value).val()));

				contador_individual++;
			}

			if(contador_individual > cantidad_individual)
			{
				promedio_individual = promedio_individual / cantidad_individual;

				$('#promedio_individual_'+ ids_alumnos[posicion_alumno].value).val(promedio_individual);
				$('#promedio_individual_porcentaje_'+ ids_alumnos[posicion_alumno].value).val((promedio_individual) * porcentaje_individual);

				notas_individuales.push(promedio_individual);

				promedio_individual = 0;
				contador_individual = 1;

				posicion_alumno++;
			}
		}

		let contador_grupal = 1;

		posicion_alumno = 0;

		for(var i = 0; i < ids_nota_grupal.length; i++)
		{
			if(contador_grupal <= cantidad_grupal)
			{
				promedio_grupal = parseFloat(promedio_grupal) + parseFloat(($('#nota_'+ ids_nota_grupal[i].value).val() == '' ? 0 : $('#nota_'+ ids_nota_grupal[i].value).val()));

				contador_grupal++;
			}

			if(contador_grupal > cantidad_grupal)
			{
				promedio_grupal = promedio_grupal / cantidad_grupal;

				$('#promedio_grupal_'+ ids_alumnos[posicion_alumno].value).val(promedio_grupal);
				$('#promedio_grupal_porcentaje_'+ ids_alumnos[posicion_alumno].value).val((promedio_grupal) * porcentaje_grupal);

				notas_grupales.push(promedio_grupal);

				promedio_grupal = 0;
				contador_grupal = 1;

				posicion_alumno++;
			}
		}

		let contador_actitudinal = 1;

		posicion_alumno = 0;

		for(var i = 0; i < ids_nota_actitudinal.length; i++)
		{
			if(contador_actitudinal <= cantidad_actitudinal)
			{
				promedio_actitudinal = parseFloat(promedio_actitudinal) + parseFloat(($('#nota_'+ ids_nota_actitudinal[i].value).val() == '' ? 0 : $('#nota_'+ ids_nota_actitudinal[i].value).val()));

				contador_actitudinal++;
			}

			if(contador_actitudinal > cantidad_actitudinal)
			{
				promedio_actitudinal = promedio_actitudinal / cantidad_actitudinal;

				$('#promedio_actitudinal_'+ ids_alumnos[posicion_alumno].value).val(promedio_actitudinal);
				$('#promedio_actitudinal_porcentaje_'+ ids_alumnos[posicion_alumno].value).val((promedio_actitudinal) * porcentaje_actitudinal);

				notas_actitudinales.push(promedio_actitudinal);

				promedio_actitudinal = 0;
				contador_actitudinal = 1;

				let promedio_final = ((notas_individuales[posicion_alumno] * porcentaje_individual) + (notas_grupales[posicion_alumno] * porcentaje_grupal) + (notas_actitudinales[posicion_alumno] * porcentaje_actitudinal));

				$('#promedio_final_'+ ids_alumnos[posicion_alumno].value).val(promedio_final.toFixed(2));

				posicion_alumno++;
			}
		}

		/*for(var i = 0; i < ids_nota_actitudinal.length; i++)
		{
			//calculando promedio actitudinal
			for(var j = 0; j < cantidad_actitudinal; j++)
			{
				promedio_actitudinal = promedio_actitudinal + ($('#nota_'+ ids_nota_actitudinal[j].value).val() == '' ? 0 : $('#nota_'+ ids_nota_actitudinal[j].value).val());
			}

			$('#promedio_actitudinal_'+ ids_alumnos[i].value).val(promedio_actitudinal / cantidad_actitudinal);

			promedio_actitudinal = 0;
		}*/
	}

	CalcularPromedio();
</script>
</html> 