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
            <th>Porcentaje de Asistencia</th>
            <th>Total asistencias</th>
            <th>Total faltas</th>
            <th>Total faltas justificadas</th>
            <th>Total capacitaciones</th>
            <th>Porcentaje de tareas realizadas</th>
            <th>Total de tareas realizadas</th>
            <th>Total de tareas no realizadas</th>
            <th>Total de tareas</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($inscripciones as $inscripcione)
            <tr>
                <td class="bg-primary">
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
                <td class="text-center text-info font-weight-bold align-middle">

                    @if ($capacitaciones->count())
                        @php
                            $porcentaje = round((100 * $inscripcione->asistencias->where('asistencia', '0')->count()) / $capacitaciones->count(), 2);
                            $color_p = 'warning';
                            $color_c = 'warning';
                            if ($porcentaje == 100) {
                                $color_p = 'info';
                                $color_c = 'success';
                            }
                            if ($porcentaje == 0) {
                                $color_p = 'danger';
                                $color_c = 'danger';
                            }
                        @endphp
                        <div class="porcentaje">
                            <span class="bg-{{ $color_p }} rounded-lg p-1 pdiv-porcentaje">
                                {{ $porcentaje / 100 }}
                            </span>

                        </div>
                    @else
                        <span class="text-secondary">{{ 'No ha creado reuniones/capacitaciones.' }}</span>
                    @endif

                </td>
                <td style="">
                    <span class="bg-{{ $color_c }} rounded-lg p-1 ">
                        {{ $inscripcione->asistencias->where('asistencia', '0')->count() }}
                    </span>
                </td>
                <td>
                    <span class="bg-{{ $color_c }} rounded-lg p-1 ">
                        {{ $inscripcione->asistencias->where('asistencia', '1')->count() }}
                    </span>
                </td>
                <td>
                    <span class="bg-{{ $color_c }} rounded-lg p-1 ">
                        {{ $inscripcione->asistencias->where('asistencia', '2')->count() }}
                    </span>
                </td>
                <td>
                    {{ $capacitaciones->count() }}
                </td>
                <td class="text-center text-info font-weight-bold align-middle">

                    @if ($tareas->count())
                        @php
                            $porcentaje = round((100 * $inscripcione->inscripcioneTareas->where('realizado', '1')->count()) / $tareas->count(), 2);
                            $color_p = 'warning';
                            $color_c = 'warning';
                            if ($porcentaje == 100) {
                                $color_p = 'info';
                                $color_c = 'success';
                            }
                            if ($porcentaje == 0) {
                                $color_p = 'danger';
                                $color_c = 'danger';
                            }
                        @endphp
                        <div class="porcentaje-lecturas">
                            <span class="bg-{{ $color_p }} rounded-lg p-1 pdiv-porcentaje">
                                {{ $porcentaje/100 }}
                            </span>
                        </div>
                    @else
                        <span class="text-secondary">{{ 'No ha creado reuniones/capacitaciones.' }}</span>
                    @endif

                </td>
                <td>
                    <span class="bg-{{ $color_c }} rounded-lg p-1 ">
                        {{ $inscripcione->inscripcioneTareas->where('realizado', '1')->count() }}
                    </span>
                </td>
                <td>
                    {{ $inscripcione->inscripcioneTareas->where('realizado', '0')->count() }}
                </td>
                <td>
                    {{ $tareas->count() }}
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
