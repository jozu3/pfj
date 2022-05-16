<div>
    <div class="card">
    	<div class="card-header">
    		<h3>{{ $programa->nombre }}</h3>
    	</div>
        @if ($anuncios->count())
    	<div class="card-body">
    		<table class="table table-striped">
    			<thead>
    				<tr>
                        <th>Anuncio</th>
                        <th>Tipo</th>
                        <th>Estado</th>
    					<th></th>
    				</tr>
    			</thead>
    			<tbody>
    				@foreach($anuncios as $anuncio)
    				  <tr>
                        <td>{{ $anuncio->descripcion }}</td>
                        <td>
							@switch($anuncio->tipo)
							@case(1)
									@php
										$clases = 'bg-danger';
										$tipo = 'Urgente';
										@endphp
									@break
								@case(2)
								@php
										$clases = 'bg-info';
										$tipo = 'Informatico';
										@endphp
									@break
								@case(3)
								@php
									$clases = 'bg-warning';
									$tipo = 'Advertencia';
									@endphp	
								@break
								@default
								
							@endswitch
							<span class="{{ $clases }} p-1 rounded-lg">
								{{$tipo}}
							</span>
						</td>
                        <td>
							@switch($anuncio->estado)
								@case(1)
									{{'Activo'}}
									@break
								@case(2)
									{{'Inactivo'}}
									@break
								@default
									
							@endswitch
						
						</td>
						<td>
							@if ($anuncio->image)
								<img width="80px" src="{{ Storage::url($anuncio->image->url) }}" alt="">
							@endif
						</td>
    				  	<td width="10px">
    				  		<a href="{{ route('admin.anuncios.edit', $anuncio) }}" class="btn btn-primary" >Editar</a>
    				  	</td>
						<td width="10px">
						<form method="POST" action="{{ route('admin.anuncios.destroy', $anuncio) }}">
							@csrf
							@method('DELETE')
							<button type="submit" class="btn btn-sm btn-danger"><i class="fas fa-trash-alt"></i></button>
						</form>
						</td>
    				  </tr>
    				@endforeach
    			</tbody>
    		</table>
    	</div>
        <div class="card-footer">
        </div>
        @else
            <div class="card-body">
                <b>No hay registros</b>        
            </div>
        @endif
    </div>
</div>
