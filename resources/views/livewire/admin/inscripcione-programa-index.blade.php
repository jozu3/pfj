<div>
    <div class="card-header">
        <input wire:model="search" class="form-control" placeholder="Ingrese nombre de un personal">
    </div>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Asignación</th>
                <th>Grupo - Compañerismo</th>
                <th colspan="2">Nombres</th>
                <th>Apellidos</th>
                <th>Telefono</th>
                <th>Correo electrónico</th>
                <th>Pre-Inscripción</th>
                <th>Recomendación para el templo</th>
                <th>Permiso del obispo</th>
            </tr>
        </thead>
        <tbody>
        @forelse ($inscripciones as $inscripcione)
                <tr>
                    <td>
                        {{ $inscripcione->role->name }}
                        @if ($inscripcione->funcion)
                            {{ ' - '. $inscripcione->funcion}}
                        @endif
                    </td>
                    @if ($inscripcione->role->name == 'Matrimonio Director')
                        <td>{{ $inscripcione->role->name }}</td>
                    @else
                    @if ($inscripcione->role->name == 'Cordinador')
                        <td>{{ $inscripcione->role->name }}</td>
                    @else
                        @if ($inscripcione->inscripcioneCompanerismo != null)
                            
                        <td>
                            {{  $inscripcione->inscripcioneCompanerismo->companerismo->grupo->numero . ' - ' . $inscripcione->inscripcioneCompanerismo->companerismo->numero }}
                        </td>
                        @else
                        <td> No tiene compañero(a)</td>
                        @endif
                    @endif
                    @endif
                    <td>
                        <img id="imgperfil" class="rounded-circle" width="50" height="50" src="{{ $inscripcione->personale->user->adminlte_image() }}" alt="">
                    </td>
                    <td>
                        {{ $inscripcione->personale->contacto->nombres }}
                    </td>
                    <td>{{ $inscripcione->personale->contacto->apellidos }}</td>
                    <td>
                        <span>
                            <a href="tel:{{ $inscripcione->personale->contacto->telefono }}" alt="Llamar por teléfono" data-toggle="tooltip" data-placement="top" title="Llamar por teléfono">{{ $inscripcione->personale->contacto->telefono }}</a>
                            <a href="https://api.whatsapp.com/send?phone=51{{ $inscripcione->personale->contacto->telefono }}" class="text-success" target="_blank" alt="Enviar Whatsapp" data-toggle="tooltip" data-placement="top" title="Enviar Whatsapp"><i class="fab fa-whatsapp"></i></a>
                        </span>
                    </td>
                    <td>
                        @if ( $inscripcione->personale->user)
                            <a href="mailto:{{ $inscripcione->personale->user->email }}" alt="Enviar email" data-toggle="tooltip" data-placement="top" title="Enviar email">{{ $inscripcione->personale->user->email }}</a>
                        @else
                        <a href="{{ route('admin.users.create', ['personale' => $inscripcione->personale]) }}" class="btn btn-primary" >Crear usuario</a>
                        @endif
                    </td>
                    <td>
                        @switch($inscripcione->personale->preinscripcion)
                            @case(1)
                                {{ 'Sí' }}
                                @break
                            @case(0)
                                {{ 'No' }}
                                @break
                            @default
                        @endswitch
                    </td>
                    <td>
                        @if ($inscripcione->personale->estado_rtemplo)
                        {{ 'Sí' }}
                        @endif
                        @if ($inscripcione->personale->obs_rtemplo)
                        {{ ' - '.$inscripcione->personale->obs_rtemplo }}
                        @endif
                    </td>
                    <td>
                        @if ($inscripcione->personale->permiso_obispo)
                            {{ 'Sí' }}
                        @endif
                    </td>
                    
                    <td width="10px">
                        <a href="{{ route('admin.contactos.show', $inscripcione->personale->contacto) }}" class="btn btn-primary" ><i class="fas fa-user-edit"></i></a>
                    </td>
                    <td width="10px">
                        <a href="{{ route('admin.inscripciones.show', $inscripcione) }}" class="btn btn-primary"><i class="fas fa-edit"></i></a>
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
