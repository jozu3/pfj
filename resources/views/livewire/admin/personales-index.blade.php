<div>
    <div class="card">
    	<div class="card-header">
    		<input wire:model="search" class="form-control" placeholder="Ingrese nombre de un personal">
    	</div>
        @if ($personales->count())
    	<div class="card-body">
    		<table class="table table-striped">
    			<thead>
    				<tr>
    					<th>Nombres</th>
    					<th>Apellidos</th>
                        <th>Telefono</th>
    					<th>Correo electrónico</th>
    				</tr>
    			</thead>
    			<tbody>
    				@foreach($personales as $personal)
    				  <tr>
                        <td>{{ $personal->contacto->nombres }}</td>
    				  	<td>{{ $personal->contacto->apellidos }}</td>
                        <td>{{ $personal->contacto->telefono }}</td>
    				  	<td>
                            @if ( $personal->user)
                            {{ $personal->user->email }}
                            @else
                            <a href="{{ route('admin.users.create', ['personale' => $personal]) }}" class="btn btn-primary" >Crear usuario</a>
                            @endif
                        </td>
    				  	<td width="10px">
    				  		<a href="{{ route('admin.personales.edit', ['personale' => $personal]) }}" class="btn btn-primary" >Editar</a>
    				  	</td>
						  @can('admin.personales.destroy')
						  <td width="10px">
							<form method="POST" class="eliminar-personales" action="{{ route('admin.personales.destroy', $personal) }}">
							  @csrf
							  @method('DELETE')
							  <button type="submit" class="btn btn-sm btn-danger ">Eliminar</button>
							</form>
						  </td>
						  @endcan
    				  </tr>

    				@endforeach

    			</tbody>
    		</table>
    	</div>
        <div class="card-footer">
            {{ $personales->links() }}
        </div>
        @else
            <div class="card-body">
                <b>No hay registros</b>        
            </div>
        @endif
    </div>
</div>
