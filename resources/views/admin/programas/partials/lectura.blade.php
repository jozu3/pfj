<div>
    <div class="card">
        <div class="card-header">
            <b>Lecturas del personal</b>
            <div>
                {{-- <label for="">Buscar personal</label> --}}
                {{-- <input wire:model="search" class="form-control form-control-sm"
                    placeholder="Ingrese nombre o apellido de un personal"> --}}
            </div>
        </div>
        <div class="card-body">
            <div class="cont-table-div">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th class="apellido-fijo">Apellidos</th>
                            <th class="nombre-fijo">Nombres</th>
                            @forelse ($programa->tareas->sortBy('fecha_inicio') as $tarea)
                                <th class="text-center" style="50px">
                                     {{ $tarea->fecha_inicio }} <br>al <br> {{ $tarea->fecha_final }}
                                </th>
                            @empty
                                <th>No hay lecturas</th>
                            @endforelse
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($programa->inscripcionesEstado([1]) as $inscripcione)
                            <tr>
                                <td class="apellido-fijo">
                                    <b>{{ $inscripcione->personale->contacto->apellidos }}</b>
                                </td>
                                <td class="nombre-fijo">
                                    <b>{{ $inscripcione->personale->contacto->nombres }}</b>
                                </td>
                                @forelse ($programa->tareas->sortBy('fecha') as $tarea)
                                    <td class="text-center">
                                        @livewire('admin.create-inscripcione-tarea', ['tarea_id' => $tarea->id, 'inscripcione_id' => $inscripcione->id])
                                    </td>
                                @empty
                                    <td>No hay lecturas</td>
                                @endforelse
                            </tr>
                        @endforeach
                        {{-- {{ $programa }} --}}
                        {{-- @forelse ($collection as $item)
                        <tr>
                            <td></td>
                        </tr>
                        @empty
                            
                        @endforelse --}}

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

{{-- @livewire('admin.tarea-lista', ['programa' => $programa]) --}}
