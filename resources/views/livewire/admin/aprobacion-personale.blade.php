<div>
    <div class="card">
        <div class="card-header">
            <div class="form-row">
                <div class="col-md-3 mt-2">
                    <input wire:model="search" class="form-control" placeholder="Ingrese nombre de un personal">
                </div>
                <div class="col-md-3 mt-2">
                    <select name="" id="" class="form-control" wire:model="familia">
                        <option value="">-- Familias --</option>
                        @foreach ($familias as $familia)
                            <option value="{{ $familia->id }}">{{ $familia->nombre . ' ' . $familia->numero }}</option>
                        @endforeach
                    </select>

                </div>
                <div class="col-md-3 mt-2" wire:ignore>
                    <select name="" id="estaca_ids" class="form-control" name="estaca_ids[]" multiple="multiple">
                        {{-- <option value="0">-- Todas las estacas --</option> --}}
                        @foreach ($estacas as $stk)
                            <option value="{{ $stk->id }}">{{ $stk->nombre }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3 mt-2">
                    <select name="" id="" class="form-control" wire:model="aprobacion">
                        <option value="">-- Estado de Aprobación --</option>
                        <option value="0">Cancelado</option>
                        <option value="1">Aprobación pendiente</option>
                        <option value="2">Aprobado</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th></th>
                        <th>Nombres</th>
                        <th>Apellidos</th>
                        <th>Familia</th>
                        <th>Recomendación para el Templo</th>
                        <th>Aprobación final</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($inscripciones as $inscripcione)
                        <tr>
                            <td>
                                @if (\App\Models\Inscripcione::find($inscripcione->inscripciones_id)->personale->user)
                                    <img id="imgperfil" class="rounded-circle" width="50" height="50"
                                        src=" {{ \App\Models\Inscripcione::find($inscripcione->inscripciones_id)->personale->user->adminlte_image() }}"
                                        alt="">
                                @endif
                            </td>
                            <td>
                                {{ $inscripcione->contactos_nombres }}
                            </td>
                            <td>{{ $inscripcione->contactos_apellidos }}</td>
                            <td>
                                @php
                                    $ic = \App\Models\InscripcioneCompanerismo::where('inscripcione_id', $inscripcione->inscripciones_id)->first();
                                    if ($ic) {
                                        echo $ic->companerismo->grupo->numero;
                                    }
                                @endphp
                            </td>
                            <td>
                                <div class="input-group-prepend">
                                    {!! Form::select(
                                        'mes_recomendacion',
                                        [
                                            '1' => 'Enero',
                                            '2' => 'Febrero',
                                            '3' => 'Marzo',
                                            '4' => 'Abril',
                                            '5' => 'Mayo',
                                            '6' => 'Junio',
                                            '7' => 'Julio',
                                            '8' => 'Agosto',
                                            '9' => 'Septiembre',
                                            '10' => 'Octubre',
                                            '11' => 'Noviembre',
                                            '12' => 'Diciembre',
                                        ],
                                        $inscripcione->contactos_mes_recomendacion,
                                        [
                                            'class' => 'form-control',
                                            'placeholder' => '----',
                                            'disabled',
                                            'style' => 'width:150px',
                                        ],
                                    ) !!}
                                    <input type="text" class="form-control border-0 bg-white text-center px-1"
                                        readonly value="/" style="width: 18px">
                                    {!! Form::number('anio_recomendacion', $inscripcione->contactos_anio_recomendacion, [
                                        'class' => 'form-control',
                                        'readonly',
                                        'style' => 'width:100px',
                                    ]) !!}
                                </div>
                            </td>
                            <td>
                                @switch($inscripcione->permiso_obispo)
                                    @case(0)
                                        @php
                                            $color = 'danger';
                                            $text_estado = 'Desaprobado';
                                        @endphp
                                    @break

                                    @case(1)
                                        @php
                                            $color = 'warning';
                                            $text_estado = 'Aprobación pendiente';
                                        @endphp
                                    @break

                                    @case(2)
                                        @php
                                            $color = 'success';
                                            $text_estado = 'Aprobado';
                                        @endphp
                                    @break

                                    @default
                                @endswitch
                                @can('admin.programas.control.aprobacion.edit')
                                    <select name="permiso_obispo" id="permiso_obispo"
                                        class="form-control btn-{{ $color }} text-white"
                                        onchange="Livewire.emit('changeAprob', {{ $inscripcione->personales_id }}, value)">
                                        <option class="text-danger bg-white" value="0"
                                            @if ($inscripcione->permiso_obispo == 0) selected @endif>Desaprobado</option>
                                        <option class="text-warning bg-white" value="1"
                                            @if ($inscripcione->permiso_obispo == 1) selected @endif>Aprobación pendiente</option>
                                        <option class="text-info bg-white" value="2"
                                            @if ($inscripcione->permiso_obispo == 2) selected @endif>Aprobado</option>
                                    </select>
                                @else
                                    <div class="form-control btn-{{ $color }} text-white">
                                        {{ $text_estado }}
                                    </div>
                                @endcan
                            </td>
                            {{-- <td>
                                {{ $inscripcione->estado }}
                            </td>
                             --}}
                            @can('admin.contactos.edit')
                                <td width="10px">
                                    <a href="{{ route('admin.contactos.show', $inscripcione->contactos_id) }}"
                                        class="btn btn-primary"><i class="fas fa-user-edit"></i></a>
                                </td>
                            @endcan
                            {{-- <td width="10px">
                                <a href="{{ route('admin.inscripciones.show', $inscripcione) }}" class="btn btn-primary"><i class="fas fa-edit"></i></a>
                            </td> --}}
                        </tr>
                        @empty
                            <tr>
                                <td colspan="100%">
                                    <div class="card">
                                        <div class="card-header text-warning">
                                            {{ 'No hay personal' }}
                                        </div>
                                    </div>

                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                @include('admin.programas.partials.card-footer-personal')
            </div>
        </div>

    </div>
    <script>     
        document.addEventListener('livewire:load', function() {
            $('#estaca_ids').select2({
                placeholder: "Todas las estacas",
                allowClear: true
            });

            $('#estaca_ids').on('change', function() {
                var ess = (JSON.stringify($('#estaca_ids').val()));
                // ess = JSON.stringify(ess);
                console.log($('#estaca_ids').val())
                console.log(ess)
                @this.set('estaca_id', ess);
            });
        });
    </script>
</div>