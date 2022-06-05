<div>
    <div class="card">
        <div class="card-header">
            <div class="form-row">
                <div class="col">
                    <input wire:model="search" class="form-control" placeholder="Ingrese nombre de un personal">
                </div>
                <div class="col">
                    <select name="" id="" class="form-control" wire:model="familia">
                        <option value="">-- Familias --</option>
                        @foreach ($familias as $familia)
                            <option value="{{ $familia->id }}">{{ $familia->nombre.' '.$familia->numero }}</option>  
                        @endforeach
                    </select>

                </div>
                <div class="col">
                    <select name="" id="" class="form-control" wire:model="aprobacion">
                        <option value="">-- Estado de Aprobación --</option>
                        <option value="0">Cancelado</option>
                        <option value="1">Aprobación pendiente</option>
                        <option value="2">Aprobado</option>
                    </select>

                </div>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th></th>
                        <th>Nombres</th>
                        <th>Apellidos</th>
                        <th>Familia</th>
                        <th>Aprobación final</th>
                    </tr>
                </thead>
                <tbody>
                @forelse ($inscripciones as $inscripcione)
                        <tr>
                            <td>
                                @if (\App\Models\Inscripcione::find($inscripcione->inscripciones_id)->personale->user)
                                    <img id="imgperfil" class="rounded-circle" width="50" height="50" src=" {{ \App\Models\Inscripcione::find($inscripcione->inscripciones_id)->personale->user->adminlte_image() }}" alt="">
                                @endif
                            </td>
                            <td>
                                {{ $inscripcione->contactos_nombres }}
                            </td>
                            <td>{{ $inscripcione->contactos_apellidos }}</td>
                            <td>
                                @php
                                    $ic = \App\Models\InscripcioneCompanerismo::where('inscripcione_id',$inscripcione->inscripciones_id)->first();
                                    if($ic){
                                        echo $ic->companerismo->grupo->numero;
                                    }
                                @endphp
                            </td>
                            <td>
                                @switch($inscripcione->permiso_obispo)
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
                                    onchange="Livewire.emit('changeAprob', {{ $inscripcione->personales_id }}, value)" >
                                    <option class="text-danger bg-white" value="0"  
                                        @if ($inscripcione->permiso_obispo == 0)
                                        selected 
                                        @endif
                                        >Cancelado</option>
                                    <option class="text-warning bg-white" value="1" 
                                        @if ($inscripcione->permiso_obispo == 1)
                                        selected
                                        @endif
                                        >Aprobación pendiente</option>                                   
                                    <option class="text-info bg-white" value="2" 
                                        @if ($inscripcione->permiso_obispo == 2) 
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
                                <a href="{{ route('admin.contactos.show', $inscripcione->contactos_id) }}" class="btn btn-primary" ><i class="fas fa-user-edit"></i></a>
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
            @include('admin.programas.partials.card-footer-personal')
        </div>
    </div>

</div>
