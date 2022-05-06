<div>
    <div class="card">
    	<div class="card-header">
    		<input wire:model="search" class="form-control" placeholder="Ingrese nombre de contacto o pfj">
    	</div>
        @if ($seguimientos->count())
    	<div class="card-body">
    		<table class="table table-striped">
    			<thead>
    				<tr>
                        <th wire:click="sortBy('fecha')" style="cursor:pointer">Fecha
                            @include('partials._sort-icon', ['field' => 'fecha'])
                        </th>
    					<th wire:click="sortBy('nombres')" style="cursor:pointer;">Contacto
                            @include('partials._sort-icon', ['field' => 'nombres'])
                        </th>
    					<th wire:click="sortBy('pfjs.nombre')" style="cursor:pointer">Pfj
                            @include('partials._sort-icon', ['field' => 'pfjs.nombre'])
                        </th>
                        <th>Comentario</th>
                        <th>Vendedor actual</th>
    					<th></th>
    				</tr>
    			</thead>
    			<tbody>
    				@foreach($seguimientos as $seguimiento)
    				  <tr>
                        <td>{{ $seguimiento->fecha }}</td>
    				  	<td> <b> {{ $seguimiento->nombres }}</b></td>
                        <td>{{ $seguimiento->nombre }}</td>
                        <td>{{ $seguimiento->comentario }}</td>
    				  	<td>{{ $seguimiento->personal->user->name}}</td>
    				  	<td width="10px">
    				  		<a href="{{ route('admin.contactos.show', $seguimiento->contacto) }}" class="btn btn-primary" >Editar</a>
    				  	</td>
    				  </tr>
    				@endforeach
    			</tbody>
    		</table>
    	</div>
        <div class="card-footer">
            {{ $seguimientos->links() }}
        </div>
        @else
            <div class="card-body">
                <b>No hay registros</b>        
            </div>
        @endif
    </div>
</div>
