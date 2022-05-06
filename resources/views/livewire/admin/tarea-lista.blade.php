<div>
    <div class="card">
        <div class="card-header ui-sortable-handle" style="cursor: move;">
            <h3 class="card-title">
                <i class="fas fa-book-reader"></i>&nbsp;
                <b>Lecturas asignadas a la sesión</b>
            </h3>

            <div class="card-tools pagination pagination-sm">                
                {{ $tareas->links() }}
            </div>
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
                            <i class="fas fa-plus-circle"></i> Añadir tarea
                        </button>
                    </span>
                </li>
                @if ($addTarea)
                    <li>
                        {{-- <span class="handle ui-sortable-handle" style="width: 10px">&nbsp;</span> --}}
                        <input type="hidden" wire:model='idTarea'>
                        <span class="text" style="width: 200px">
                            <div class="">
                                <input type="date" class="form-control form-control-sm disabled:opacity-5" wire:model.defer='fecha' wire:loading.attr='disabled' wire:target='saveTarea'>
                                <x-jet-input-error class="text-danger" for="fecha" />
                            </div>
                        </span>
                        <span class="text w-auto">
                            <input type="text" class="form-control form-control-sm disabled:opacity-5" wire:model.defer="descripcion" wire:loading.attr='disabled' wire:target='saveTarea'>
                            <x-jet-input-error class="text-danger" for="descripcion" />
                        </span>
                        <div class="tools">
                            <a href="#" class="btn btn-link" wire:click='saveTarea' wire:loading.remove wire:target='saveTarea'>
                                <i class="fas fa-save"></i>
                                Guardar</a>
                            <span wire:loading wire:target='saveTarea'>Guardando ...</span>
                        </div>
                    </li>
                @endif
                @foreach ($tareas as $tarea)
                    <li>                        
                        <span class="handle ui-sortable-handle" style="width: 10px">
                            <i class="far fa-bookmark"></i> 
                        </span>
                        <span class="text" style="width: 100px">{{ $tarea->fecha }}</span>
                        <span class="text">{{ $tarea->descripcion }}</span>
                        <div class="tools">
                            <a href="#"><i class="fas fa-edit" wire:click='editTarea({{ $tarea }})'></i></a>
                            <a href="#"><i class="fas fa-trash-alt" wire:click='removeTarea({{ $tarea->id }})'></i></a>
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
</div>
