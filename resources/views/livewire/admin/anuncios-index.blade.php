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
                        <td>{{ $anuncio->tipo }}</td>
                        <td>{{ $anuncio->estado }}</td>
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
