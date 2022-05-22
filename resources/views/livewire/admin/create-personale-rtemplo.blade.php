<div>
    <div class="card-header">
        {{-- <input wire:model="search" class="form-control" placeholder="Ingrese nombre de un personal"> --}}
    </div>
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
                    <td>{{ $inscripcione->personale->contacto->apellidos }}</td>
                    <td>
                        @if ($inscripcione->inscripcione_companerismo)
                            {{ $inscripcione->inscripcione_companerismo->companerismo->grupo->numero }}
                        @endif
                    </td>
                    <td>
                        @if ($inscripcione->personale->estado_rtemplo == 1)
                        {{ 'Sí' }}
                        @else
                        {{ 'No' }}
                        @endif
                        @if ($inscripcione->personale->obs_rtemplo)
                        {{ ' - '}} <span class="text-danger"> {{$inscripcione->personale->obs_rtemplo }}</span>
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
