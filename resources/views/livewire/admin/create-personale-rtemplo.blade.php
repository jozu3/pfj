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
                {{$rtemplo}}

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
                        <img id="imgperfil" class="rounded-circle" width="50" height="50" src="{{ $inscripcione->personale->user->adminlte_image() }}" alt="">
                    </td>
                    <td>
                        {{ $inscripcione->personale->contacto->nombres }}
                    </td>
                    <td>
                        {{ $inscripcione->personale->contacto->apellidos }}
                    </td>
                    <td>
                        @if ($inscripcione->inscripcioneCompanerismo)
                            {{ $inscripcione->inscripcioneCompanerismo->companerismo->grupo->numero }}
                        @endif
                    </td>
                    <td class="font-weight-bold">
                        @if ($inscripcione->personale->estado_rtemplo == 1)
                        <span class="bg-success p-1 rounded-lg">
                            {{ 'Sí' }}
                        </span>
                        @else
                        @if ($inscripcione->personale->estado_rtemplo == 0)
                        <span class="bg-danger p-1 rounded-lg">                            
                            {{ 'No' }}
                        </span>
                        @endif
                        @endif
                        @if ($inscripcione->personale->obs_rtemplo)
                        <span class="bg-warning p-1 rounded-lg">                            
                             {{$inscripcione->personale->obs_rtemplo }}
                        </span>
                        @endif
                    </td>
                    <td width="10px">
                        <a href="{{ route('admin.contactos.show', $inscripcione->personale->contacto) }}" class="btn btn-primary" ><i class="fas fa-user-edit"></i></a>
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
        {{ $inscripciones->links() }}
    </div>
</div>
</div>
