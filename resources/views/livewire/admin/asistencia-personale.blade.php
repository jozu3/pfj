<div>
    <div class="card cont-pestaña">
        <div class="card-header">
            <div class="row">
                <div class="col-md-2">
                    <h3>Listado de Personal</h3>

                </div>
                <div class="col-md-8">
                @include('admin.programas.partials.card-footer-personal')
                </div>
                <div class="col-md-1 d-flex align-items-center justify-content-end">
                    Ver:
                </div>
                <div class="col-md-1 d-flex align-items-center">
                        <select name="" id="" class="form-control" wire:model="cantpages">
                            <option value="15">15</option>
                            <option value="30">30</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                        </select>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3 mt-2">
                    <input wire:model="search" class="form-control" placeholder="Ingrese nombre de un personal">
                </div>
                <div class="col-md-3 mt-2">
                    <select name="" id="" class="form-control" wire:model="familia">
                        <option value="">-- Familias --</option>
                        @foreach ($familias as $familia)
                            <option value="{{ $familia->id }}">{{ $familia->nombre.' '.$familia->numero }}</option>  
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3 mt-2" wire:ignore>
                    <select name="" id="estaca_ids_asistencia" class="form-control" name="estaca_ids[]" multiple="multiple">
                        {{-- <option value="0">-- Todas las estacas --</option> --}}
                        @foreach ($estacas as $stk)
                            <option value="{{ $stk->id }}">{{ $stk->nombre }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="card-body card-body-2 cont-table-div" style="overflow-x:auto">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th class="apellido-fijo fijo border-0">
                            Familia
                        </th>
                        <th class="nombre-fijo fijo border-0" wire:click="sortBy('contactos.nombres')" style="cursor:pointer">
                            Nombres y Apellidos
                            @include('partials._sort-icon', ['field' => 'contactos.nombres'])
                        </th>
                        <th class="text-center align-middle border-left">
                            Asistencia (%/#)
                        </th>
                        @forelse($capacitaciones->sortBy('fechacapacitacion') as $capacitacione)
                            <th colspan="1" class="text-center border-left">
                                <b>{{ $capacitacione->tema }}</b> <br>
                                <b>{{ date('d/m/Y', strtotime($capacitacione->fechacapacitacion)) }}</b>
                            </th>
                        @empty
                        <th colspan="100%" height="98" ></th>
                        @endforelse
                    </tr>
                </thead>
                <tbody>
                    @foreach($inscripciones as $inscripcione)
                        <tr>
                            @php
                                $inscripcione_ = \App\Models\Inscripcione::find($inscripcione->inscripcione_id);
                            @endphp
                            <td class="apellido-fijo text-center">
                                @php
                                    if($inscripcione_->inscripcioneCompanerismo){
                                        echo $inscripcione_->inscripcioneCompanerismo->companerismo->grupo->numero ;
                                    }
                                @endphp
                            </td>
                            <td class="nombre-fijo">
                                <b>
                                    {{ $inscripcione->contacto_nombres }} 
                                </b>
                                {{ ' '.$inscripcione->contacto_apellidos }}
                            </td>
                           
                            <td class="text-center text-info font-weight-bold align-middle">
                                
                                @if ($capacitaciones->count())
                                @php
                                    $porcentaje = round(100*$inscripcione_->asistencias->where('asistencia', '0')->count()/$capacitaciones->count(), 2);
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
                                    <span class="bg-{{$color_p}} rounded-lg p-1 pdiv-porcentaje">
                                        {{ $porcentaje .'%' }}
                                    </span>
                                    <span class="bg-{{$color_c}} rounded-lg p-1 ">
                                        {{ $inscripcione_->asistencias->where('asistencia', '0')->count().'/'.$capacitaciones->count()  }}
                                    </span>
                                </div>
                                    @else
                                <span class="text-secondary">{{ 'No ha creado reuniones/capacitaciones.' }}</span>
                                @endif
                                
                            </td>
                            @forelse($capacitaciones->sortBy('fechacapacitacion') as $capacitacione)
                                <td class="border-left">
                                    <div class="form-row align-items-center una-fila">
                                        <div class="col-auto my-1 mx-2">
                                            @if($inscripcione_->asistenciaCapacitacione($capacitacione))
                                            {!! Form::model($inscripcione_->asistenciaCapacitacione($capacitacione)) !!}
                                            @else
                                            {!! Form::open(['route' => 'admin.capacitaciones.store']) !!}
                                            @endif
                                            @livewire('admin.create-asistencia', [
                                                'capacitacione_id' => $capacitacione->id,
                                                'inscripcione_id' => $inscripcione_->id,
                                                ], key($inscripcione_->id.'-'.$capacitacione->id))
                                            {!! Form::close() !!}
                                        </div>
                                    </div>
                                </td>
                            @empty
                            <td>
                                <br>
                            </td>
                            @endforelse
                            <td>
                                <br>
                                <br>
                            </td>
                        </tr>
                       
                    @endforeach
                    <tr>
                        <td class="apellido-fijo text-center">
                        </td>
                        <td class="nombre-fijo">
                        </td>
                        <td class="text-center">
                        </td>
                        @forelse($capacitaciones->sortBy('fechacapacitacion') as $capacitacione)
                            <td colspan="1" class="text-center text-lg border-left">
                                <div class="bg-success p-1 rounded-lg font-weight-bold mx-auto mb-1" style="width: 100px">
                                    A: {{ $capacitacione->asistencias->where('asistencia','0')->whereIn('inscripcione_id', $inscripciones_all_ids)->count() }}
                                </div>
                                <div class="bg-danger p-1 rounded-lg font-weight-bold mx-auto mb-1" style="width: 100px">
                                    F: {{ $capacitacione->asistencias->where('asistencia','1')->whereIn('inscripcione_id', $inscripciones_all_ids)->count() }}
                                </div>
                                <div class="bg-warning p-1 rounded-lg font-weight-bold mx-auto" style="width: 100px">
                                    FJ: {{ $capacitacione->asistencias->where('asistencia','2')->whereIn('inscripcione_id', $inscripciones_all_ids)->count() }}
                                </div>
                            </td>
                        @empty
                            <td colspan="100%" height="98"></td>
                        @endforelse
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            @include('admin.programas.partials.card-footer-personal')
        </div>
    </div>
    <script>     
        document.addEventListener('livewire:load', function() {
            $('#estaca_ids_asistencia').select2({
                placeholder: "Todas las estacas",
                allowClear: true
            });

            $('#estaca_ids_asistencia').on('change', function() {
                var ess = (JSON.stringify($('#estaca_ids_asistencia').val()));
                // ess = JSON.stringify(ess);
                console.log($('#estaca_ids_asistencia').val())
                console.log(ess)
                @this.set('estaca_id', ess);
            });
        });
    </script>
</div>
