<div>
	@if (session('info_grupo'))
        <div class="alert alert-success">
            {{ session('info_grupo') }}
        </div>
    @endif
	@if ($info_grupo != '')
        <div class="alert alert-success">
            {{ $info_grupo }}
        </div>
    @endif
    <table class="table table-striped">
    	<thead>
    		<tr>
				<th></th>
    			<th>Nombre de grupo</th>
    			<th>Número de grupo</th>
    			<th></th>
    		</tr>
    	</thead>
    	<tbody>
    		@foreach ($grupos as $grupo)
    			<tr>
    				{!! Form::model($grupo, ['route' => ['admin.grupos.update', $grupo], 'method' => 'put']) !!}
					<td width="5px">
						<a class="btn dropdown-toggle" data-toggle="collapse" id="comps-{{ $grupo->id }}" href="#list-companerismos{{ $grupo->id }}" role="button" aria-expanded="false" aria-controls="list-companerismos{{ $grupo->id }}">
							<b>Compañerismos</b>
						</a>
					</td>
    				<td>
    					{!! Form::text('nombre', null, ['class' => 'form-control']) !!}
					</td>
                    <td>
    					{!! Form::text('numero', null, ['class' => 'form-control']) !!}
					</td>
					<td width="10px">
						<button type="submit" class="btn btn-sm btn-primary"><i class="fas fa-save"></i></button>
    				</td>
    				{!! Form::close() !!}
					<td width="10px">
						<form method="POST" action="{{ route('admin.grupos.destroy', $grupo) }}">
							@csrf
							@method('DELETE')
							<button type="submit" class="btn btn-sm btn-danger">
								<i class="fas fa-trash-alt"></i>
							</button>
						</form>
					</td>
    			</tr>
				<tr>
					<td colspan="5">
						<div class="collapse multi-collapse" id="list-companerismos{{ $grupo->id }}">
							<div class="row">
								<div class="col-3 px-4 py-2">
									<b>Nombre</b>
								</div>
								<div class="col-3 px-4 py-2">
									<b>Número de compañia</b>
								</div>
								<div class="col-3 px-4 py-2">
									<b>Rol</b>
								</div>
								<div class="col-3 px-4 py-2">
								</div>
							</div>
							@foreach ($grupo->companerismos as $companerismo)
							{!! Form::model($companerismo, ['route' => ['admin.companerismos.update', $companerismo], 'method' => 'put']) !!}
							<div class="row">
								<div class="col-3 mb-3">
									{!!Form::hidden('grupo_id', null) !!}
									{!! Form::text('nombre', null, ['class' => 'form-control']) !!}
								</div>
								<div class="col-3 mb-3">
									{!! Form::number('numero', null, ['class' => 'form-control']) !!}
								</div>
								<div class="col-3 mb-3">
									{!! Form::select('role_id', $roles, null, ['class' => 'form-control ', 'placeholder' => 'Escoge un rol']); !!}
									@error('role_id')
									<small class="text-danger">{{ $message }}</small>
									@enderror
								</div>
								<div class="col-3 mb-3">
									{!! Form::submit('Actualizar',  ['class' => 'btn btn-sm btn-primary'])!!}
								</div>
							</div>
							{!! Form::close() !!}
							@endforeach
							{!! Form::open( ['route' => 'admin.companerismos.store']) !!}
							<div class="row">
								<div class="col-3 mb-3">
									{!!Form::hidden('grupo_id', $grupo->id) !!}
									{!! Form::text('nombre', null, ['class' => 'form-control', 'placeholder' => 'Nuevo compañerismo']) !!}
								</div>
								<div class="col-3 mb-3">
									{!! Form::number('numero', null, ['class' => 'form-control']) !!}
								</div>
								<div class="col-3 mb-3">
									{!! Form::select('role_id', $roles, null, ['class' => 'form-control ', 'placeholder' => 'Escoge un rol']); !!}
									@error('role_id')
									<small class="text-danger">{{ $message }}</small>
									@enderror
								</div>
								<div class="col-3 mb-3">
									{!! Form::submit('Guardar',  ['class' => 'btn btn-sm btn-primary'])!!}
								</div>
							</div>
							{!! Form::close() !!}
						</div>
					</td>
				</tr>
    		@endforeach
			<tr>
				<form wire:submit.prevent="">
					<td class="text-center">
						<b>Nuevo grupo:</b>
					</td>
					<td>
						<input type="text" name="nombre_grupo" wire:model="nombre_grupo" class="form-control">
						@error('nombre_grupo')<small class="text-danger">{{ $message }}</small> @enderror
					</td>
					<td>
						<input type="text" name="numero_grupo" wire:model="numero_grupo" class="form-control">
						@error('numero_grupo')<small class="text-danger">{{ $message }}</small> @enderror
					</td>
					<td>
						<input type="submit" value="Guardar"  wire:loading.attr="disabled" wire:click="submit" wire:target="submit" class="btn btn-sm btn-primary disabled:opacity-25">
					</td>
				</form>
			</tr>
    	</tbody>
    </table>	
	<script>
	</script>
</div>
