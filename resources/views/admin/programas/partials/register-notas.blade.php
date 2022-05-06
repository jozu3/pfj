<div class="card cont-pestaña">
	<div class="card-header">
		<b>Listado de Personales</b>
	</div>
	<div class="card-body card-body-2 cont-table-div">
		<table class="table table-striped">
			<thead>
				<tr>
					<th class="apellido-fijo">Apellidos</th>
					<th class="nombre-fijo">Nombres</th>
					@foreach($grupo->grupos as $unidad)
						@if (auth()->user()->can('admin.grupos.viewList') or (auth()->user()->hasRole('Profesor') && $unidad->profesore_id == auth()->user()->profesore->id))
							<th colspan="{{ $unidad->notas->count() + 1}}" class="border-left">
								<center>{{ $unidad->descripcion }}</center>
							</th>
						@else
						@endif
					@endforeach
				</tr>
			</thead>
			<tbody>
				<tr>
					<td class="apellido-fijo">
					</td>
					<td class="nombre-fijo">
					</td>
					@foreach($grupo->grupos as $unidad)
						@if (auth()->user()->can('admin.grupos.viewList') or (auth()->user()->hasRole('Profesor') && $unidad->profesore_id == auth()->user()->profesore->id))
							<td>
								<b>Promedio</b>
							</td>
							@foreach($unidad->notas as $nota)
								<td width="100">	
									{{ $nota->descripcion }}@if ($nota->tipo == 1)
										{{ '(Nota recuperatoria)' }}
									@endif()
								</td>
							@endforeach
						@else
						<td>
							<br>
						</td>
						@endif
					@endforeach
				</tr>
				@foreach($grupo->inscripcionesEstado([0,2]) as $inscripcione)
					<tr>
						<td class="apellido-fijo">
							<b>{{$inscripcione->personale->contacto->apellidos.' ' }}</b>
						</td>
						<td class="nombre-fijo">	
						{{ $inscripcione->personale->contacto->nombres }} 
						</td>
						@if ($inscripcione->personaleUnidades->count())
						@foreach($inscripcione->personaleUnidades as $personaleUnidade)
						@if (auth()->user()->can('admin.grupos.viewList') or (auth()->user()->hasRole('Profesor') && $personaleUnidade->unidad->profesore_id == auth()->user()->profesore->id))
							<td class="border-left text-center">
								@if (!isset($is_report))
			                		{{ $is_report = false }}
			                	@endif
								@livewire('admin.unidad-nota-show', [
									'personaleUnidade_id' => $personaleUnidade->id,
									'is_report' => $is_report
									])	                		
							</td>
							@foreach($personaleUnidade->personaleNotas as $personaleNota)
								<td>
									<div class="form-row align-items-center una-fila">
						                <div class="col-auto my-1 mx-2">
						                	@livewire('admin.create-nota', [
						                		'nota_id' => $personaleNota->nota->id,
						                		'personale_unidade_id' => $personaleNota->personaleUnidade->id,
						                		])
											<div style="display: none;">
						                	{{ $personaleNota->valor }}
											</div>
						                </div>
									</div>
								</td>
							@endforeach
						@else
						@endif
						@endforeach
						@else
							<td colspan="100%" class="alert-light alturatd-dis">
								{{ 'No se han generado las notas' }}
							</td>
						@endif
						<td>
							<br><br>
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</div>