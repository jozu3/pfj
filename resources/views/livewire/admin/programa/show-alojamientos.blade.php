<div>
    <div wire:ignore.self class="modal fade bd-example-modal-xl" id="showAlojamientos" tabindex="-1" role="dialog"
        aria-labelledby="showAlojamientosLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="sortCompaniasLabel">
                        @if ($habitacione)
                            {{ $habitacione->piso->edificio->nombre . ' - ' . $habitacione->piso->num . ' - ' . $habitacione->numero }}
                        @endif
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @if (!empty($habitacione))

                        @if ($habitacione->alojamientos->count())
                            <h6>Participantes:</h6>
                            <table class="table table-condensed table-sm">
                                <thead>
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Compañia</th>
                                        <th>Estaca/Barrio</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($habitacione->alojamientos as $alojamiento)
                                        <tr>
                                            <td>
                                                {{ $alojamiento->participante->nombres . ' ' . $alojamiento->participante->apellidos . '(' . $alojamiento->participante->age . ')' }}
                                            </td>
                                            <td>
                                                {{ $alojamiento->participante->participanteCompania->companerismo->numero }}
                                            </td>
                                            <td>
                                                {{ $alojamiento->participante->barrio->estaca->nombre . '/' . $alojamiento->participante->barrio->nombre }}
                                            </td>
                                        </tr>
                                    @empty
                                        @forelse ($habitacione->alojamientosPersonales as $alojamiento)
                                            <li>{{ $alojamiento->inscripcione->personale->contacto->nombres . ' ' . $alojamiento->inscripcione->personale->contacto->apellidos }}
                                            </li>
                                        @empty
                                        @endforelse
                                    @endforelse
                                </tbody>
                            </table>
                        @endif
                        @if ($habitacione->alojamientosPersonales->count())
                            <h6>Personal:</h6>
                            <table class="table table-condensed table-sm">
                                <thead>
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Rol</th>
                                        <th>Estaca/Barrio</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($habitacione->alojamientosPersonales as $alojamiento)
                                        <tr>
                                            <td>
                                                {{ $alojamiento->inscripcione->personale->contacto->nombres . ' ' . $alojamiento->inscripcione->personale->contacto->apellidos }}
                                            </td>
                                            <td>
                                                {{ $alojamiento->inscripcione->role->name }}
                                                @if ($alojamiento->inscripcione->role_id == 6 && isset($alojamiento->inscripcione->inscripcioneCompanerismo))
                                                    {{ ' - Compañia: ' . $alojamiento->inscripcione->inscripcioneCompanerismo->companerismo->numero}}
                                                @endif
                                            </td>
                                            <td>
                                                {{ $alojamiento->inscripcione->personale->contacto->barrio->estaca->nombre . '/' . $alojamiento->inscripcione->personale->contacto->barrio->nombre }}
                                            </td>
                                        </tr>
                                    @empty
                                        @forelse ($habitacione->alojamientosPersonales as $alojamiento)
                                            <li>{{ $alojamiento->inscripcione->personale->contacto->nombres . ' ' . $alojamiento->inscripcione->personale->contacto->apellidos }}
                                            </li>
                                        @empty
                                        @endforelse
                                    @endforelse
                                </tbody>
                            </table>
                        @endif
                    @endif
                </div>
                <div class="modal-footer">
                    <div class="w-100 text-center">
                    </div>
                    <div>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
