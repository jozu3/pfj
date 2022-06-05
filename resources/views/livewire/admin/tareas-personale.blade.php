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
            <div class="cont-table-div">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th class="apellido-fijo fijo border-0">
                                Familia
                            </th>
                            <th class="nombre-fijo fijo border-0">
                                Nombres y Apellidos
                            </th>
                            <th class="text-center align-middle border-left">
                                Asistencia (%/#)
                            </th>
                            @forelse ($programa->tareas->sortBy('fecha_inicio') as $tarea)
                                <th class="text-center border-left" style="50px">
                                    {{ date('d/m/Y', strtotime($tarea->fecha_inicio)) }} <br>al <br> {{ date('d/m/Y', strtotime($tarea->fecha_final)) }}
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
                                <td class="apellido-fijo text-center">
                                    @php
                                        if ($inscripcione_->inscripcioneCompanerismo) {
                                            echo $inscripcione_->inscripcioneCompanerismo->companerismo->grupo->numero;
                                        }
                                    @endphp
                                </td>
                                <td class="nombre-fijo">
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
                                        <div class="porcentaje">
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

                                @forelse ($tareas as $tarea)
                                    <td class="text-center">
                                        @livewire('admin.create-inscripcione-tarea', ['tarea_id' => $tarea->id, 'inscripcione_id' => $inscripcione_->id], key($inscripcione_->id . '-' . $tarea->id))
                                    </td>
                                @empty
                                    <td>No hay lecturas</td>
                                @endforelse
                            </tr>
                        @endforeach
                        <tr>
                            <td class="apellido-fijo text-center">
                            </td>
                            <td class="nombre-fijo">
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