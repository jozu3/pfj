<div class="card-body">
	<table class="table table-striped">
		<thead>
			<tr>
				<th>Unidad</th>
				<th>Fecha de inicio</th>
				<th>Cantidad de clases</th>
				<th>Profesor</th>
				<th>Acciones</th>
			</tr>
		</thead>
		<tbody>
        @if ($grupos->count())
			@foreach($grupos as $unidad)
			  <tr>
			  	<td width="250px">
					<a class="btn dropdown-toggle" data-toggle="collapse" href="#list-notas{{ $unidad->id }}" role="button" aria-expanded="false" aria-controls="list-notas{{ $unidad->id }}">{{ $unidad->descripcion }}  </a>
			  	</td>
			  	<td width="250px">{{ date('d/m/Y', strtotime($unidad->fechainicio)) }}</td>
			  	<td width="250px">{{ $unidad->cantidad_clases }}</td>
			  	<td width="250px">{{ $unidad->profesore->nombres.' '.$unidad->profesore->apellidos }}</td>
			 
			  	<td width="10px">
			  		<a href="{{ route('admin.grupos.edit', $unidad) }}" class="btn btn-sm btn-primary" >Editar</a>
			  	</td>
			  	<td width="10px">
					<form method="POST" action="{{ route('admin.grupos.destroy', $unidad) }}">
						@csrf
						@method('DELETE')
						<button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
					</form>
				</td>
			  </tr>
			  <tr>
			  	<td colspan="6">
			  		<div class="row">
					  <div class="col">
					    <div class="collapse multi-collapse" id="list-notas{{ $unidad->id }}">
					      <div class="">
					        <div>
					        	<ul class="list-group list-group-horizontal">
								  <li class="list-group-item list-nota"><b>{{ 'Notas' }}</b></li>
								  <li class="list-group-item list-nota"></li>
								  <li class="list-group-item list-nota list-nota2"></li>
								</ul>
								@foreach ($unidad->notas as $nota)
								@if ($nota->tipo == 0)
								<ul class="list-group list-group-horizontal">
								  <li class="list-group-item list-nota">{{ 'Nota Regular' }}</li>
								  <li class="list-group-item list-nota">{{$nota->valor*100}} %</li>
								  <li class="list-group-item list-nota list-nota2">{{$nota->descripcion}}</li>
								</ul>
								@endif
								@endforeach
								@foreach ($unidad->notas as $nota)
								@if ($nota->tipo == 1)
								<ul class="list-group list-group-horizontal">
								  <li class="list-group-item list-nota">{{'Nota Recuperatoria'}}</li>
								  <li class="list-group-item list-nota">Reemplaza la nota final de la unidad</li>
								  <li class="list-group-item list-nota list-nota2">{{$nota->descripcion}}</li>
								</ul>
								@endif
								@endforeach
							</div>
					      </div>
					    </div>
					  </div>
					</div>
			  	</td>
			  </tr>
			@endforeach
		@else
		    <tr>
		    	<td>No hay unidades</td>		                
		    	<td></td>
		    	<td></td>
		    	<td></td>
		    	<td></td>
		    </tr>
		@endif
		@if (!$iniciado)
			<tr>
				<form wire:submit.prevent="submit">
				<td>
					<input type="text" name="descripcion" wire:model="descripcion" class="form-control">
					@error('descripcion')<small class="text-danger">{{ $message }}</small> @enderror
				</td>
				<td>
					<input type="date" name="fechainicio" wire:model="fechainicio" class="form-control">
					@error('fechainicio')<small class="text-danger">{{ $message }}</small> @enderror
				</td>
				<td>
					<input type="number" min="1" name="cantidad_clases" wire:model="cantidad_clases" class="form-control">
					@error('cantidad_clases')<small class="text-danger">{{ $message }}</small> @enderror
				</td>
				<td>
					<select name="profesor" wire:model="profesor" class="form-control">
						<option value="-1">- Seleccione -</option>
						@foreach ($profesores as $profesore)
						<option value="{{ $profesore->id }}">{{ $profesore->nombres.' '.$profesore->apellidos }}</option>
						@endforeach
					</select>
					@error('profesor')<small class="text-danger">{{ $message }}</small> @enderror
				</td>
				<td>
					<input type="submit" value="Guardar" wire:click="submit"  wire:loading.attr="disabled" wire:target="submit" class="btn btn-sm btn-primary disabled:opacity-25">
				</td>
				</form>
			</tr>
		@endif
		</tbody>
	</table>
</div>