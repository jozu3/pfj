<table class="table table-striped">
    <thead>
        <tr>
            <th>Nombres</th>
            <th>Apellidos</th>
            <th>Documento</th>
            <th>Sexo</th>
            <th>Cumpleaños</th>
            <th>Edad</th>
            <th>Recomendación para el templo</th>
            <th>Estaca</th>
            <th>Barrio</th>
            <th>Habitación</th>
            <th>Asignación</th>
            <th>Familia</th>
            <th>Compañia</th>
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
                <td style="width:200px" class="bg-primary">
                    {{ $inscripcione->personale->contacto->nombres }}
                </td>
                <td style="width:200px">{{ $inscripcione->personale->contacto->apellidos }}</td>
                <td style="width:200px">{{ $inscripcione->personale->contacto->doc }}</td>
                <td style="width:20px">{{ $inscripcione->personale->contacto->genero }}</td>
                <td style="width:80px">{{ date('d-M', strtotime($inscripcione->personale->contacto->fecnac)) }}</td>
                <td>
                    @php
                        $fecha_nacimiento = new DateTime($inscripcione->personale->contacto->fecnac);
                        $hoy = new DateTime();
                        echo (string) $hoy->diff($fecha_nacimiento)->format('%y');
                    @endphp
                </td>
                <td>
                    {{ $inscripcione->personale->contacto->mes_recomendacion . ' - ' .$inscripcione->personale->contacto->anio_recomendacion }}
                </td>
                <td style="width:120px">
                    {{ $inscripcione->personale->contacto->barrio->estaca->nombre }}
                </td>
                <td style="width:120px">
                    {{ $inscripcione->personale->contacto->barrio->nombre }}
                </td>
                <td>
                    @if (isset($inscripcione->alojamientoPersonale))
                        {{ $inscripcione->alojamientoPersonale->habitacione->piso->edificio->nombre }} - Piso:
                        {{ $inscripcione->alojamientoPersonale->habitacione->piso->num }} -
                        {{ $inscripcione->alojamientoPersonale->habitacione->numero }}
                    @endif
                </td>
                <td style="width:120px">
                    {{ $inscripcione->role->name }}
                    @forelse ($inscripcione->funciones as $funcione)
                        {{ ' - ' . $funcione->descripcion }}
                    @empty
                    @endforelse

                </td>
                @if ($inscripcione->role->name == 'Matrimonio Director' ||
                    $inscripcione->role->name == 'Matrimonio de Logística' ||
                    $inscripcione->role->name == 'Coordinador')
                    <td style="width:120px">{{ $inscripcione->role->name }}</td>
                @else
                    @if ($inscripcione->inscripcioneCompanerismo != null)
                        <td style="width:120px">
                            {{ $inscripcione->inscripcioneCompanerismo->companerismo->grupo->numero }}
                        </td>
                    @else
                        <td style="width:160px">
                            No tiene compañero(a)
                        </td>
                    @endif
                @endif
                <td> 
                    @if (isset($inscripcione->inscripcioneCompanerismo->companerismo))
                        {{$inscripcione->inscripcioneCompanerismo->companerismo->numero}}
                    @endif
                </td>
                <td style="width:120px">
                    {{ $inscripcione->personale->contacto->telefono }}
                </td>
                <td style="width:120px">
                    @if ($inscripcione->personale->user)
                        {{ $inscripcione->personale->user->email }}
                    @else
                    @endif
                </td>
                <td style="width:80px">
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
                <td style="width:80px">
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
                <td style="width:50px" class="text-center text-info font-weight-bold align-middle">

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
                <td style="width:50px">
                    @if ($capacitaciones->count())
                        <span class="bg-{{ $color_c }} rounded-lg p-1 ">
                            {{ $inscripcione->asistencias->where('asistencia', '0')->count() }}
                        </span>
                    @endif
                </td>
                <td style="width:50px">
                    @if ($capacitaciones->count())
                    <span class="bg-{{ $color_c }} rounded-lg p-1 ">
                        {{ $inscripcione->asistencias->where('asistencia', '1')->count() }}
                    </span>
                    @endif
                </td>
                <td style="width:50px">
                    @if ($capacitaciones->count())
                    <span class="bg-{{ $color_c }} rounded-lg p-1 ">
                        {{ $inscripcione->asistencias->where('asistencia', '2')->count() }}
                    </span>
                    @endif
                </td>
                <td style="width:50px">
                    {{ $capacitaciones->count() }}
                </td>
                <td style="width:50px" class="text-center text-info font-weight-bold align-middle">

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
                                {{ $porcentaje / 100 }}
                            </span>
                        </div>
                    @else
                        <span class="text-secondary">{{ 'No ha creado reuniones/capacitaciones.' }}</span>
                    @endif

                </td>
                <td style="width:50px">
                    @if ($tareas->count())
                    <span class="bg-{{ $color_c }} rounded-lg p-1 ">
                        {{ $inscripcione->inscripcioneTareas->where('realizado', '1')->count() }}
                    </span>
                    @endif
                </td>
                <td style="width:50px">
                    {{ $inscripcione->inscripcioneTareas->where('realizado', '0')->count() }}
                </td>
                <td style="width:50px">
                    {{ $tareas->count() }}
                </td>
            </tr>
            @empty
                <tr>
                    <td style="width:50px" colspan="100%">
                        <div class=" text-warning">
                            {{ 'No hay personal' }}
                        </div>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
