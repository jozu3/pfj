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
                <select name="" id="" class="form-control" wire:model="rtemplo">
                    <option value="">-- Estado de Aprobación --</option>
                    <option value="0">Vencida</option>
                    <option value="1">Activa</option>
                    <option value="2">Activa con observación</option>
                </select>
            </div>
        </div>
    </div>
    <div class="card-body">

    <table class="table table-striped">
        <thead>
            <tr>
                <th colspan="2">Nombres</th>
                <th>Apellidos</th>
                <th>Familia</th>
                <th>Recomendación para el templo</th>
                {{-- <th>Permiso del obispo</th> --}}
                <th></th>
            </tr>
        </thead>
        <tbody>
        @forelse ($inscripciones as $inscripcione)
                <tr>
                    <td>
                        @if (\App\Models\Inscripcione::find($inscripcione->inscripcione_id)->personale->user)
                            <img id="imgperfil" class="rounded-circle" width="50" height="50" src=" {{ \App\Models\Inscripcione::find($inscripcione->inscripcione_id)->personale->user->adminlte_image() }}" alt="">
                        @else
                            <img id="imgperfil" class="rounded-circle" width="50" height="50" src="https://picsum.photos/300/300" alt="">
                        @endif
                    </td>
                    <td>
                        {{ $inscripcione->contacto_nombres }}
                    </td>
                    <td>
                        {{ $inscripcione->contacto_apellidos }}
                    </td>
                    <td>
                        @php
                            $ic = \App\Models\InscripcioneCompanerismo::where('inscripcione_id',$inscripcione->inscripcione_id)->first();
                            if($ic){
                                echo $ic->companerismo->grupo->numero ;
                            }
                        @endphp
                    </td>
                    <td class="font-weight-bold">
                        @if ($inscripcione->personale_estado_rtemplo == 1)
                        <span class="bg-success p-1 rounded-lg">
                            {{ 'Sí' }}
                        </span>
                        @else
                        @if ($inscripcione->personale_estado_rtemplo == 0)
                        <span class="bg-danger p-1 rounded-lg">                            
                            {{ 'No' }}
                        </span>
                        @endif
                        @endif
                        @if ($inscripcione->personale_obs_rtemplo)
                        <span class="bg-warning p-1 rounded-lg">                            
                             {{$inscripcione->personale_obs_rtemplo }}
                        </span>
                        @endif
                    </td>
                    <td width="10px">
                        @can('admin.contactos.edit')
                            <a href="{{ route('admin.contactos.show', $inscripcione->contacto_id) }}" class="btn btn-primary" ><i class="fas fa-user-edit"></i></a>
                        @endcan
                    </td>
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
