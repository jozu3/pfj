<div class="form-row">
    @foreach ($locale->edificios as $edificio)
        <div class="col-2 border d-flex align-items-start">
            <div class="form-row">
                <div class="col-12 text-center">
                    {{ $edificio->nombre }}
                </div>
                @forelse ($edificio->pisos as $piso)
                    <div class="col-12 border d-flex align-items-start">
                        <div class="form-row">
                            <div class="col-12">
                                {{ 'Piso:  ' }} <b> {{ $piso->num }} </b>
                            </div>
                            @forelse ($piso->habitaciones as $habitacione)
                                @php
                                    $background = '';
                                    $tipo = '';
                                    if ($habitacione->alojamientos->count() == $habitacione->cupos) {
                                        $background = 'bg-info';
                                        $tipo = 'P';
                                    } elseif ($habitacione->alojamientos->count() < $habitacione->cupos && $habitacione->alojamientos->count() > 0) {
                                        $background = 'bg-warning';
                                        $tipo = 'P';
                                    } elseif ($habitacione->alojamientos->count() == 0) {
                                        $background = 'bg-success';
                                        $tipo = '';
                                    }

                                    if ($habitacione->alojamientosPersonales->count() == $habitacione->cupos) {
                                        $background = 'bg-personal';
                                        $tipo = 'C';
                                    } elseif ($habitacione->alojamientosPersonales->count() < $habitacione->cupos && $habitacione->alojamientosPersonales->count() > 0) {
                                        $background = 'bg-warning-personal';
                                        $tipo = 'C';
                                    }
                                @endphp
                                <div class="col-6 border d-flex align-items-start {{ $background }}">
                                    {!! Form::checkbox('habitaciones[]', $habitacione->id, null, [
                                        'class' => 'mr-1 mt-2',
                                        'id' => 'hab' . $habitacione->id,
                                    ]) !!}
                                    <label for="{{ 'hab' . $habitacione->id }}" class="w-100">
                                        {{ $habitacione->numero }} -
                                        @switch($tipo)
                                            @case('P')
                                                @php
                                                    $f = [];
                                                @endphp
                                                @foreach ($habitacione->alojamientos as $alojamiento)
                                                    @if (!in_array($alojamiento->compania()->numero, $f) )
                                                        @php
                                                            array_push($f, $alojamiento->compania()->numero )
                                                        @endphp
                                                    @endif
                                                @endforeach
                                                <br>
                                                <span class="bg-danger px-1 rounded">    
                                                    {{ 'C: ' . implode(',',$f)}}
                                                </span>
                                                <br>
                                                {{ $habitacione->alojamientos->count() }}
                                            @break

                                            @case('C')
                                                {{ $habitacione->alojamientosPersonales->count() }}
                                            @break
                                        @endswitch
                                        /
                                        {{ $habitacione->cupos }}
                                        @if ($tipo == 'C')
                                            {{ 'Staff' }}
                                        @endif
                                    </label>
                                    <button type="button"
                                        class="btn btn-success btn-sm float-right showAlojamientos"
                                        data-toggle="modal" data-target="#showAlojamientos"
                                        data-habitacione="{{ $habitacione->id }}">
                                        <i class="far fa-eye"></i>
                                    </button>
                                </div>
                                @empty
                                    <div></div>
                                @endforelse
                            </div>
                        </div>
                        @empty
                            <div></div>
                        @endforelse
                    </div>
                </div>
            @endforeach
        </div>
        @livewire('admin.programa.show-alojamientos', ['programa' => $programa->id])
        <script>
           
        </script>
