<div>
    <div class="pgrupos">
        <nav class="navbar navbar-dark bg-yellow-pfj">
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <a class="nombre-sesion" href="#">{{ $programa->nombre }}</a>
                @forelse ($programa->companias() as $compania)
                    <a class="nav-item nav-link" id="nav-home-tab{{ $compania->id }}" data-toggle="tab"
                        href="#nav-home{{ $compania->id }}" role="tab" aria-controls="nav-home{{ $compania->id }}"
                        aria-selected="">{{ 'Compañia ' . $compania->numero }}</a>
                @empty
                @endforelse
            </div>
        </nav>
        <div class="tab-content" id="nav-tabContent">
            @forelse ($programa->companias() as $compania)
                <div class="tab-pane fade show" id="nav-home{{ $compania->id }}" role="tabpanel"
                    aria-labelledby="nav-home-tab{{ $compania->id }}">
                    {{-- {{'familia:' . $compania->numero}} --}}
                    @livewire('admin.companias-participantes', ['companerismo' => $compania], key($compania->id))
                    {{-- @forelse ($compania as $companerismo)
                    @empty
                        
                    @endforelse --}}
                </div>
            @empty
                <div class="card">
                    <div class="card-header text-warning">
                        {{ 'No hay Compañias' }}
                    </div>
                </div>
            @endforelse

        </div>
    </div>


    <!-- Modal -->
    <div wire:ignore.self class="modal fade bd-example-modal-xl" id="sortCompanias" tabindex="-1" role="dialog"
        aria-labelledby="sortCompaniasLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                <div class="modal-content @if(!$paso1) {{ 'd-none' }}@endif">
                    <form wire:submit.prevent="" method="post">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title" id="sortCompaniasLabel">Crear Rangos de edad</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                {!! Form::label('cantidad', 'Cuantas compañias desea crear?') !!}
                                {!! Form::number('cantidad', null, [
                                    'class' => 'form-control',
                                    'placeholder' => 'Ingrese la cantidad de compañias a crear',
                                    'min' => '1',
                                    'wire:model' => 'cantidad',
                                    'disabled' => '',
                                ]) !!}
                                @error('cantidad')
                                    <small>{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="row">
                                <div class="col">
                                    <button class="btn btn-link" type="button" wire:click='añadirRango'>
                                        <i class="fas fa-plus-circle"></i>
                                        Añadir rango</button> {{ count($this->newRangos) }}
                                </div>
                            </div>

                            @forelse ($newRangos as $newRango)
                                <div class="form-row">
                                    <div class="col text text-center">
                                        <input type="text" class="form-control form-control-sm disabled:opacity-5"
                                            wire:model.defer="newRangos.{{ array_keys($newRangos)[$loop->index] }}.edadmin"
                                            wire:loading.attr='disabled' wire:target='saveTarea' placeholder="Edad minima">
                                        <x-jet-input-error class="text-danger"
                                            for="newRangos.{{ array_keys($newRangos)[$loop->index] }}.edadmin" />
                                    </div>
                                    <div class="col text text-center">
                                        <input type="text" class="form-control form-control-sm disabled:opacity-5"
                                            wire:model.defer="newRangos.{{ array_keys($newRangos)[$loop->index] }}.edadmax"
                                            wire:loading.attr='disabled' wire:target='saveTarea' placeholder="Edad máxima">
                                        <x-jet-input-error class="text-danger"
                                            for="newRangos.{{ array_keys($newRangos)[$loop->index] }}.edadmax" />
                                    </div>
                                    <div class="col">
                                        <button class="btn btn-link" type="button"
                                            wire:click='quitarNewRango({{ array_keys($newRangos)[$loop->index] }})'>
                                            <i class="fas fa-times-circle"></i> Quitar</button>
                                    </div>
                                </div>
                            @empty
                            @endforelse
                        </div>
                        <div class="modal-footer">
                            <div class="w-100 text-center">

                                @error('rangoParticipantes')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div>

                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="button" wire:loading.attr="disabled" wire:target="crearCompanias"
                                    class="btn btn-success disabled:opacity-25" wire:click="crearCompanias">
                                    Crear y continuar
                                </button>
                            </div>

                        </div>
                    </form>
                </div>        
                <div class="modal-content @if(!$paso2) {{ 'd-none' }}@endif">
                    <form wire:submit.prevent="" method="post">
                        @csrf
                        <div class="card-header">
                            <h5 class="modal-title" id="sortCompaniasLabel">Asignar rangos a las compañias</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="card-body">
                            @forelse ($rangosPrograma as $rango)
                                <div class="bg-warning my-3 px-2 rounded-lg">
                                    <h3>Rango: {{ $rango->edadmin . ' - ' . $rango->edadmax }}</h3>
                                    <span> Seleccione solo: <b>{{ $rango->cantcompanias }}</b> compañias</span>
                                </div>
                                <h2 class="h6">Lista de compañias</h2>
                                <div class="form-row">
                                    @forelse ($companias as $compania)
                                        <div class="col-2">
                                            {!! Form::checkbox('com', $compania->id, null, [
                                                'class' => 'mr-1',
                                                'id' => 'c' . $rango->id . $compania->id,
                                                'wire:model' => 'rangos.' . $rango->id . '-' . $compania->id . '.compania',
                                                'wire:click' => 'limpiarRangoCompania('.$rango->id.',' .$compania->id. ')'
                                            ]) !!}
                                            <label for="{{ 'c' . $rango->id . $compania->id }}" data-toggle="tooltip"
                                                class="bg-info px-2 rounded-lg"
                                                data-placement="top"
                                                title="@forelse ($compania->inscripcioneCompanerismos as $inscripcioneCompanerismo) {!! $inscripcioneCompanerismo->inscripcione->personale->contacto->nombres .
                                                    ' ' .
                                                    $inscripcioneCompanerismo->inscripcione->personale->contacto->apellidos .
                                                    '&#10;' !!}@empty {{'No hay consejeros'}} @endforelse">
                                                    <div class="">
                                                        Compañia: {{ $compania->numero }}
                                                    </div>
                                            </label>
                                            <label for="{{ 'c' . $rango->id . $compania->id }}" class="w-100">
                                                @foreach ($compania->inscripcioneCompanerismos as $insCompanerismo)
                                                    {{ '- '. $insCompanerismo->inscripcione->personale->contacto->nombres . ' '. $insCompanerismo->inscripcione->personale->contacto->apellidos }}
                                                    <br>
                                                @endforeach
                                            </label>
                                        </div>
                                    @empty
                                    @endforelse
                                </div>
                            @empty
                            @endforelse
                            {{-- @forelse ($rangos as $rango)
                                <div>
                                    {{array_keys($rangos)[$loop->index]}} -- {{ $rango['compania'] }}
                                </div>
                            @empty
                                
                            @endforelse --}}
                        </div>
                        <div class="card-footer">
                            <button type="button" wire:loading.attr="disabled" wire:target="volverPaso"
                                class="btn btn-success disabled:opacity-25" wire:click="volverPaso">
                                Volver
                            </button>
                            <button type="button" wire:loading.attr="disabled" wire:target="asginarCompaniasRangos"
                                class="btn btn-success disabled:opacity-25" wire:click="asginarCompaniasRangos">
                                Siguiente
                            </button>
                        </div>
                    </form>
                </div>
        
                <div class="modal-content @if (!$paso3) {{ 'd-none' }}@endif">
                    <form wire:submit.prevent="" method="post">
                        @csrf
                        <div class="card-header">
                            Paso 3
                        </div>
                        <div class="card-body text-center">
                            <div class="spinner-border text-info d-none" role="status" wire:loading.class.remove="d-none" wire:target="finalizar">
                                <span class="sr-only">Loading...</span>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="button" class="btn btn-primary" wire:click="volverPaso" wire:loading.attr="disabled"
                                wire:target="finalizar">Volver</button>
                            <button type="button" wire:loading.attr="disabled" wire:target="finalizar"
                                class="btn btn-success disabled:opacity-25" wire:click="finalizar">
                                Finalizar
                            </button>
                        </div>
                    </form>
                </div>
        </div>
    </div>

</div>
