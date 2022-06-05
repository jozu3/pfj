<div>
    <div class="card">
        <div class="card-header ui-sortable-handle" style="cursor: move;">
            <h3 class="card-title">
                <i class="fas fa-book-reader"></i>&nbsp;
                <b>Lecturas asignadas a la sesión</b>

            </h3>

            {{-- <div class="card-tools pagination pagination-sm">
                {{ $tareas->links() }}
            </div> --}}
        </div>

        <div>

        </div>
        <!-- /.card-header -->
        <div class="card-body">
            {{-- <div class="float-right">
            
        </div> --}}

            <ul class="todo-list ui-sortable" data-widget="todo-list">
                <li>
                    <span class="handle ui-sortable-handle" style="width: 10px">&nbsp;</span>
                    <span class="text" style="width: 100px">FECHA</span>
                    <span class="text">LECTURA</span>
                    <span class="float-right">
                        <button type="button" class="btn btn-sm btn-primary" wire:click="$toggle('addTarea')">
                            <i class="fas fa-plus-circle"></i> Registrar tareas para la semana
                        </button>
                    </span>
                </li>
                @if ($addTarea)
                    <li>
                        <form wire:submit.prevent="">
                            <div class="row">
                                {{-- <span class="handle ui-sortable-handle" style="width: 10px">&nbsp;</span> --}}
                                <input type="hidden" wire:model='idTarea'>
                                {{-- <span class="col-1 handle ui-sortable-handle"><i class="far fa-bookmark"></i></span> --}}
                                <span class="col-2 text" style="width: 100px">
                                    <i class="far fa-bookmark"></i>&nbsp; Semana de la tarea </span>
                                <span class="text" style="width: 200px">
                                    <div class="">
                                        <input type="date" class="form-control form-control-sm disabled:opacity-5"
                                            wire:model.defer='fecha_inicio' wire:loading.attr='disabled'
                                            wire:target='saveTarea'>
                                        <x-jet-input-error class="text-danger" for="fecha_inicio" />
                                    </div>
                                </span>
                                <span class="text">al</span>
                                <span class="text" style="width: 200px">
                                    <div class="">
                                        <input type="date" class="form-control form-control-sm disabled:opacity-5"
                                            wire:model.defer='fecha_final' wire:loading.attr='disabled'
                                            wire:target='saveTarea'>
                                        <x-jet-input-error class="text-danger" for="fecha_final" />
                                    </div>
                                </span>
                                <div class="">
                                    <button type="submit" class="btn btn-link" wire:click='saveTarea'
                                        wire:loading.remove wire:target='saveTarea'>
                                        <i class="fas fa-save"></i>
                                        Guardar Tarea</button>
                                    <span wire:loading wire:target='saveTarea'>Guardando ...</span>
                                </div>
                            </div>
                            <div class="row">
                                <span class="handle ui-sortable-handle" style="width: 10px">&nbsp;</span>
                                <span class="text text-center" style="width: 300px">Material</span>
                                <span class="text text-center" style="width: 300px">Temas</span>
                            </div>
                            @for ($i = 0; $i < $noMaterial; $i++)
                                <div class="row" wire:key="post-field-{{ $i }}">
                                    <input type="hidden" wire:model='tareaMateriales.{{ $i }}.id'
                                        wire:target='saveTarea'>
                                    <span class="handle ui-sortable-handle" style="width: 10px">&nbsp;</span>
                                    <span class="text text-center" style="width: 300px">
                                        <select class="form-control form-control-sm"
                                            wire:model.defer="tareaMateriales.{{ $i }}.materiale_id"
                                            wire:target='saveTarea'>
                                            <option selected>[-- Seleccione un material --]</option>
                                            @foreach ($materiales as $materiale)
                                                <option value="{{ $materiale->id }}">{{ $materiale->descripcion }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <x-jet-input-error class="text-danger"
                                            for="tareaMateriales.{{ $i }}.materiale_id" />
                                    </span>
                                    <span class="text text-center" style="width: 300px">
                                        <input type="text" class="form-control form-control-sm disabled:opacity-5"
                                            wire:model.defer="tareaMateriales.{{ $i }}.tema"
                                            wire:loading.attr='disabled' wire:target='saveTarea'>
                                        <x-jet-input-error class="text-danger"
                                            for="tareaMateriales.{{ $i }}.tema" />
                                    </span>
                                    <div class="col-2">
                                        <button class="btn btn-link"
                                            wire:click='quitarTareaMaterial({{ $i }})'>
                                            <i class="fas fa-times-circle"></i> Quitar</button>
                                    </div>
                                </div>
                            @endfor
                            <div class="row">
                                <div class="col">
                                    <button class="btn btn-link" wire:click='añadirTareaMaterial'>
                                        <i class="fas fa-plus-circle"></i>
                                        Añadir tarea</button>
                                    {{ $rrr }}
                                </div>
                            </div>
                        </form>
                    </li>
                @endif
                @foreach ($tareas as $tarea)
                    <li id="accordion{{$tarea->id}}">
                        <div class="row">
                            <span class="col-2 text">
                                <i class="fas fa-bookmark text-warning"></i>&nbsp; Semana
                            </span>
                            <span class="col-2 text">
                                <div class="bg-info rounded-pill text-center">
                                    {{ date( 'd/m/Y', strtotime($tarea->fecha_inicio)) }}
                                </div>
                            </span>
                            <span class="col-1 text">al</span>
                            <span class="col-2 text" style="width: 200px">
                                <div class="bg-info rounded-pill text-center">
                                    {{ date( 'd/m/Y', strtotime($tarea->fecha_final)) }}
                                </div>
                            </span>
                            {{-- <span class="text">{{ $tarea->descripcion }}</span> --}}
                            <div class="row"> {{-- col-4 col-md-3--}}
                                <a class="col btn btn-link collapsed" data-toggle="collapse" href="#collapse{{ $tarea->id }}"
                                    aria-expanded="false"><i class="fas fa-eye"></i></a>
                                <button class="col btn btn-link btn-sm"><i class="fas fa-edit"
                                        wire:click='editTarea({{ $tarea }})'></i></button>
                                <button class="col btn btn-link btn-sm"><i class="fas fa-trash-alt"
                                        wire:click='removeTarea({{ $tarea->id }})'></i></button>
                            </div>
                        </div>
                        <div>
                            <div class="collapse" id="collapse{{ $tarea->id }}" data-parent="#accordion{{$tarea->id}}">
                                <div class="row text-warning">
                                    <span class="handle ui-sortable-handle" style="width: 10px">&nbsp;</span>
                                    <span class="text text-center" style="width: 300px">Material</span>
                                    <span class="text text-center" style="width: 300px">Temas</span>
                                </div>
                                @foreach ($tarea->tareaMateriales as $item)
                                    <div class="row">
                                        <span class="handle ui-sortable-handle" style="width: 10px">&nbsp;</span>
                                        <span class="text text-center" style="width: 300px">                                            
                                            <p>{{ $item->materiale->descripcion }}</p>
                                        </span>
                                        <span class="text text-center" style="width: 300px">
                                            <p style="font-weight: normal;">{{ $item->tema }}</p>
                                        </span>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
        <!-- /.card-body -->
        <div class="card-footer clearfix">
            {{-- <button type="button" class="btn btn-sm btn-primary float-right" wire:click="$toggle('addTarea')">
            <i class="fas fa-plus-circle"></i> Añadir tarea
        </button> --}}
            {{-- @livewire('admin.create-tarea') --}}
        </div>
    </div>
    <script>
        window.addEventListener('questionremove', event => {
            Swal.fire({
                title: 'Advertencia',
                text: "¿Está seguro que desea eliminar esta tarea?" + event.detail.msj,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Continuar',
                cancelButtonText: "Cancelar",
            }).then((result) => {
                if (result.value) {
                    @this.call('removeTarea', event.detail.idTarea, true)
                }
            })
        })
    </script>
</div>
