<div wire:init="loadParticipantes">
    <h2 class="mt-3">{{ 'Compañia:' . $companerismo->numero }}</h2>
    <div class="form-row">
        @if ($participantes != [])
            <div class="col">
                {{ $participantes->links() }}
            </div>
            <div class="col">
                Viendo <b> {{ count($participantes) }}</b> de un total de <b>
                    {{ $participantes->total() }}</b>
            </div>
        @endif
    </div>
    <div class="card">
        <div class="card-header">
            <div class="form-row">
                <div class="col">
                    <input wire:model="search" class="form-control" placeholder="Ingrese nombre para buscar">
                </div>
                <div class="col">
                    <select name="" id="" class="form-control" wire:model="estaca">
                        <option value="0">-- Estaca --</option>
                        @foreach ($estacas as $stk)
                            <option value="{{ $stk->id }}">{{ $stk->nombre }}</option>
                        @endforeach
                    </select>
                </div>
                {{-- <div class="col">
                    <select name="" id="" class="form-control" wire:model="compania">
                        <option value="0">-- Compañia --</option>
                        @foreach ($companerismos as $compania)
                            <option value="{{ $compania->id }}">{{ $compania->numero }}</option>
                        @endforeach
                    </select>
                </div> --}}
                <div class="col">
                    <select name="" id="" class="form-control" wire:model="estado">
                        <option value="-1">-- Todos --</option>
                        <option value="0">Inscrito</option>
                        <option value="1">Ingresado</option>
                        <option value="2">Permutado</option>
                        <option value="3">Terminado</option>
                        <option value="4">Retirado</option>
                        <option value="5">En espera</option>
                        <option value="4">Canceló inscripción</option>
                    </select>
                </div>
                {{-- <div class="col">
                    <a href="{{ route('admin.excel.exportExcelParticipantes', [$programa_id, $compania, $estaca, $estado]) }}"
                        class="btn btn-success float-right mr-3">
                        <i class="far fa-file-excel"></i> Descargar
                    </a>
                </div> --}}
            </div>
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th colspan="1">Nombres</th>
                        <th>Apellidos</th>
                        <th>Género</th>
                        <th>Estaca - Barrio</th>
                        <th>Compañia</th>
                        <th>Habitación</th>
                        <th>Telefono</th>
                        <th>Correo electrónico</th>
                        <th>Fecha de nacimiento</th>
                        <th>Edad</th>
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
                        <th>
                            Estado
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($participantes as $participante)
                        <tr>
                            {{-- <td>
                                <img id="imgperfil" class="rounded-circle {{ $participante->id }}" width="50"
                                    height="50" style="object-fit: cover;"
                                    src="@if ($participante->image) {{ $participante->image() }} @else {{ 'https://picsum.photos/300/300' }} @endif"
                                    alt="">
                            </td> --}}
                            <td>
                                {{ $participante->nombres }}
                                {{-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" wire:click="$emitTo('admin.modal-detalle-contacto', 'showcontacto', '{{$participante->id}}')">
                                  </button> --}}
                            </td>
                            <td>{{ $participante->apellidos }}</td>
                            <td>
                                @switch($participante->genero)
                                    @case(0)
                                        {{ 'Mujer' }}
                                    @break

                                    @case(1)
                                        {{ 'Hombre' }}
                                    @break

                                    @default
                                @endswitch
                            </td>
                            <td>
                                {{ $participante->barrio->estaca->nombre . ' - ' . $participante->barrio->nombre }}
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
                                @else
                                    <span class="text-secondary">
                                        {{ 'No asignado' }}
                                    </span>
                                @endif
                            </td>
                            <td>
                                <span>
                                    <a href="tel:{{ str_replace(' ', '', $participante->telefono) }}"
                                        alt="Llamar por teléfono" data-toggle="tooltip" data-placement="top"
                                        title="Llamar por teléfono">{{ str_replace(' ', '', $participante->telefono) }}</a>
                                    <a href="https://api.whatsapp.com/send?phone=51{{ str_replace(' ', '', $participante->telefono) }}"
                                        class="text-success" target="_blank" alt="Enviar Whatsapp" data-toggle="tooltip"
                                        data-placement="top" title="Enviar Whatsapp"><i class="fab fa-whatsapp"></i></a>
                                </span>
                            </td>
                            <td>
                                @if ($participante)
                                    <a href="mailto:{{ str_replace(' ', '', $participante->email) }}"
                                        alt="Enviar email" data-toggle="tooltip" data-placement="top"
                                        title="Enviar email">{{ str_replace(' ', '', $participante->email) }}</a>
                                @else
                                @endif
                            </td>
                            <td>
                                {{ date('d/m/Y', strtotime($participante->fecnac)) }}
                            </td>
                            <td>
                                {{ $participante->age }}
                            </td>
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
                            <td>
                                @switch($participante->estado)
                                    @case(0)
                                        {{ 'Inscrito' }}
                                    @break

                                    @case(1)
                                        {{ 'ingresado' }}
                                    @break

                                    @case(2)
                                        {{ 'permutado' }}
                                    @break

                                    @case(3)
                                        {{ 'terminado' }}
                                    @break

                                    @case(4)
                                        {{ 'retirado' }}
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
                            <td width="10px">
                                <a href="{{ route('admin.participantes.show', $participante) }}"
                                    class="btn btn-primary"><i class="fas fa-user-edit"></i></a>
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
            </div>
            <div class="card-footer">
                <div class="form-row">
                    @if ($participantes != [])
                        <div class="col">
                            {{ $participantes->links() }}
                        </div>
                        <div class="col">
                            Viendo <b> {{ count($participantes) }}</b> de un total de <b>
                                {{ $participantes->total() }}</b>
                        </div>
                    @endif
                </div>

            </div>
        </div>



    </div>
