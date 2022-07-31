<div wire:init="loadParticipantes">
    <div class="card">
        <div class="card-header">
            <div class="form-row">
                <div class="col">
                    <input wire:model="search" class="form-control" placeholder="Ingrese nombre para buscar">
                </div>
                <div class="col">
                    <select name="" id="" class="form-control" wire:model="estaca">
                        <option value="0">-- Todas las estacas --</option>
                        @foreach ($estacas as $stk)
                            <option value="{{ $stk->id }}">{{ $stk->nombre }}</option>
                        @endforeach
                    </select>
                    @if (count($barriosEstaca))
                        <select name="" id="" class="form-control mt-2" wire:model="barrio">
                            <option value="0">-- Barrios --</option>
                            @foreach ($barriosEstaca as $barrio)
                                <option value="{{ $barrio->id }}">{{ $barrio->nombre }}</option>
                            @endforeach
                        </select>
                    @endif
                </div>
                <div class="col">
                    <select name="" id="" class="form-control" wire:model="compania">
                        <option value="0">-- Todas las compañias --</option>
                        @foreach ($companerismos as $compania)
                            <option value="{{ $compania->id }}">{{ $compania->numero }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col">
                    <select name="" id="" class="form-control" wire:model="estado">
                        <option value="-1">-- Todos --</option>
                        <option value="0">Inscrito</option>
                        <option value="1">Ingresado</option>
                        <option value="2">Permutado</option>
                        <option value="3">Terminado</option>
                        <option value="4">Retirado</option>
                        <option value="5">En espera</option>
                        <option value="6">Canceló inscripción</option>
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
                        <th>Genero</th>
                        <th>Documento</th>
                        <th>Estaca</th>
                        <th>Barrio</th>
                        <th>Obispo</th>
                        <th>Habitación</th>
                        <th>Compañia</th>
                        <th>Consejeros</th>
                        <th>Telefono</th>
                        {{-- <th>Fecha de nacimiento</th> --}}
                        <th>Edad</th>
                        {{-- <th>Edad 2022</th> --}}
                        {{-- <th>Tipo de sangre</th> --}}
                        <th>Estado</th>
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
                                    @case(false)
                                        {{ 'Mujer' }}
                                    @break

                                    @case(true)
                                        {{ 'Hombre' }}
                                    @break

                                    @default
                                @endswitch
                            </td>
                            <td>
                                {{ $participante->documento }}
                            </td>
                            <td>
                                {{ $participante->barrio->estaca->nombre }}
                            </td>
                            <td>
                                {{ $participante->barrio->nombre }}
                            </td>
                            <td>
                                {{ $participante->obispo }}
                            </td>
                            <td>
                                @if (isset($participante->alojamiento))
                                    {{ $participante->alojamiento->habitacione->piso->edificio->nombre }} - Piso: {{ $participante->alojamiento->habitacione->piso->num }} -
                                    {{ $participante->alojamiento->habitacione->numero }}
                                @endif
                            </td>
                            <td>
                                @if ($participante->participanteCompania)
                                    {{ $participante->participanteCompania->companerismo->numero }}
                                @endif
                            </td>
                            <td width="200px">
                                @if (isset($participante->participanteCompania))
                                    @php
                                        $insComps = $participante->participanteCompania->companerismo->inscripcioneCompanerismos;
                                    @endphp
                                    @foreach ($insComps as $consejero)
                                        {{ $consejero->inscripcione->personale->contacto->nombres . ' ' . $consejero->inscripcione->personale->contacto->apellidos }}
                                        <br>
                                        {{-- @if (isset($consejero->inscripcione->personale->contacto))
                                        @endif
                                        @if ($loop->index != count($insComps) - 1)
                                        {{ ' y ' }}
                                        <br>
                                        @endif --}}
                                    @endforeach
                                @endif
                            </td>
                            <td>
                                <span>
                                    <a href="tel:{{ $participante->telefono }}" alt="Llamar por teléfono"
                                        data-toggle="tooltip" data-placement="top"
                                        title="Llamar por teléfono">{{ str_replace(' ', '', $participante->telefono) }}</a>
                                    <a href="https://api.whatsapp.com/send?phone=51{{ str_replace(' ', '', $participante->telefono) }}"
                                        class="text-success" target="_blank" alt="Enviar Whatsapp" data-toggle="tooltip"
                                        data-placement="top" title="Enviar Whatsapp"><i class="fab fa-whatsapp"></i></a>
                                </span>
                            </td>
                            {{-- <td>
                                @if ($participante)
                                    <a href="mailto:{{ $participante->email }}" alt="Enviar email"
                                        data-toggle="tooltip" data-placement="top"
                                        title="Enviar email">{{ $participante->email }}</a>
                                @else
                                @endif
                            </td> --}}
                            {{-- <td>
                                {{ date('d/m/Y', strtotime($participante->fecnac)) }}
                            </td> --}}
                            <td>
                                {{ $participante->age }}
                            </td>
                            {{-- <td>
                                {{ $participante->age_2022 }}
                            </td> --}}
                            {{-- <td>
                                {{ $participante->sangre }}
                            </td> --}}
                            <td width="10px">
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
                                        <div class="d-flex items-center">
                                            <div style="width:20px; height: 100%; align-items: center" class="">
                                                <div class="spinner-grow text-success" style="width:20px; height: 20px;" role="status">
                                                    <span class="sr-only">Loading...</span>
                                                </div>
                                            </div>
                                            <div style="width: 80px">
                                                {{ 'En espera' }}
                                            </div>
                                        </div>
                                    @break

                                    @case(6)
                                        {{ 'Canceló inscripción' }}
                                    @break

                                    @default
                                @endswitch
                            </td>
                            <td width="10px">
                                <a href="{{ route('st.participantes.edit', $participante) }}"
                                    class="btn btn-sm btn-primary"><i class="fas fa-user-edit"></i></a>
                            </td>
                            <td>
                                <a href="{{ route('admin.pdf.ingreso_participante', $participante) }}" target="_blank"
                                    class="btn btn-sm btn-danger"><i class="fas fa-file-pdf"></i></a>
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
