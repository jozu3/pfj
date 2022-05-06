<div>
    <div class="row">
        <div class="col-md-12">
            <div class="custom-control custom-checkbox mr-sm-2 d-inline">
                <input class="form-check-input" wire:model= "psinasignar" type="checkbox" value="" id="psinasignar">
                <label class="form-check-label" for="psinasignar">
                    Mostrar personal sin asignar
                </label>
            </div>    
            
        </div>
    </div>
    <div class="container-fluid h-100">
        <div class="row">

                <div class="col-md-4"></div>
                <div class="col-md-4">
                    <div class="card card-row card-primary">
                        <div class="card-header bg-yellow-pfj text-center">
                            <h3 class="card-title">
                                Cordinadores
                            </h3>
                        </div>
                        <div class="card-body " >
                            <div class="card card-primary card-outline" >
                                <div class="card-header companerismo row ignore-elements" data-id="cordis">
                                        @forelse ($programa->coordinadores() as $inscripcione)
                                        <div class="col-6" data-id="{{ 'ins-' . $inscripcione->id}}">
                                            <div class="card text-center">
                                                <div class="card-header">
                                                    <img class="img-fluid rounded-circle img-personal" src="{{ $inscripcione->personale->user->adminlte_image() }}" alt="">
                                                    <div class="card-text"><small class="text-muted">{{ $inscripcione->role->name }}</small></div>
                                                </div>
                                                <div class="card-body p-0">
                                                    {{ $inscripcione->personale->user->name }}
                                                </div>
                                            </div>
                                        </div>
                                        @empty
                                        {{-- <div class="col-12">
                                            <div class="card text-center">
                                                <div class="card-body">
                                                    No se ha asignado cordinadores
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
                @foreach ($programa->grupos as $grupo)
                    <div class="col-sm-6 col-md-4 col-lg-3">
                        <div class="card card-row card-primary">
                            <div class="card-header bg-yellow-pfj">
                                <h3 class="card-title">
                                    {{ $grupo->nombre. ' ' . $grupo->numero }}
                                </h3>
                            </div>
                            <div class="card-body group" data-id="{{'grupo-'.$grupo->id}}">
                                @foreach ($grupo->companerismos as $companerismo)
                                    <div class="card @if ($companerismo->role_id == 5) {{ 'bg-cordauxiliar' }}@else {{ 'card-primary' }} @endif  card-outline " data-id="{{'com-'.$companerismo->id}}">
                                        <div class="card-header companerismo row" data-id="{{'com-'.$companerismo->id.'-'.str_replace(' ','', $companerismo->role->name)}}"> 
                                            @foreach ($companerismo->inscripcioneCompanerismos as $inscripcioneCompanerismo)
                                            <div class="col-6" data-id="{{'ins-'.$inscripcioneCompanerismo->inscripcione->id}}">
                                                <div class="card text-center">
                                                    <div class="card-header inscripcione">
                                                        <img class="img-fluid rounded-circle img-personal" src="{{ $inscripcioneCompanerismo->inscripcione->personale->user->adminlte_image() }}" alt="">
                                                        <div class="card-text"><small class="text-muted">{{ $inscripcioneCompanerismo->inscripcione->role->name }}</small></div>                                                   
                                                    </div>
                                                    <div class="card-body p-0">
                                                        <div class="card-text">{{ $inscripcioneCompanerismo->inscripcione->personale->user->name }}</div>
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endforeach
                </div>
                <div style="height: 300px"></div>

            </div>

            @if (count($programa->inscripcionesSinAsignar()))
                <div class="cont-psinasignar @if(!$psinasignar) {{ 'd-none'}}  @endif">
                    <div class="card card-row card-success">
                        <div class="card-header ">
                            <h3 class="card-title">
                                {{ 'Personal sin asignar'}}
                            </h3>
                        </div>
                        <div class="card-body group" data-id="{{'grupo-'}}">
                            <div class="" data-id="sinAsignar">
                                <div class="companerismo row" data-id="sinAsignar"> 
                                    @foreach ($programa->inscripcionesSinAsignar() as $inscripcione)
                                    <div class="col-md-1" data-id="{{'ins-'.$inscripcione->id}}">
                                        <div class="card text-center">
                                            <div class="card-header inscripcione">
                                                <img class="img-fluid rounded-circle img-personal" src="{{ $inscripcione->personale->user->adminlte_image() }}" alt="">
                                                <div class="card-text"><small class="text-muted">{{ $inscripcione->role->name }}</small></div>                                                   
                                            </div>
                                            <div class="card-body p-0">
                                                <div class="card-text">{{ $inscripcione->personale->user->name }}</div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
    
            
        </div>
    </div>
</div>
