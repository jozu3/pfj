<div>
    <div class="card">
        <div class="card-header ui-sortable-handle" style="cursor: move;">
            <h3 class="card-title">
                <i class="fas fa-book-reader"></i>&nbsp;
                <b>Lecturas asignadas a la sesión</b>
                {{-- {{$descripcion}} --}}
            </h3>
            <div class="card-tools pagination pagination-sm">
                {{ $tareas->links() }}
            </div>
        </div>

        <div>

        </div>
        <div class="card-body">
            <ul class="todo-list ui-sortable" data-widget="todo-list">
                <li>
                    <span class="handle ui-sortable-handle" style="width: 10px">&nbsp;</span>
                    <span class="text" style="width: 100px">FECHA</span>
                    <span class="text">LECTURA</span>
                    <span class="">
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
                                <div class="col-md-12" wire:ignore>
                                    {!! Form::label('descripcion', 'Descripción') !!}
                                    {!! Form::textarea('descripcion', null, [
                                        // 'id' => 'descripcion',
                                        'wire:model' => 'descripcion',
                                        'class' => 'form-control',
                                        'placeholder' => 'Añade una descripción para la tarea ...',
                                    ]) !!}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-3 text-center">
                                    <span class="text " style="">Material</span>
                                </div>
                                <div class="col-sm-3 text-center">
                                    <span class="text " style="">Temas</span>
                                </div>
                                <div class="col-sm-3 text-center">
                                    <span class="text " style="">Enlace</span>
                                </div>
                                <div class="col-sm-3">
                                </div>
                            </div>
                            @for ($i = 0; $i < $noMaterial; $i++)
                                <div class="row" wire:key="post-field-{{ $i }}">
                                    <div class="col-sm-3">
                                        <input type="hidden" wire:model='tareaMateriales.{{ $i }}.id'
                                            wire:target='saveTarea'>
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
                                    </div>
                                    <div class="col-sm-3">
                                        <input type="text" class="form-control form-control-sm disabled:opacity-5"
                                            wire:model.defer="tareaMateriales.{{ $i }}.tema"
                                            wire:loading.attr='disabled' wire:target='saveTarea'>
                                        <x-jet-input-error class="text-danger"
                                            for="tareaMateriales.{{ $i }}.tema" />
                                    </div>
                                    <div class="col-sm-3">
                                        <input type="text" class="form-control form-control-sm disabled:opacity-5"
                                            wire:model.defer="tareaMateriales.{{ $i }}.link"
                                            wire:loading.attr='disabled' wire:target='saveTarea'>
                                        <x-jet-input-error class="text-danger"
                                            for="tareaMateriales.{{ $i }}.tema" />
                                    </div>
                                    <div class="col-sm-3">
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
                    <li id="accordion{{ $tarea->id }}">
                        <div class="row">
                            <span class="col-2  text">
                                <i class="fas fa-bookmark text-warning"></i>&nbsp;
                                <span class="t-semana">Semana</span>
                            </span>
                            <div class="col">
                                <div class="form-row">
                                    <span class="col-md-4 ">
                                        <div class="bg-info rounded-pill text-center">
                                            {{ date('d/m/Y', strtotime($tarea->fecha_inicio)) }}
                                        </div>
                                    </span>
                                    <span class="col-md-4 text-center">al</span>
                                    <span class="col-md-4 ">
                                        <div class="bg-info rounded-pill text-center">
                                            {{ date('d/m/Y', strtotime($tarea->fecha_final)) }}
                                        </div>
                                    </span>
                                </div>
                            </div>
                            <div class="col">
                                <div class="row">
                                    <a class="col-md-4 btn btn-link collapsed" data-toggle="collapse"
                                        href="#collapse{{ $tarea->id }}" aria-expanded="false"><i
                                            class="fas fa-eye"></i></a>
                                    <button class="col-md-4 btn btn-link btn-sm"><i class="fas fa-edit"
                                            wire:click='editTarea({{ $tarea }})'></i></button>
                                    <button class="col-md-4 btn btn-link btn-sm"><i class="fas fa-trash-alt"
                                            wire:click='removeTarea({{ $tarea->id }})'></i></button>
                                </div>
                            </div>

                        </div>
                        <div>
                            <div class="collapse px-3" id="collapse{{ $tarea->id }}"
                                data-parent="#accordion{{ $tarea->id }}">
                                <div>
                                    {!! $tarea->descripcion !!}
                                </div>
                                <div>
                                    <table class="table table-sm table-striped">
                                        <thead>
                                            <tr class="text-warning">
                                                <th scope="col">Material</th>
                                                <th scope="col">Tema</th>
                                                <th scope="col">Enlace</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($tarea->tareaMateriales as $item)
                                                <tr>
                                                    <td>{{ $item->materiale->descripcion }}</td>
                                                    <td>{{ $item->tema }}</td>
                                                    <td>{{ $item->link }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
        <div class="card-footer clearfix">
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
        document.addEventListener('livewire:load', function() {
            let editor;
            Livewire.on('addtareadescripcion', () => {
                var textarea_descripcion = document.querySelector('#descripcion');
                if (textarea_descripcion) {
                    ClassicEditor.create(textarea_descripcion, {
                            simpleUpload: {
                                // The URL that the images are uploaded to.
                                uploadUrl: '{{ route("admin.programas.planificador.upload-image-tarea") }}',

                                // Enable the XMLHttpRequest.withCredentials property.
                                withCredentials: true,

                                // Headers sent along with the XMLHttpRequest to the upload server.
                                headers: {
                                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                                    'Accept' : 'application/json'
                                }
                            }
                        })
                        .then(newEditor => {
                            editor = newEditor;
                            var desc = @this.descripcion;
                            // console.log(desc);
                            if (desc != '') {
                                editor.setData(desc);
                            } else {}
                            editor.model.document.on('change:data', () => {
                                @this.set('descripcion', newEditor.getData());
                            });
                        })
                        .catch(error => {
                            console.error(error);
                        });
                }

            });

            Livewire.on('edtTarea', () => {
                var desc = @this.descripcion;
                // console.log(desc);
                if (editor && desc != '') {
                    editor.setData(desc);
                } else {}
            });


        });
    </script>
</div>
