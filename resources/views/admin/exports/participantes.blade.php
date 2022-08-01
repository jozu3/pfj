<table class="table table-striped">
    <thead>
        <tr>
            <th>Nombres</th>
            <th>Apellidos</th>
            <th>Estaca</th>
            <th>Barrio</th>
            <th>Edad</th>
            <th>Compañia</th>
            <th>Habitación</th>
            <th>Estado</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($participantes as $participante)
            <tr>
                <td>{{ $participante->nombres }}</td>
                <td>{{ $participante->apellidos }}</td>
                <td>{{ $participante->barrio->estaca->nombre }}</td>
                <td>{{ $participante->barrio->nombre }}</td>
                <td>{{ $participante->age }}</td>
                <td>{{ $participante->participanteCompania->companerismo->numero }}</td>
                <td>
                    @if (isset($participante->alojamiento))
                        {{ $participante->alojamiento->habitacione->piso->edificio->nombre }} - Piso: {{ $participante->alojamiento->habitacione->piso->num }} -
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
            </tr>
        @endforeach
    </tbody>
</table>
