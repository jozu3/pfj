<div wire:init="loadParticipantes">
    <div class="card">
        <div class="card-header">

            @if ($miscupos > $inscritos)
                @can('admin.programas.participantes')
                @elsecan('admin.programas.participantes_barrio')
                    <a href="{{ route('st.participantes.create', 'programa_id=' . $programa_id) }}"
                        class="btn btn-success btn-sm float-right mr-3">
                        <i class="fas fa-user-plus"></i> Nuevo participantes
                    </a>
                @endcan
            @endif
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <table class="table table-sm">
                        <thead class="text-bold">
                            <tr>
                                <th>Aprobación</th>
                                <th>Cantidad</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($estado_aprobaciones as $estado_aprobacion)
                                <tr>
                                    <td>{{ $estado_aprobacion->descripcion }}</td>
                                    <td>{{ $allParticipantes->where('estado_aprobacion', $estado_aprobacion->id)->count() }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="col-md-4">
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th>Participante</th>
                                <th>Cantidad</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Mi cupos aprobados</td>
                                <td>{{ $miscupos }}</td>
                            </tr>
                            <tr>
                                <td>Inscritos</td>
                                <td>{{ $inscritos }}</td>
                            </tr>
                            <tr>
                                <td>Permutados</td>
                                <td>{{ $permutados }}</td>
                            </tr>
                            <tr>
                                <td>No inscritos</td>
                                <td>{{ $noinscritos }}</td>
                            </tr>
                        </tbody>
                        <tfoot>
                            @if ($miscupos <= $inscritos ) 
                            <tr>
                                <td colspan="100%">
                                    <span class="text-success"><i class="fas fa-info-circle"></i> Ha completado sus cupos aprobados. No puede inscribir más</span>
                                </td>
                            </tr>
                            @endif
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <div class="form-row">
                <div class="col">
                    <input wire:model="search" class="form-control" placeholder="Ingrese nombre para buscar">
                </div>
                @can('admin.programas.participantes')
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
                @elsecan('admin.programas.participantes_barrio')
                    <div class="col">
                        <input type="text" class="form-control" readonly
                            value="{{ auth()->user()->personale->contacto->barrio->estaca->nombre . ' - ' . auth()->user()->personale->contacto->barrio->nombre }}">
                    </div>
                @endcan
                <div class="col">
                    <select name="" id="" class="form-control" wire:model="compania">
                        <option value="0">-- Todas las compañias --</option>
                        @foreach ($companerismos as $compania)
                            <option value="{{ $compania->id }}">{{ $compania->numero }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col">
                    <select name="" id="" class="form-control" wire:model="estado_aprobacion">
                        <option value="Todos">Aprobación: Todos</option>
                        @foreach ($estado_aprobaciones as $est)
                            <option value="{{ $est->id }}">{{ $est->descripcion }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col">
                    <select name="" id="" class="form-control" wire:model="estado">
                        <option value="-1">-- Todos --</option>
                        <option value="0">Inscrito</option>
                        <option value="1">Ingresó al PFJ</option>
                        <option value="2">Permutado</option>
                        <option value="3">Terminó el PFJ</option>
                        <option value="4">Retirado</option>
                        <option value="5">En espera del PFJ</option>
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
            <table class="table table-sm table-striped">
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
                        <th>Aprobación</th>
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
                                    {{ $participante->alojamiento->habitacione->piso->edificio->nombre }} - Piso:
                                    {{ $participante->alojamiento->habitacione->piso->num }} -
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
                            <td>
                                {{ $participante->estadoAprobacione->descripcion }}
                            </td>
                            {{-- <td>
                                {{ $participante->age_2022 }}
                            </td> --}}
                            {{-- <td>
                                {{ $participante->sangre }}
                            </td> --}}
                            <td>
                                @php
                                    $estados = [
                                        '0' => 'Inscrito',
                                        '-1' => 'No Inscrito',
                                        // "5" => "En espera del PFJ",
                                        // "1" => "Ingresó al PFJ",
                                        // "3" => "Terminó el PFJ",
                                        '2' => 'Permutado',
                                        // "4" => "Retirado",
                                        // "6" => "Canceló inscripción ",
                                    ];
                                @endphp
                                <select name="" class="form-control changeEstadoParticipante"
                                    wire:loading.attr="disabled" style="width: 150px"
                                    data-idparticipante="{{ $participante->id }}"
                                    @if ($miscupos <= $inscritos && $participante->estado != 0) {{'disabled'}} @endif
                                    >
                                    @foreach ($estados as $key => $value)
                                        <option value="{{ $key }}"
                                            @if ($key == $participante->estado) {{ 'selected' }} @endif>
                                            {{ $value }}</option>
                                    @endforeach
                                </select>
                                {{-- @switch($participante->estado)
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
                                                <div class="spinner-grow text-success" style="width:20px; height: 20px;"
                                                    role="status">
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
                                @endswitch --}}
                            </td>
                            <td width="10px">
                                <a href="{{ route('st.participantes.edit', $participante) }}" target="_blank"
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
        <script>
            document.addEventListener('livewire:load', function() {
            });
        </script>
    </div>
