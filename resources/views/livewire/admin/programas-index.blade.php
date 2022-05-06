<div>
    <div class="card">
    	<div class="card-header">
            @if (isset($pfj_id) || $mis_programas == true)
            @can('admin.programas.create')
                <a href="{{ route('admin.programas.create', 'idpfj='.$pfj_id) }}" class="btn btn-success btn-sm float-right">Nueva sesión</a>
            @endcan
            @else
                <div class="form-row align-items-center">
                <div class="col-md-10 my-1">
                    <input wire:model="search" class="form-control" placeholder="Ingrese nombre de un pfj">
                </div>
                <div class="col-md-1 my-1">
                    <div style="text-align:right; font-weight:bold">Mostrar:</div>
                </div>
                <div class="col-md-1 my-1">
                  <select class="custom-select mr-sm-2" wire:model="cant" id="inlineFormCustomSelect">
                    <option value="15">15</option>
                    <option value="30">30</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                  </select>
                </div>
              </div>
            @endif
            <div class="form-row align-items-center">
                <div class="col-auto my-1">
                  <div class="custom-control custom-checkbox mr-sm-2 d-inline">
                    <input class="form-check-input" wire:model= "poriniciar" type="checkbox" value="" id="poriniciar">
                    <label class="form-check-label" for="poriniciar">
                    Por iniciar
                    </label>
                  </div>
                  <div class="custom-control custom-checkbox mr-sm-2 d-inline">
                    <input class="form-check-input" wire:model= "iniciado" type="checkbox" value="" id="iniciado">
                    <label class="form-check-label" for="iniciado">
                    Iniciado
                    </label>
                  </div>
                  <div class="custom-control custom-checkbox mr-sm-2 d-inline">
                    <input class="form-check-input" wire:model= "terminado" type="checkbox" value="" id="terminado">
                    <label class="form-check-label" for="terminado">
                    	Terminado
                    </label>
                  </div>
                  <div class="custom-control custom-checkbox mr-sm-2 d-none">
                    <input class="form-check-input" wire:model= "mis_programas" type="checkbox" disabled id="mis_programas" >
                    <label class="form-check-label" for="mis_programas">
                    	Mis programas
                    </label>
                  </div>
                </div>
            </div>
    	</div>
        @if ($programas->count())
    	<div class="card-body overflow-auto">
    		<table class="table table-striped">
    			<thead>
    				<tr>
                        <th>ID</th>
    					<th>Sesión</th>
    					<th colspan="2" >Matrimonio Director</th>
    					<th>Fecha</th>
                        <th>Estado</th>
                        <th>Personal</th>
                        {{-- @if (!auth()->user()->hasRole('Profesor')) --}}
                        <th>Grupos</th>
                        {{-- @else --}}
                        {{-- @endif --}}
                        @can('admin.programas.edit')
    					<th colspan="1"></th>
                        @endcan
    				</tr>
    			</thead>
    			<tbody>
    				@foreach($programas as $programa)
    				  <tr>
                        <td>{{ $programa->id }}</td>
    				  	<td>{{ $programa->nombre }}</td>
                        <td>
                            @if ($programa->imageMatrimonioDirector)
                                <img class="rounded-circle avatar-circle" src="{{ Storage::url($programa->imageMatrimonioDirector->url) }}" alt="">
                            @endif
                        </td>
    				  	<td class="font-weight-bold text-pfj">
                              @foreach ($programa->matrimonioDirectores() as $mdirector)
                                {{$mdirector->personale->user->name}}<br>
                              @endforeach
                        </td>
    				  	<td>
                            {{ date('d/m/Y', strtotime($programa->fecha_inicio)) }} - 
                            <br>
                            {{ date('d/m/Y', strtotime($programa->fecha_fin)) }}
                        </td>
    				  	<td>
                            @if ( $programa->estado == '0')
                                {{ 'Por iniciar' }}
                            @endif
                            @if ( $programa->estado == '1')
                                {{ 'Iniciado' }}
                            @endif
                            @if ( $programa->estado == '2')
                                {{ 'Terminado' }}
                            @endif
                        </td>
                        <td>
                            {{-- @if (auth()->user()->hasRole('Profesor')) --}}
                                {{-- {{auth()->user()->profesore->programasqueenseño($programa->id)->count()}} --}}
                            {{-- @else --}}
                                {{ $programa->inscripciones->count() }}
                            {{-- @endif --}}
                        </td>
                        <td>
                            {{ $programa->grupos->count() }}
                        </td>
                        @can('admin.programas.edit')
    				  	<td width="10px">
                            <a href="{{ route('admin.programas.edit', $programa) }}" class="btn btn-sm btn-yellow-pfj " alt="Administrar sesión" data-toggle="tooltip" data-placement="top" title="Administrar sesión"><i class="fas fa-cogs"></i></a>
                        </td>
                        @endcan
                        @can(['admin.programas.edit'])
                        <td width="10px">
                            <a href="{{ route('admin.programas.show', $programa) }}" class="btn btn-sm btn-yellow-pfj " alt="Personal" data-toggle="tooltip" data-placement="top" title="Personal"><i class="fas fa-user-friends"></i></a>
                        </td>
                        @endcan
                        @can('admin.programas.destroy')
    				  	<td width="10px">
							<form method="POST" action="{{ route('admin.programas.destroy', $programa) }}">
								@csrf
								@method('DELETE')
								<button type="submit" class="btn btn-sm btn-danger" alt="Eliminar" data-toggle="tooltip" data-placement="top" title="Eliminar"><i class="fas fa-trash"></i></button>
							</form>
						</td>
                        @endcan
                        <td>
                        </td>
                        @can('admin.inscripcioneCompanerismos.edit')                            
                        <td width="10px">
                            <a href="{{ route('admin.programas.asignar', $programa) }}" 
                            class="btn btn-success btn-sm float-right mr-3" alt="Organigrama" data-toggle="tooltip" data-placement="top" title="Organigrama">
                            <i class="fas fa-sitemap"></i></a>
                        </td>
                        @endcan
    				  </tr>
    				@endforeach

    			</tbody>
    		</table>
    	</div>
        <div class="card-footer">
            {{ $programas->links() }}
        </div>
        @else
            <div class="card-body">
                <b>No hay registros</b>        
            </div>
        @endif
    </div>
</div>
