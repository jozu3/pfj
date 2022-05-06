<div wire:init="load">
    <div class="card">
    	<div class="card-header">
            <div class="form-row align-items-center">
                <div class="col-md-10 my-1">
                	<input wire:model="search" class="form-control" style="" placeholder="Ingrese  código de inscripcione para ver los obligaciones correspondientes">
                </div>
                <div class="col-md-1 my-1">
                    <div style="text-align:right; font-weight:bold">Mostrar:</div>
                </div>
                <div class="col-md-1 my-1">
                    <label class="mr-sm-2 sr-only" for="inlineFormCustomSelect">Preference</label>
                    <select class="custom-select mr-sm-2" wire:model="cant" id="inlineFormCustomSelect">
                        <option value="15">15</option>
                        <option value="30">30</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                </div>
            </div>
            <div class="form-row align-items-center">
                <div class="form-check mx-2">
                  <input class="form-check-input" wire:model= "vertodas" type="checkbox" id="vertodas">
                  <label class="form-check-label" for="vertodas">
                    Ver todas
                  </label>
                </div>
                @if (!$vertodas)
                <div class="col-auto my-1">
                    <label class="ml-1" for="">Mes</label>
                </div>
                <div class="col-auto my-1 mx-2">
                    <select wire:model="mes" class="form-control">
                        <option value="01">Enero</option>
                        <option value="02">Febrero</option>
                        <option value="03">Marzo</option>
                        <option value="04">Abril</option>
                        <option value="05">Mayo</option>
                        <option value="06">Junio</option>
                        <option value="07">Julio</option>
                        <option value="08">Agosto</option>
                        <option value="09">Septiembre</option>
                        <option value="10">Octubre</option>
                        <option value="11">Noviembre</option>
                        <option value="12">Diciembre</option>
                    </select>
                </div>
                <div class="col-auto my-1">
                    <label class="ml-1" for="">Año</label>
                </div>
                <div class="col-auto my-1 mx-2">
                    <select wire:model="year" class="form-control">
                       @foreach ($years as $y)
                            <option value="{{$y->year}}">{{ $y->year}}</option>
                       @endforeach
                    </select>
                </div>
                @endif
                <div class="col-auto my-1">
                    <label class="ml-1" for="">Estado</label>
                </div>
                <div class="col-auto my-1 mx-2">
                    <select wire:model="estado" class="form-control">
                        <option value="-1"> -Todas- </option>
                        <option value="0">Exonerado</option>
                        <option value="1">Por pagar</option>
                        <option value="2">Parcial</option>
                        <option value="3">Pagado</option>
                    </select>
                </div>
                <div class="col-auto my-1">
                    <label class="ml-1" for="">Vendedor</label>
                </div>
                <div class="col-auto my-1 mx-2">
                    <select wire:model="vendedor" class="form-control">
                        <option value="-1"> -Todos- </option>
                        @foreach ($personales as $personal)
                            <option value="{{ $personal->id }}">{{ $personal->user->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
    	</div>
        @if ($obligaciones->count())
    	<div class="card-body" style="overflow-x: auto">
    		<table class="table table-striped">
    			<thead>
    				<tr>
                        <th>Código de matrícula</th>
                        <th>Personale</th>
    					<th>Concepto</th>
                        <th>Fecha de vencimiento</th>
    					<th>Estado</th>
                        <th>Monto pagado</th>
                        <th>Monto final</th>
                        <th>Vendedor</th>
    				</tr>
    			</thead>
    			<tbody>
    				@foreach($obligaciones as $obligacione)
    				  <tr>
                        <td>{{ $obligacione->inscripcione->id }}</td>
                        <td>{{ $obligacione->inscripcione->personale->contacto->nombres.' '.$obligacione->inscripcione->personale->contacto->apellidos }}</td>
    				  	<td>
                            <a href="{{ route('admin.inscripciones.edit', $obligacione->inscripcione)}}"> {{ $obligacione->id.' - '. $obligacione->concepto }}
                            </a>   
                        </td>
                        <td>{{ date('d/m/Y', strtotime($obligacione->fechalimite)) }}</td>
                        <td>
                            @switch ($obligacione->estado)
                                @case(0)
                                    Exonerado
                                    @break
                                @case(1)
                                    Por pagar
                                    @break
                                @case(2)
                                    Parcial
                                    @break
                                @case(3)
                                    Pagado
                                    @break
                            @endswitch
                            @if ($obligacione->fechapagadototal > $obligacione->fechalimite)
                                <small class="text-danger">({{ date('d/m/Y', strtotime($obligacione->fechapagadototal)) }})</small>
                            @endif
                        </td>
                        <td>{{ $obligacione->montopagado }}</td>
                        <td>{{ $obligacione->montofinal }}</td>
                        <td>{{ $obligacione->inscripcione->personale->contacto->personal->user->name }}</td>
    				  	<td width="10px">
    				  	</td>
    				  </tr>
    				@endforeach
    			</tbody>
    		</table>
    	</div>
        <div class="card-footer">
            {{ $obligaciones->links() }}
        </div>
        @else
            <div class="card-body">
                <b>No hay registros</b>        
            </div>
        @endif
    </div>
</div>