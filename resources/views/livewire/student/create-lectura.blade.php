<div>
    {{ $programa->tareas->count() }}
    {{ $inscripcioneTareas->where('realizado', true)->count() }}
    @php
        $avance = ($inscripcioneTareas->where('realizado', true)->count() / $programa->tareas->count()) * 100;
    @endphp
    <div class="w-full bg-gray-100 rounded-full mt-2 mx-2">
        <div class="bg-yellow-pfj text-xs font-medium text-blue-100 text-center p-0.5 leading-none rounded-l-full"
            style="width: {{ $avance }}%"> {{ $avance }}%</div>
    </div>
    <div class="grid grid-cols-6 my-4 mx-2">
        {{-- {{ $programa->nombre }} --}}
        @foreach ($programa->tareas->sortByDesc('fecha') as $tarea)
            <div class="col-span-3 lg:col-span-1 border-3 bg-yellow-100 p-2 m-1 shadow-md">
                <div class="h-8">
                    <div class="form-check">
                        @php
                            $idTarea = $tarea->id;
                            $realizado = true;
                            
                            $checkedTarea = $inscripcioneTareas->contains(function ($val, $key) use ($idTarea, $realizado) {
                                return $val->tarea_id == $idTarea && $val->realizado == $realizado;
                            })
                                ? 'checked'
                                : '';
                        @endphp
                        <input
                            class="form-check-input appearance-none h-4 w-4 border border-gray-300 rounded-sm bg-white checked:bg-yellow-600 checked:border-yellow-600 focus:outline-none transition duration-200 my-1 align-top bg-no-repeat bg-center bg-contain float-left cursor-pointer"
                            {{ $checkedTarea }} type="checkbox" id="flexCheckChecked3" style="color: #ed9934;"
                            wire:click="realizado({{ $tarea->id }})">
                    </div>
                </div>
                <div class="text-2xl text-center p-2 italic font-bold pb-4">{{ $tarea->descripcion }}</div>
                {{-- @if ($checkedTarea)
                    <div class="text-sm">Leído: {{ $tarea->updated_at }}</div>
                @endif --}}
            </div>
        @endforeach
    </div>
</div>
