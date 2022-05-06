<div>
    <div class="card">
    	<div class="card-header">
    		<input wire:model="search" class="form-control" placeholder="Ingrese nombre, apellido o telefono de un contacto">
            <div class="form-check mt-1 d-inline">
              <input class="form-check-input" wire:model= "nocontactado" type="checkbox" value="true" id="nocontac1">
              <label class="form-check-label" for="nocontac1">
                No contactado
              </label>
            </div>
            <div class="form-check mt-1 d-inline">
              <input class="form-check-input" wire:model= "contactado" type="checkbox" value="true" id="contact1">
              <label class="form-check-label" for="contact1">
                Contactado
              </label>
            </div>
            <div class="form-check mt-1 d-inline">
              <input class="form-check-input" wire:model= "probable" type="checkbox" value="true" id="flexCheckDefault1">
              <label class="form-check-label" for="flexCheckDefault1">
                Probable
              </label>
            </div>
            <div class="form-check mt-1 d-inline">
                <input class="form-check-input" wire:model= "confirmado" type="checkbox" value="true" id="flexCheckDefault2">
                <label class="form-check-label" for="flexCheckDefault2">
                  Confirmado
                </label>
            </div>
            <div class="form-check mt-1 d-inline">
            <input class="form-check-input" wire:model= "inscrito" type="checkbox" value="true" id="flexCheckDefault3">
            <label class="form-check-label" for="flexCheckDefault3">
                Inscrito
            </label>
            </div>
    	</div>
        @if ($contactos->count())
    	<div class="card-body">
    		<table class="table table-striped">
    			<thead>
    				<tr>
                        <th>ID</th>
                        <!--https://web.whatsapp.com/send?phone=584141849565-->
                        <th  style="cursor:pointer">
                            <span wire:click="sortBy('nombres')">Nombre</span>
                            @include('partials._sort-icon', ['field' => 'nombres'])
                            <span wire:click="sortBy('newassign')" class="ml-1">Nuevos</span>
                            @include('partials._sort-icon', ['field' => 'newassign'])
                        </th>
    					<th wire:click="sortBy('apellidos')" style="cursor:pointer">Apellidos
                            @include('partials._sort-icon', ['field' => 'apellidos'])
                        </th>
    					<th wire:click="sortBy('telefono')" style="cursor:pointer">Telefono
                            @include('partials._sort-icon', ['field' => 'telefono'])
                        </th>
                        <th wire:click="sortBy('estado')" style="cursor:pointer">Estado
                            @include('partials._sort-icon', ['field' => 'estado'])
                        </th>
                        <th wire:click="sortBy('estaca_id')" style="cursor:pointer">Estaca
                            @include('partials._sort-icon', ['field' => 'estaca_id'])
                        </th>
                        <th wire:click="" style="">Comentarios de su vendedor actual
                        </th>
                        <th wire:click="" style="">Total de comentarios
                        </th>
    					<th colspan="2"></th>
    				</tr>
    			</thead>
    			<tbody>
    				@foreach($contactos as $contacto)
                    <tr>
                        <td>{{ $contacto->id }}</td>
                    	<td>{{ $contacto->nombres }} 
                            @if ($contacto->newassign == 1)
                                <span class="badge badge-success right">N</span>
                            @endif
                        </td>
                    	<td>{{ $contacto->apellidos }}</td>
                    	<td>
                            <span>
                                <a href="tel:{{ $contacto->telefono }}" alt="Llamar por teléfono" data-toggle="tooltip" data-placement="top" title="Llamar por teléfono">{{ $contacto->telefono }}</a>
                                <a href="https://api.whatsapp.com/send?phone=51{{ $contacto->telefono }}" class="text-success" target="_blank" alt="Enviar Whatsapp" data-toggle="tooltip" data-placement="top" title="Enviar Whatsapp"><i class="fab fa-whatsapp"></i></a>
                            </span>
                        </td>
                        <td>
                            @php 
                                $estados = [
                                        '1' => 'No contactado',
                                        '2' => 'Contactado',
                                        '3' => 'Probable',
                                        '4' => 'Confirmado',
                                        '5' => 'Inscrito',
                                    ];
                            @endphp
                            @switch($contacto->estado)
                                @case (1)
                                     {{ $estados['1'] }}
                                @break
                                @case (2)
                                     {{ $estados['2'] }}
                                @break
                                @case (3)
                                     {{ $estados['3'] }}
                                @break
                                @case (4)
                                     {{ $estados['4'] }}
                                @break
                                @case (5)
                                     {{ $estados['5'] }}
                                @break
                            @endswitch
                        </td>
                            @if (Auth::user()->can(['permiso'])) {{-- == 1 || $role->id == 2)--}}
                                <td>
                                {{-- {!! Form::model($contacto, ['route' => ['admin.contactos.update', $contacto], 'method' => 'put']) !!}
                                    {!! Form::hidden('personal_id_logged', auth()->user()->personal->id) !!}
                                    {!! Form::hidden('asignar', 'true') !!}
                                    <span>
        
                                    <select name="personal_id" class="form-control" style="max-width: 150px; display: inline-block">
                                        @foreach ( $personales as $personal)
                                        @if ($personal->id == $contacto->personal->id)
                                            <option value="{{$personal->id }}" selected>{{$personal->nombres.' '.$personal->apellidos }}</option>
                                        @else
                                            <option value="{{$personal->id }}">{{$personal->nombres.' '.$personal->apellidos }}</option>
                                        @endif
                                        @endforeach
                                    </select>
                                    </span>
                                    <span>
                                        
                                        {!! Form::submit('Guardar', ['class' => 'btn btn-sm btn-primary']) !!}
                                    </span>
                                {!! Form::close() !!} --}}
                                </td>
                            @else
                                {{-- <td>
                                    {{ $contacto->personal->nombres.' '.$contacto->personal->apellidos }}
                                </td> --}}
                            @endif
                                <td>
                                    @if ($contacto->personale != null)
                                        {{$contacto->personale->barrio->estaca->nombre}}
                                    @else
                                    {{ 'No se ha registrado' }}
                                    @endif
                                </td>
                                <td>
                                    @php
                                    //cantidad de veces contactadas por mi
                                        $vcp_mi = 0
                                    @endphp 
                                    @foreach($contacto->seguimientos as $segui)
                                        @php
                                            if ($segui->personal->id == $contacto->personal->id){
                                                $vcp_mi++;
                                            }
                                        @endphp
                                    @endforeach
                                    @if ($vcp_mi == 0)
                                        <b class="alert-warning">Ningún comentario</b>
                                    @else
                                        <b class="">{{ $vcp_mi }}</b>
                                    @endif
                                </td>   
                                <td>
                                    {{ count($contacto->seguimientos) }}
                                </td> 
                                            
                        <td width="160px">
                    		<a href="{{ route('admin.contactos.show', $contacto) }}" class="btn btn-success" ><i class="fas fa-file-signature"></i> Ver / Editar</a>
                    	</td>
                    </tr>
    				@endforeach
    			</tbody>
    		</table>
    	</div>
        <div class="card-footer">
            {{ $contactos->links() }}
        </div>
        @else
            <div class="card-body">
                <b>No hay registros</b>        
            </div>
        @endif
    </div>
</div>
