<div>
    <div class="card">
        <div class="card-header">
            <input wire:model="search" class="form-control" placeholder="Ingrese nombre de un personal">
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th></th>
                        <th>Nombres</th>
                        <th>Apellidos</th>
                        <th>Aprobación final</th>
                    </tr>
                </thead>
                <tbody>
                @forelse ($inscripciones as $inscripcione)
                        <tr>
                            <td>
                                <img id="imgperfil" class="rounded-circle" width="50" height="50" src="{{ $inscripcione->personale->user->adminlte_image() }}" alt="">
                            </td>
                            <td>
                                {{ $inscripcione->personale->contacto->nombres }}
                            </td>
                            <td>{{ $inscripcione->personale->contacto->apellidos }}</td>
                            <td>
                                @switch($inscripcione->personale->permiso_obispo)
                                    @case(0)
                                        @php $color = 'danger'@endphp
                                        @break
                                    @case(1)
                                        @php $color = 'warning'@endphp
                                        @break
                                    @case(2)
                                        @php $color = 'info'@endphp
                                        @break
                                    @default
                                        
                                @endswitch
                                <select name="permiso_obispo" id="permiso_obispo" class="form-control btn-{{$color}} text-white"  
                                    onchange="Livewire.emit('changeAprob', {{ $inscripcione->personale->id }}, value)" >
                                    <option class="text-danger bg-white" value="0"  
                                        @if ($inscripcione->personale->permiso_obispo == 0)
                                        selected 
                                        @endif
                                        >Cancelado</option>
                                    <option class="text-warning bg-white" value="1" 
                                        @if ($inscripcione->personale->permiso_obispo == 1)
                                        selected
                                        @endif
                                        >Aprobación pendiente</option>                                   
                                    <option class="text-info bg-white" value="2" 
                                        @if ($inscripcione->personale->permiso_obispo == 2) 
                                        selected 
                                        @endif
                                        >Aprobado</option>
                                    
                                </select>
                            </td> 
                            {{-- <td>
                                {{ $inscripcione->estado }}
                            </td>
                             --}}
                            <td width="10px">
                                <a href="{{ route('admin.contactos.show', $inscripcione->personale->contacto) }}" class="btn btn-primary" ><i class="fas fa-user-edit"></i></a>
                            </td>
                            {{-- <td width="10px">
                                <a href="{{ route('admin.inscripciones.show', $inscripcione) }}" class="btn btn-primary"><i class="fas fa-edit"></i></a>
                            </td> --}}
                        </tr>
                @empty
                <tr>
                    <td colspan="100%">
                        <div class="card">
                            <div class="card-header text-warning">
                                {{ 'No hay personal' }}
                            </div>
                        </div>
                        
                    </td>
                </tr>
                @endforelse
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            {{ $inscripciones->links() }}
        </div>
    </div>

</div>
