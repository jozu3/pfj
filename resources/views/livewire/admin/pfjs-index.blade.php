<div>
    <div class="card">
    	<div class="card-header">
    		<input wire:model="search" class="form-control" placeholder="Ingrese nombre de un pfj">
            <div class="form-check mt-1">
              <input class="form-check-input" wire:model= "estado" type="checkbox" value="" id="flexCheckDefault">
              <label class="form-check-label" for="flexCheckDefault">
                Solo pfjs activos
              </label>
            </div>
    	</div>
        @if ($pfjs->count())
    	<div class="card-body">
    		<table class="table table-striped">
    			<thead>
    				<tr>
    					<th>Pfj</th>
                        <th>Estado</th>
                        <th width="200px">Sesiones por inciciar</th>
                        <th width="200px">Sesiones Iniciados</th>
                        <th width="200px">Sesiones terminados</th>
                        @can('admin.pfjs.edit')
    					<th colspan="2"></th>
                        @endcan
    				</tr>
    			</thead>
    			<tbody>
    				@foreach($pfjs as $pfj)
    				  <tr>
    				  	<td>{{ $pfj->nombre }}</td>
    				  	<td>
                            @if ($pfj->estado == 0)
                                {{ 'Discontinuado' }}
                            @endif
                            @if ($pfj->estado == 1)
                                {{ 'Activo' }}
                            @endif
                        </td>
                        <td>{{-- programas por iniciar --}}
                            @php 
                            $gru_pini = 0
                            @endphp
                            @foreach ($pfj->programas as $programa)
                                @if ($programa->estado == 0)
                                    @php
                                     $gru_pini++ 
                                    @endphp
                                 @endif  
                            @endforeach
                            {{ $gru_pini }}
                        </td>
                        <td>{{-- programas iniciados --}}
                            @php
                            $gru_ini = 0
                            @endphp
                            @foreach ($pfj->programas as $programa)
                                @if ($programa->estado == 1)
                                    @php
                                     $gru_ini++ 
                                    @endphp
                                 @endif  
                            @endforeach
                            {{ $gru_ini }}
                        </td>
                         <td>{{-- programas terminados --}}
                            @php
                            $gru_termin = 0
                            @endphp
                            @foreach ($pfj->programas as $programa)
                                @if ($programa->estado == 2)
                                    @php
                                     $gru_termin++ 
                                    @endphp
                                 @endif  
                            @endforeach
                            {{ $gru_termin }}
                        </td>
                        @can('admin.pfjs.edit')
    				  	<td width="10px">
    				  		<a href="{{ route('admin.pfjs.edit', $pfj) }}" class="btn btn-sm btn-primary" >Editar</a>
    				  	</td>
                        @endcan
                        @can('admin.pfjs.destroy')
    				  	<td width="10px">
							<form method="POST" action="{{ route('admin.pfjs.destroy', $pfj) }}">
								@csrf
								@method('DELETE')
								<button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
							</form>
						</td>
                        @endcan
    				  </tr>
    				@endforeach

    			</tbody>
    		</table>
    	</div>
        <div class="card-footer">
            {{ $pfjs->links() }}
        </div>
        @else
            <div class="card-body">
                <b>No hay registros</b>        
            </div>
        @endif
    </div>
</div>
