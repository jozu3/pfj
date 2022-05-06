<div>
    <div class="card">
    	<div class="card-header">
    		<input wire:model="search" class="form-control" placeholder="Ingrese nombre de un profesor">
    	</div>
        @if ($profesores->count())
    	<div class="card-body">
    		<table class="table table-striped">
    			<thead>
    				<tr>
    					<th>Nombres</th>
    					<th>Apellidos</th>
                        <th>Telefono</th>
    					<th>Usuario</th>
    				</tr>
    			</thead>
    			<tbody>
    				@foreach($profesores as $profesore)
    				  <tr>
                        <td>{{ $profesore->nombres }}</td>
    				  	<td>{{ $profesore->apellidos }}</td>
                        <td>{{ $profesore->telefono }}</td>
    				  	<td>
                            @if ( $profesore->user)
                                {{ $profesore->user->email }}
                            @else
                                {{ 'No tiene usuario' }}
                            @endif
                        </td>
    				  	<td width="10px">
    				  		<a href="{{ route('admin.profesores.edit', $profesore) }}" class="btn btn-primary" >Editar</a>
    				  	</td>
    				  </tr>
    				@endforeach

    			</tbody>
    		</table>
    	</div>
        <div class="card-footer">
            {{ $profesores->links() }}
        </div>
        @else
            <div class="card-body">
                <b>No hay registros</b>        
            </div>
        @endif
    </div>
</div>
