<div>
    <div class="pgrupos">
        <nav class="navbar navbar-dark bg-yellow-pfj">
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <a class="nombre-sesion" href="#">{{ $programa->nombre }}</a>
                @forelse ($programa->grupos as $grupo)
                    <a class="nav-item nav-link" id="nav-home-tab{{ $grupo->id }}" data-toggle="tab"
                        href="#nav-home{{ $grupo->id }}" role="tab" aria-controls="nav-home{{ $grupo->id }}"
                        aria-selected="">{{ 'Grupo ' . $grupo->numero }}</a>
                @empty
                @endforelse
            </div>
        </nav>
        <div class="tab-content" id="nav-tabContent">
            @forelse ($programa->grupos as $grupo)
                <div class="tab-pane fade show" id="nav-home{{ $grupo->id }}" role="tabpanel"
                    aria-labelledby="nav-home-tab{{ $grupo->id }}">
                    @livewire('admin.companias-participantes', ['compania' => $grupo->id], key($grupo->id))
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
    <div wire:ignore.self class="modal fade" id="sortCompanias" tabindex="-1" role="dialog"
        aria-labelledby="sortCompaniasLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form wire:submit.prevent="" method="post">
                    @csrf
                    @if ($paso1)
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
                                    'disabled' => ''
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

                            @foreach ($newRangos as $newRango)
                                <div class="form-row">
                                    <div class="col text text-center">
                                        <input type="text" class="form-control form-control-sm disabled:opacity-5"
                                            wire:model.defer="newRangos.{{ array_keys($newRangos)[$loop->index] }}.edadmin"
                                            wire:loading.attr='disabled' wire:target='saveTarea'>
                                        <x-jet-input-error class="text-danger"
                                            for="newRangos.{{ array_keys($newRangos)[$loop->index] }}.edadmin" />
                                    </div>
                                    <div class="col text text-center">
                                        <input type="text" class="form-control form-control-sm disabled:opacity-5"
                                            wire:model.defer="newRangos.{{ array_keys($newRangos)[$loop->index] }}.edadmax"
                                            wire:loading.attr='disabled' wire:target='saveTarea'>
                                        <x-jet-input-error class="text-danger"
                                            for="newRangos.{{ array_keys($newRangos)[$loop->index] }}.edadmax" />
                                    </div>
                                    <div class="col">
                                        <button class="btn btn-link" type="button"
                                            wire:click='quitarNewRango({{ array_keys($newRangos)[$loop->index] }})'>
                                            <i class="fas fa-times-circle"></i> Quitar</button>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" wire:loading.attr="disabled" wire:target="crearCompanias"
                                class="btn btn-success disabled:opacity-25" wire:click="crearCompanias">
                                Crear y continuar
                            </button>

                        </div>
                    @endif
                    @if ($paso2)
                        <div class="card-header">
                            <h5 class="modal-title" id="sortCompaniasLabel">Asignar rangos a las compañias</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="card-body">
                            @foreach ($this->programa->edadRangos as $rango)
                                <div class="form-row">
                                    <h3>Rango: {{ $rango->edadmin . ' - ' . $rango->edadmax }}</h3>
                                </div>
                                <h2 class="h6">Lista de compañias</h2>
                                <div class="form-row">
                                    @foreach ($this->programa->companias() as $compania)
                                        <div class="col-1">
                                            {!! Form::checkbox('com', $compania->id, null, [
                                                'class' => 'mr-1',
                                                'id' => 'c' . $rango->id . $compania->id,
                                                'wire:model' => 'rangos.'.$rango->id.'-'.$compania->id.'.compania'
                                            ]) !!}
                                            <label for="{{ 'c' . $rango->id . $compania->id }}" data-toggle="tooltip"
                                                data-placement="top"
                                                title="@foreach ($compania->inscripcioneCompanerismos as $inscripcioneCompanerismo){!! $inscripcioneCompanerismo->inscripcione->personale->contacto->nombres .
                                                    ' ' .
                                                    $inscripcioneCompanerismo->inscripcione->personale->contacto->apellidos .
                                                    '&#10;' !!}@endforeach">
                                                {{ $compania->numero }}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            @endforeach
                            {{ var_dump($rangos) }}
                        </div>
                        <div class="card-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" wire:loading.attr="disabled" wire:target="asginarCompaniasRangos"
                                class="btn btn-success disabled:opacity-25" wire:click="asginarCompaniasRangos">
                                Siguiente
                            </button>
                        </div>
                    @endif
                    @if ($paso3)
                        <div class="card-header">
                            Paso 3
                        </div>
                        <div class="card-body">
                            {{ $cPNA }}
                        </div>
                        <div class="card-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" wire:loading.attr="disabled" wire:target="finalizar"
                                class="btn btn-success disabled:opacity-25" wire:click="finalizar">
                                Siguiente
                            </button>
                        </div>
                    @endif

                </form>
            </div>
        </div>
    </div>

</div>
