<div class="card">
	<div class="card-header">
				<h4>Notas 
					
					@if ($notas_completas == 1)
						<small>{{ '(Completas)' }}</small>
					@endif
					<small class="text-danger">
					@if ($notas_completas < 1 )
						 {{ '(Incompleto, ingrese notas para completar el 100%)' }}
					@endif
					@if ($notas_completas > 1 )
						{{ '(Error, las notas superan el 100%)' }}
					@endif
					</small>
				</h4>
	</div>
	<div class="card-body">
		<table class="table table-striped">
			<thead>
				<tr>
					<th>Concepto de Nota</th>
					<th>Tipo de nota</th>
					<th>Valor (%)</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
	        @if ($notas->count())
				@foreach($notas as $nota)
				  <tr>
				  	<td>{{ $nota->descripcion }}</td>
				  	<td>
				  		@switch ($nota->tipo)
				  			@case(0)
				  				{{ 'Nota Regular' }}
				  			@break
				  			@case(1)
				  				{{ 'Nota Recuperatoria' }}
				  			@break
				  		@endswitch
				  	</td>
				  	<td>
				  		@if($nota->valor == 0 && $nota->tipo == 1)
				  		{{ 'Reemplaza la nota final de la unidad' }}
				  		@else
				  		{{ $nota->valor*100 }}%
				  		@endif
				  	</td>
				  	<td width="10px">
				  		<a href="{{ route('admin.notas.edit', $nota) }}" class="btn btn-sm btn-primary" >Editar</a>
				  	</td>
				  	<td width="10px">
						<form method="POST" action="{{ route('admin.notas.destroy', $nota) }}">
							@csrf
							@method('DELETE')
							<button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
						</form>
					</td>
				  </tr>
				@endforeach
			@else
			    <tr>
			    	<td>No hay notas</td>		                
			    	<td></td>
			    	<td></td>
			    </tr>
			@endif
			@if($notas_completas == 1 && $tiene_nota_recuperatoria == 1)
			@else
				<tr>
					<form wire:submit.prevent="submit">
					<td>
						<input type="text" name="descripcion" wire:model="descripcion" class="form-control" placeholder="Nueva nota">
						@error('descripcion')  <small class="text-danger">{{ $message }}</small> @enderror
					</td>
					<td>
						<select name="tipo" wire:model="tipo" class="form-control" placeholder="tipo">
							<option value="0" selected>Nota Regular</option>
							<option value="1">Nota Recuperatoria</option>
						</select>
						@error('tipo')  <small class="text-danger">{{ $message }}</small> @enderror
						@error('tiene_nota_recuperatoria')  <small class="text-danger">{{ $message }}</small> @enderror
					</td>
					<td>
						<input type="number" step="0.01" name="valor" wire:model="valor" class="form-control" placeholder="valor">
						@error('valor')  <small class="text-danger">{{ $message }}</small> @enderror
						@error('notas_completas')  <small class="text-danger">{{ $message }}</small> @enderror
					</td>
					<td colspan="2"> 
						<input type="submit" value="Guardar" wire:loading.attr="disabled" wire:target="submit" class="btn btn-sm btn-primary disabled:opacity-25">
					</td>
					</form>
				</tr>
			@endif
			</tbody>
		</table>
	</div>
</div>