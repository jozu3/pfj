<table class="table table-striped">
    <thead>
        <tr>
            <th>Nombres</th>
            <th>Apellidos</th>
            <th>Estaca</th>
            <th>Asignación</th>
            <th>Familia</th>
            {{-- <th>Grupo - Compañerismo</th> --}}
            <th>Telefono</th>
            <th>Correo electrónico</th>
            <th>Pre-Inscripción</th>
            <th>Activo</th>
            {{-- <th>Recomendación para el templo</th>
            <th>Permiso del obispo</th> --}}
        </tr>
    </thead>
    <tbody>
        @forelse ($inscripciones as $inscripcione)
            <tr>
                <td>
                    {{ $inscripcione->personale->contacto->nombres }}
                </td>
                <td>{{ $inscripcione->personale->contacto->apellidos }}</td>
                <td>
                    {{ $inscripcione->personale->barrio->estaca->nombre }}
                </td>
                <td>
                    {{ $inscripcione->role->name }}
                    @forelse ($inscripcione->funciones as $funcione)
                        {{ ' - ' . $funcione->descripcion }}
                    @empty
                    @endforelse

                </td>
                @if ($inscripcione->role->name == 'Matrimonio Director' || $inscripcione->role->name == 'Matrimonio de Logística' || $inscripcione->role->name == 'Coordinador')
                    <td>{{ $inscripcione->role->name }}</td>
                @else
                    @if ($inscripcione->inscripcioneCompanerismo != null)
                        <td>
                            {{ $inscripcione->inscripcioneCompanerismo->companerismo->grupo->numero }}
                        </td>
                    @else
                        <td>
                            No tiene compañero(a)
                        </td>
                    @endif
                @endif
                <td>
                    {{ $inscripcione->personale->contacto->telefono }}
                </td>
                <td>
                    @if ($inscripcione->personale->user)
                        {{ $inscripcione->personale->user->email }}
                    @else
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
                    @switch($inscripcione->estado)
                    @case(1)
                        {{ 'Sí' }}
                    @break

                    @case(0)
                        {{ 'No' }}
                    @break
                    @default
                @endswitch
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="100%">
                    <div class=" text-warning">
                        {{ 'No hay personal' }}
                    </div>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>