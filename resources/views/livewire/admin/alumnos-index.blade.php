<div>
    <div class="card">
    	<div class="card-header">
    		<input wire:model="search" class="form-control" placeholder="Ingrese nombre de un personale">
    	</div>
        @if ($personales->count())
    	<div class="card-body">
    		<table class="table table-striped">
    			<thead>
    				<tr>
                        <th>Código</th>
    					<th>Nombres</th>
    					<th>Apellidos</th>
                        <th>Telefono</th>
    					<th>Correo electrónico</th>
    				</tr>
    			</thead>
    			<tbody>
    				@foreach($personales as $personale)
    				  <tr>
                        <td>{{ $personale->codigo }}</td>
                        <td>{{ $personale->contacto->nombres }}</td>
    				  	<td>{{ $personale->contacto->apellidos }}</td>
                        <td>{{ $personale->contacto->telefono }}</td>
    				  	<td>
                            @if ( $personale->user)
                            {{ $personale->user->email }}
                            @else
                            <a href="{{ route('admin.users.create', ['personale' => $personale]) }}" class="btn btn-primary" >Crear usuario</a>
                            @endif
                        </td>
                        {{--ver por quienes fue inscripcionedo 
                        <td>
                            @foreach ($personale->inscripciones as $inscripcione)
                                {{ '-'.$inscripcione->personal->user->name }}
                            @endforeach
                        </td>
                        --}}
                        <td width="10px">
                            <a href="{{ route('admin.personales.edit', $personale) }}" class="btn btn-primary" >Ver</a>
                        </td>
                        <td>
                            <a href="{{ route('admin.inscripciones.create', 'idcontacto='.$personale->contacto->id) }}" class="btn btn-success btn-sm float-right">Inscripcioner</a>
                        </td>
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
                <b>No hay personales</b>        
            </div>
        @endif
    </div>
</div>