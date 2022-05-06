<div class="card cont-pestaña">
	<div class="card-header">
		<b>Listado de Personales</b>
	</div>
	<div class="card-body card-body-2 cont-table-div" style="overflow-x:auto">
		<table class="table table-striped">
			<thead>
				<tr>
					<th class="apellido-fijo fijo">
						Apellidos
					</th>
					<th class="nombre-fijo fijo">
						Nombres
					</th>

					@if (isset($is_report) && $is_report == true)
	                	<th class="">Código de matrícula</th>
						<th class="">DNI/Documento de identidad</th>
						<th class="">Grado académico</th>
						<th class="">Teléfono</th>
	                @endif
					@forelse($programa->capacitaciones as $capacitacione)
						<th colspan="1" class="text-center border-left">
							<b>{{ $capacitacione->tema }}</b> <br>
							<b>{{ date('d/m/Y', strtotime($capacitacione->fechacapacitacion)) }}</b>
						</th>
					@empty
					<th colspan="100%" height="74" ></th>
					@endforelse
				</tr>
			</thead>
			<tbody>
				@foreach($inscripciones as $inscripcione)
					<tr>
						<td class="apellido-fijo">
							<b>{{$inscripcione->personale->contacto->apellidos.' ' }}</b>
						</td>
						<td class="nombre-fijo">
							{{ $inscripcione->personale->contacto->nombres }} 
						</td>
						@if (isset($is_report) && $is_report == true)
	                	<td class="">
	                		{{ $inscripcione->id }}
						</td>
						<td class="">
	                		{{ $inscripcione->personale->contacto->doc }}
						</td>
						<td class="">
							@php
								$grados = [
									'1' => 'Profesor',
									'2' => 'Bachiller',
									'3' => 'Licenciado',
									'4' => 'Magister',
									'5' => 'Doctor',
									'6' => 'Phd',
									'7' => 'Estudiante',
									'8' => 'No registra',
								];
							@endphp
							@if ($inscripcione->personale->contacto->grado_academico > 0)
	                			{{ $grados[$inscripcione->personale->contacto->grado_academico] }}
							@endif
						</td>
						<td class="">
	                		{{ $inscripcione->personale->contacto->telefono }}
						</td>
	                	@endif
						@forelse($inscripcione->programa->capacitaciones as $capacitacione)
							<td class="border-left">
								<div class="form-row align-items-center una-fila">
									<div class="col-auto my-1 mx-2">
										@if (!isset($is_report))
											{{ $is_report = false }}
										@endif
										@if($inscripcione->asistenciaCapacitacione($capacitacione))
										{!! Form::model($inscripcione->asistenciaCapacitacione($capacitacione)) !!}
										@else
										{!! Form::open(['route' => 'admin.capacitaciones.store']) !!}
										@endif
										@livewire('admin.create-asistencia', [
											'capacitacione_id' => $capacitacione->id,
											'inscripcione_id' => $inscripcione->id,
											'is_report' => $is_report
											])
										{!! Form::close() !!}
									</div>
								</div>
							</td>
						@empty
						<td>
							<br>
						</td>
						@endforelse
	                	<td>
	                		<br>
	                		<br>
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</div>