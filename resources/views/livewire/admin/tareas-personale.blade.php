<div>
    <div class="card">
        <div class="card-header">
            <h3>Listado de Personal</h3>
            <div class="form-row">
                <div class="col">
                    <input wire:model="search" class="form-control" placeholder="Ingrese nombre de un personal">
                </div>
                <div class="col">
                    <select name="" id="" class="form-control" wire:model="familia">
                        <option value="">-- Familias --</option>
                        @foreach ($familias as $familia)
                            <option value="{{ $familia->id }}">{{ $familia->nombre . ' ' . $familia->numero }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="cont-table-div-lecturas">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th class="apellido-fijo-lecturas fijo border-0">
                                Familia
                            </th>
                            <th class="nombre-fijo-lecturas fijo border-0" wire:click="sortBy('contactos.nombres')" style="cursor:pointer">
                                Nombres y Apellidos
                                @include('partials._sort-icon', ['field' => 'contactos.nombres'])
                            </th>
                            <th class="text-center align-middle border-left">
                                Completado (%/#)
                            </th>
                            @forelse ($programa->tareas->sortBy('fecha_inicio') as $tarea)
                                <th class="text-center border-left" style="50px">
                                    <div>
                                        @foreach ($tarea->tareaMateriales as $tareaMateriale)
                                        {{ $tareaMateriale->tema }}
                                        <br>
                                        @endforeach
                                    </div>
                                    <div>
                                        {{ date('d/m/Y', strtotime($tarea->fecha_inicio)) }} <br>al <br> {{ date('d/m/Y', strtotime($tarea->fecha_final)) }}
                                    </div>
                                </th>
                            @empty
                                <th>No hay lecturas</th>
                            @endforelse
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($inscripciones as $inscripcione)
                            <tr>

                                @php
                                    $inscripcione_ = \App\Models\Inscripcione::find($inscripcione->inscripcione_id);
                                @endphp
                                <td class="apellido-fijo-lecturas text-center">
                                    @php
                                        if ($inscripcione_->inscripcioneCompanerismo) {
                                            echo $inscripcione_->inscripcioneCompanerismo->companerismo->grupo->numero;
                                        }
                                    @endphp
                                </td>
                                <td class="nombre-fijo-lecturas">
                                    <b>
                                        {{ $inscripcione->contacto_nombres }}
                                    </b>
                                    {{ ' ' . $inscripcione->contacto_apellidos }}
                                </td>
                                <td class="text-center text-info font-weight-bold align-middle">

                                    @if ($programa->tareas->count())
                                        @php
                                            $porcentaje = round((100 * $inscripcione_->inscripcioneTareas->where('realizado', '1')->count()) / $programa->tareas->count(), 2);
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
                                                {{ $porcentaje . '%' }}
                                            </span>
                                            <span class="bg-{{ $color_c }} rounded-lg p-1 ">
                                                {{ $inscripcione_->inscripcioneTareas->where('realizado', '1')->count() . '/' . $programa->tareas->count() }}
                                            </span>
                                        </div>
                                    @else
                                        <span
                                            class="text-secondary">{{ 'No ha creado reuniones/capacitaciones.' }}</span>
                                    @endif

                                </td>

                                @forelse ($tareas->sortBy('fecha_inicio') as $tarea)
                                    <td class="text-center">
                                        @livewire('admin.create-inscripcione-tarea', ['tarea_id' => $tarea->id, 'inscripcione_id' => $inscripcione_->id], key($inscripcione_->id . '-' . $tarea->id))
                                    </td>
                                @empty
                                    <td>No hay lecturas</td>
                                @endforelse
                            </tr>
                        @endforeach
                        <tr>
                            <td class="apellido-fijo-lecturas text-center">
                            </td>
                            <td class="nombre-fijo-lecturas">
                            </td>
                            <td class="text-center">
                            </td>
                            @forelse($tareas as $tarea)
                                <td colspan="1" class="text-center text-lg border-left">
                                    <div class="bg-success p-1 rounded-lg font-weight-bold mx-auto mb-1" style="width: 100px">
                                        <i class="fas fa-check-circle"></i>: 
                                        {{ $tarea->inscripcioneTareas->where('realizado','1')->whereIn('inscripcione_id', $inscripciones_all_ids)->count() }}
                                    </div>
                                    <div class="bg-danger p-1 rounded-lg font-weight-bold mx-auto mb-1" style="width: 100px">
                                        <i class="fas fa-times"></i>: 
                                        {{ $inscripciones->total() - $tarea->inscripcioneTareas->where('realizado','1')->whereIn('inscripcione_id', $inscripciones_all_ids)->count() }}
                                    </div>
                                </td>
                            @empty
                                <td colspan="100%" height="98"></td>
                            @endforelse
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer">
            @include('admin.programas.partials.card-footer-personal')
        </div>
    </div>
</div>
