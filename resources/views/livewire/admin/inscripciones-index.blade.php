<div wire:init="loadInscripciones">
    <div class="card">
    	<div class="card-header">
    		<input wire:model="search" class="form-control" placeholder="Ingrese el nombre o apellido de un personale">
            <div class="form-check mt-2 d-inline">
              <input class="form-check-input" wire:model= "estado_habilitado" type="checkbox" id="estado_habilitado">
              <label class="form-check-label" for="estado_habilitado">
                Ver habilitados
              </label>
            </div>
            <div class="form-check mt-2 d-inline">
              <input class="form-check-input" wire:model= "estado_retirado" type="checkbox" id="estado_retirado">
              <label class="form-check-label" for="estado_retirado">
                Ver retirados
              </label>
            </div>
            <div class="form-check mt-2 d-inline">
              <input class="form-check-input" wire:model= "estado_suspendido" type="checkbox" id="estado_suspendido">
              <label class="form-check-label" for="estado_suspendido">
                Ver suspendidos
              </label>
            </div>
    	</div>
        @if ($inscripciones->count())
    	<div class="card-body">
    		<table class="table table-striped">
    			<thead>
    				<tr>
              <th>Id</th>
              <th>Apellidos</th>
              <th>Nombres</th>
              <th>Telefono</th>
              <th>Correo electrónico</th>
              <th>Fecha de inscripción</th>
              <th>Sesión</th>
              <th>Asignación</th>
              <th>Estado</th>
    				</tr>
    			</thead>
    			<tbody>
    				@foreach($inscripciones as $inscripcione)
    				  <tr>
                
                <td>{{ $inscripcione->id }}</td>
                <td>{{ $inscripcione->personale->contacto->nombres }}</td>
                <td>{{ $inscripcione->personale->contacto->apellidos }}</td>
                <td>{{ $inscripcione->personale->contacto->telefono }}</td>
                <td>{{ $inscripcione->personale->user->email }}</td>                        
                <td>{{ date('d/m/Y', strtotime($inscripcione->fecha)) }}</td>
                <td>{{ $inscripcione->programa->nombre }}</td>
                <td>{{ $inscripcione->role->name }}</td>
                <td>
                    @switch($inscripcione->estado)
                        @case(0)
                            {{ 'Habilitado' }}
                            @break
                        @case(1)
                            {{ 'Retirado' }}
                            @break
                        @case(2)
                            {{ 'Suspendido' }}
                            @break
                        @default
                    @endswitch
                </td>
                <td width="10px">
                  <a href="{{ route('admin.inscripciones.show', $inscripcione) }}" class="btn btn-primary">Ver</a>
                </td>
                @can('admin.inscripciones.destroy')
                <td width="10px">
                    <form method="POST" class="eliminar-inscripcione" action="{{ route('admin.inscripciones.destroy', $inscripcione) }}">
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
            {{ $inscripciones->links() }}
        </div>
        @else
            <div class="card-body">
                <b>No hay inscripciones</b>        
            </div>
        @endif
    </div>
</div>