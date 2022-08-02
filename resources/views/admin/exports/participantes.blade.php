<table class="table table-striped">
    <thead>
        <tr>
            <th>Nombres</th>
            <th>Apellidos</th>
            <th>Sexo</th>
            <th>Compañia</th>
            <th>Habitación</th>
            <th>Estado</th>
            <th>Edad</th>
            <th>Fecha de nacimiento</th>
            <th>Edad que cumple el 2022</th>
            <th>Estaca</th>
            <th>Barrio</th>
            <th>Contacto 1</th>
            <th>Teléfono de Contacto 1</th>
            <th>Correo electrónico de Contacto 1</th>
            <th>Contacto 2</th>
            <th>Teléfono de Contacto 2</th>
            <th>Correo electrónico de Contacto 2</th>
            <th>Obispo</th>
            <th>Correo electrónico del obispo</th>
            <th>Tipo de sangre</th>
            <th>
                Informacion médica
            </th>
            <th>
                Tratamiento médico
            </th>
            <th>Alergia</th>
            <th>
                Diabetico o asmático
            </th>
            <th>
                Seguro médico
            </th>
            <th>
                Informacion alimentaria
            </th>
            <th>
                Vacunas
            </th>
        </tr>
    </thead>
    <tbody>
        @foreach ($participantes as $participante)
            <tr>
                <td>{{ $participante->nombres }}</td>
                <td>{{ $participante->apellidos }}</td>
                <td>
                    @switch($participante->genero)
                        @case(1)
                            {{'Hombre'}}
                            @break
                        @case(0)
                            {{'Mujer'}}
                            @break
                        @default
                    @endswitch
                </td>
                <td>
                    @if ($participante->participanteCompania)
                        {{ $participante->participanteCompania->companerismo->numero }}
                    @endif
                </td>
                <td>
                    @if (isset($participante->alojamiento))
                        {{ $participante->alojamiento->habitacione->piso->edificio->nombre }} - Piso:
                        {{ $participante->alojamiento->habitacione->piso->num }} -
                        {{ $participante->alojamiento->habitacione->numero }}
                    @endif
                </td>
                <td>
                    @switch($participante->estado)
                        @case(0)
                            {{ 'Inscrito' }}
                        @break

                        @case(1)
                            {{ 'Ingresado' }}
                        @break

                        @case(2)
                            {{ 'Permutado' }}
                        @break

                        @case(3)
                            {{ 'Terminado' }}
                        @break

                        @case(4)
                            {{ 'Retirado' }}
                        @break

                        @case(5)
                            {{ 'En espera' }}
                        @break

                        @case(6)
                            {{ 'Canceló inscripción' }}
                        @break

                        @default
                    @endswitch
                </td>
                <td>{{ $participante->age }}</td>
                <td>{{ date('d/m/Y', strtotime($participante->fecnac)) }}</td>
                <td>{{ $participante->age_22 }}</td>
                <td>{{ $participante->barrio->estaca->nombre }}</td>
                <td>{{ $participante->barrio->nombre }}</td>
                <td>
                    {{ $participante->contacto1 }}
                </td>
                <td>
                    {{ $participante->contacto1_phone }}
                </td>
                <td>
                    {{ $participante->contacto1_email }}
                </td>
                <td>
                    {{ $participante->contacto2 }}
                </td>
                <td>
                    {{ $participante->contacto2_phone }}
                </td>
                <td>
                    {{ $participante->contacto2_email }}
                </td>
                <td>
                    {{ $participante->obispo }}
                </td>
                <td>
                    {{ $participante->obispo_email }}
                </td>
                <td>
                    {{ $participante->sangre }}
                </td>
                <td>
                    {{ $participante->informacion_medica }}
                </td>
                <td>
                    {{ $participante->tratamiento_medico }}
                </td>
                <td>
                    {{ $participante->alergia }}
                </td>
                <td>
                    {{ $participante->diabetico_asmatico }}
                </td>
                <td>
                    {{ $participante->seguro_medico }}
                </td>
                <td>
                    {{ $participante->informacion_alimentaria }}
                </td>
                <td>
                    {{ $participante->vacunas }}
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
