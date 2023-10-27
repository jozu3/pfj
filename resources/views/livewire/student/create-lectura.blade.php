<div>
    <div class="w-full bg-gray-100 rounded-full mt-2 mx-2">
        <div class="bg-red40-pfj text-xs font-medium text-blue-100 text-center p-0.5 leading-none rounded-full"
            style="width: {{ $avance }}%"> {{ $avance }}%</div>
    </div>
    <div class="grid grid-cols-6 my-4 mx-2">
        {{-- {{ $programa->nombre }} --}}
        @foreach ($programa->tareas->sortBy('fecha_inicio') as $tarea)
            <div class="col-span-4 lg:col-span-2 border-3 bg-yellow-100 p-2 m-1 shadow-md">
                <div class="">
                    <div class="form-check">
                        @php
                            $idTarea = $tarea->id;
                            $realizado = 1;
                            
                            $checkedTarea = $inscripcioneTareas->contains(function ($val, $key) use ($idTarea, $realizado) {
                                return $val->tarea_id == $idTarea && $val->realizado == $realizado;
                            })
                                ? 'checked'
                                : '';
                        @endphp
                        <input class="form-check-input appearance-none w-4 border border-gray-300 rounded-sm bg-white checked:bg-yellow-600 checked:border-yellow-600 focus:outline-none transition duration-200 my-1 align-top bg-no-repeat bg-center bg-contain float-left cursor-pointer"
                            {{ $checkedTarea }} type="checkbox" id="flexCheckChecked{{ $tarea->id }}"
                            style="color: #ed9934;" wire:click="realizado({{ $tarea->id }})">
                        <label for="flexCheckChecked{{ $tarea->id }}" class="ml-2 text-sm  md:text-md">
                            Semana del {{ date('d/m/Y', strtotime($tarea->fecha_inicio)) }} al
                            {{ date('d/m/Y', strtotime($tarea->fecha_final)) }}
                        </label>
                        <ul>
                            @foreach ($tarea->tareaMateriales as $tareaMateriale)
                                <li class="text-center">
                                    @if ($tareaMateriale->link != '' && $tareaMateriale->link != null)
                                        <a href="{{ $tareaMateriale->link }}" target="_blank" class="text-blue-800 font-bold">
                                            {{ $tareaMateriale->materiale->descripcion }}: {{ $tareaMateriale->tema }}
                                        </a>
                                    @else
                                        {{ $tareaMateriale->materiale->descripcion }}: {{ $tareaMateriale->tema }}
                                    @endif
                                </li>
                            @endforeach
                        </ul>   
                    </div>
                </div>
                @can('student.lecturas.comentarios')
                    <div class="text-sm md:text-md  text-center p-2 italic font-bold text-blue-400 pb-4">
                        <a href="{{route('st.tareas.show', $tarea)}}">Ver</a>
                    </div>
                @endcan
                {{-- @if ($checkedTarea)
                    <div class="text-sm">Leído: {{ $tarea->updated_at }}</div>
                @endif --}}
            </div>
        @endforeach
    </div>
</div>
