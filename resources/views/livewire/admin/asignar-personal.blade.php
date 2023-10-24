<div>
    <div class="row">
        <div class="col-md-12">
            <div class="custom-control custom-checkbox mr-sm-2 d-inline">
                <input class="form-check-input" wire:model="psinasignar" type="checkbox" value="" id="psinasignar">
                <label class="form-check-label" for="psinasignar">
                    Mostrar personal sin asignar
                </label>
            </div>
            <div class="custom-control custom-checkbox mr-sm-2 d-inline">
                <input class="form-check-input" wire:model="renderSortable" type="checkbox" value=""
                    id="renderSortable">
                <label class="form-check-label" for="renderSortable">
                    Mover personal
                </label>
            </div>

        </div>
    </div>
    <div class="container-fluid h-100">
        <div class="row">
            <div class="col-md-4 offset-md-4">
                <div class="card card-row card-primary">
                    <div class="card-header bg-success text-center">
                        <h3 class="card-title text-center w-100">Matrimonio Director</h3>
                    </div>
                    <div class="card-body row">
                        @foreach ($programa->matrimonioDirectores() as $inscripcione)
                            <div class="col-6">
                                <div class="card text-center w-100">
                                    <div class="card-header">
                                        <img class="img-fluid rounded-circle img-personal"
                                            src="{{ $inscripcione->personale->user->adminlte_image() }}" alt="">
                                    </div>
                                    <div class="card-body p-0">
                                        @if ($inscripcione->personale->user)
                                            <a href="{{ route('admin.contactos.show', $inscripcione->personale->contacto) }}"
                                                class="txt-red40-pfj">
                                                {{ $inscripcione->personale->user->name }}
                                            </a>
                                        @else
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="row">

            <div class="col-md-4"></div>
            <div class="col-md-4">
                <div class="card card-row card-primary">
                    <div class="card-header bg-red40-pfj text-center">
                        <h3 class="card-title text-center w-100">
                            Coordinadores
                        </h3>
                    </div>
                    <div class="card-body ">
                        <div class="card card-primary card-outline">
                            <div class="card-header companerismo row ignore-elements" data-id="cordis">
                                @forelse ($programa->coordinadores() as $inscripcione)
                                    <div class="col-6" data-id="{{ 'ins-' . $inscripcione->id }}">
                                        <div class="card text-center">
                                            <div class="card-header">
                                                <img class="img-fluid rounded-circle img-personal"
                                                    @if ($inscripcione->personale->user) {{ 'src=' . $inscripcione->personale->user->adminlte_image() . ' alt=""' }}
                                                    @else
                                                        {{ 'src=' . config('app.url') . '/img/' }} @endif>
                                                <div class="card-text"><small
                                                        class="text-muted">{{ $inscripcione->role->name }}</small>
                                                </div>
                                            </div>
                                            <div class="card-body p-0">
                                                @if ($inscripcione->personale->user)
                                                    <a href="{{ route('admin.contactos.show', $inscripcione->personale->contacto) }}"
                                                        class="txt-red40-pfj">
                                                        {{ $inscripcione->personale->user->name }}
                                                    </a>
                                                @else
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    {{-- <div class="col-12">
                                            <div class="card text-center">
                                                <div class="card-body">
                                                    No se ha asignado coordinadores
                                                </div>
                                            </div>
                                        </div> --}}
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4"></div>
            {{-- @foreach ($programa->grupos as $grupo) --}}
            @foreach ($grupos as $grupo)
                <div class="col-sm-6 col-md-4 col-lg-3">
                    <div class="card card-row card-primary">
                        <div class="card-header bg-red40-pfj">
                            <h3 class="card-title">
                                {{ 'Familia ' . $grupo->numero }}
                            </h3>
                            <div class="float-right">
                                <i class="fas fa-edit"
                                    wire:click='editFamilia({{ $grupo }}, {{ $grupo->companerismos->where('role_id', 6)->count() }})'
                                    style="cursor: pointer;"></i>
                                &nbsp;
                                <i class="fas fa-trash" wire:click='removeFamilia({{ $grupo->id }})'
                                    style="cursor: pointer;"></i>
                            </div>
                        </div>
                        <div class="card-body group" data-id="{{ 'grupo-' . $grupo->id }}">
                            @foreach ($grupo->companerismos as $companerismo)
                                <div class="card @if ($companerismo->role_id == 5) {{ 'bg-cordauxiliar' }}@else {{ 'card-primary' }} @endif  card-outline "
                                    data-id="{{ 'com-' . $companerismo->id }}">
                                    <div class="card-header text-center">
                                        <a href="{{ route('admin.programas.planificador', [
                                            'programa' => $companerismo->grupo->programa,
                                            'grupo' => $companerismo->grupo,
                                        ]) }}"
                                            class="float-right">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        @if ($companerismo->role_id == 6)
                                            {{ 'Compañia: ' . $companerismo->numero }}
                                        @endif
                                        @if ($companerismo->role_id == 5)
                                            {{ 'Coordinadores Auxiliares' }}
                                        @endif
                                    </div>
                                    <div class="card-header companerismo row"
                                        data-id="{{ 'com-' . $companerismo->id . '-' . str_replace(' ', '', $companerismo->role->name) }}">
                                        @forelse ($companerismo->inscripcioneCompanerismos as $inscripcioneCompanerismo)
                                            <div class="col-6"
                                                data-id="{{ 'ins-' . $inscripcioneCompanerismo->inscripcione->id }}">
                                                <div class="card text-center">
                                                    <div class="card-header inscripcione">
                                                        <img class="img-fluid rounded-circle img-personal"
                                                            @if ($inscripcioneCompanerismo->inscripcione->personale->user) {{ 'src=' . $inscripcioneCompanerismo->inscripcione->personale->user->adminlte_image() . ' alt=""' }}
                                                                @else
                                                                {{ 'src=' . config('app.url') . '/img/pfj-lima-norte.png' }} @endif>
                                                        <div class="card-text"><small
                                                                class="text-muted">{{ $inscripcioneCompanerismo->inscripcione->role->name }}</small>
                                                        </div>
                                                    </div>
                                                    <div class="card-body p-0">
                                                        <div class="card-text">
                                                            <a href="{{ route('admin.contactos.show', $inscripcioneCompanerismo->inscripcione->personale->contacto) }}"
                                                                class="txt-red40-pfj">
                                                                {{ $inscripcioneCompanerismo->inscripcione->personale->contacto->nombres . ' ' . $inscripcioneCompanerismo->inscripcione->personale->contacto->apellidos }}
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @empty
                                        {{-- <div class="text-center">
                                            {{'0 asignados.'}}
                                        </div> --}}
                                        @endforelse
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endforeach
            <div class="col-sm-6 col-md-4 col-lg-3">
                <div class="card card-row card-primary">
                    @if ($addFamilia)
                        <div class="card-body">
                            <input type="hidden" wire:model='idFamilia'>
                            <div>
                                <label for="">Número</label>
                                <input type="number" wire:model.defer='famNumero' class="form-control" min="1">
                            </div>
                            <div>
                                <label for="">Nombre de la familia</label>
                                <input type="text" wire:model.defer='famNombre' class="form-control">
                            </div>
                            <div>
                                <label for="">Cantidad de compañías</label>
                                <input type="number" wire:model.defer='compCantidad' class="form-control"
                                    min="1">
                            </div>
                            <div class="text-right">
                                <button class="btn btn-sm btn-warning" wire:click='createFamilia'>
                                    Añadir
                                </button>
                            </div>
                        </div>
                    @else
                        <div class="card-body">
                            {{-- <a href="#" class="btn btn-link" wire:click="$toggle('addFamilia')"> --}}
                            <h2 class="text-warning font-weight-bold text-center pe-auto" style="cursor: pointer;"
                                wire:click="$toggle('addFamilia')">
                                <i class="fas fa-plus-circle"></i>
                                Agregar familia
                            </h2>
                            {{-- </a> --}}
                        </div>
                    @endif

                </div>
            </div>
        </div>

        <div style="height: 300px"></div>
    </div>

    @if (count($programa->inscripcionesSinAsignar()))
        {{-- nada --}}
    @endif
    <div class="cont-psinasignar @if (!$psinasignar) {{ 'd-none' }} @endif">
        <div class="card card-row card-success">
            <div class="card-header ">
                <h3 class="card-title">
                    {{ 'Personal sin asignar' }}
                </h3>
            </div>
            <div class="card-body group" data-id="{{ 'grupo-' }}">
                <div class="" data-id="sinAsignar">
                    <div class="companerismo row" data-id="sinAsignar">
                        @foreach ($programa->inscripcionesSinAsignar() as $inscripcione)
                            <div class="col-md-1" data-id="{{ 'ins-' . $inscripcione->id }}">
                                <div class="card text-center">
                                    <div class="card-header inscripcione">
                                        <img class="img-fluid rounded-circle img-personal"
                                            @if ($inscripcione->personale->user) {{ 'src=' . $inscripcione->personale->user->adminlte_image() . ' alt=""' }}
                                                    @else
                                                    {{ 'src=' . config('app.url') . '/img/pfj-lima-norte.png' }} @endif>
                                        <div class="card-text"><small
                                                class="text-muted">{{ $inscripcione->role->name }}</small>
                                        </div>
                                    </div>
                                    <div class="card-body p-0">
                                        <div class="card-text">
                                            <a href="{{ route('admin.contactos.show', $inscripcione->personale->contacto) }}"
                                                class="txt-red40-pfj">
                                                {{ $inscripcione->personale->contacto->nombres . ' ' . $inscripcione->personale->contacto->apellidos }}
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>


</div>
