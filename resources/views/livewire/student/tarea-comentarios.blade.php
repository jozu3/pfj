<div>
    <div class="py-3">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6">
                    <div class="flex flex-col">
                        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                            <div class="py-2 align-middle min-w-full sm:px-6 lg:px-8">
                                <div class="container py-6">
                                    <div
                                        class="grid grid-cols-1 gap-4 place-content-center text-3xl text-center text-gray-900 border-b-2 mb-6 font-bold">
                                        Semana del {{ date('d/m/Y', strtotime($tarea->fecha_inicio)) }} al
                                        {{ date('d/m/Y', strtotime($tarea->fecha_final)) }}
                                    </div>
                                    @if ($tarea->descripcion != '')  
                                        <div class="border-b-2 my-6 pb-6">
                                            {!! $tarea->descripcion !!}
                                        </div>
                                    @endif

                                    <div class="grid md:grid-cols-1 sm:grid-cols-1 gap-4 place-content-center mt-4">
                                        <div class="text-left">
                                            <b>Tareas:</b>
                                        </div>
                                        <div class="text-left">
                                            <ul>
                                                @foreach ($tarea->tareaMateriales as $tareaMateriale)
                                                    <li class="text-left">
                                                        @if ($tareaMateriale->link != '' && $tareaMateriale->link != null)
                                                            <a href="{{ $tareaMateriale->link }}" target="_blank" class="text-blue-600 font-bold">
                                                                {{ $tareaMateriale->materiale->descripcion }}:
                                                                {{ $tareaMateriale->tema }}
                                                            </a>
                                                        @else
                                                            {{ $tareaMateriale->materiale->descripcion }}:
                                                            {{ $tareaMateriale->tema }}
                                                        @endif
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="container py-6">
                                    <div  class="grid grid-cols-1 gap-4 place-content-center text-3xl text-center text-gray-900 border-b-2 mb-6 font-bold">
                                    </div>

                                    <div class="grid md:grid-cols-1 sm:grid-cols-1 gap-4 place-content-center mt-4">
                                        <div class="text-left text-lg">
                                          Cuentanos tus impresiones con esta asignación:
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @foreach ($comentarios as $comentario)
    <div class="p-3">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex items-top gap-x-2 sm:gap-x-6">
                <img class="h-12 sm:h-20 w-12 sm:w-20 rounded-full" src="{{ $comentario->inscripcione->personale->user->adminlte_image() }}" alt="">
                <div class="bg-white overflow-hidden shadow-xl rounded-lg p-2">
                    <div class="flex items-center gap-x-2 sm:gap-x-6">
                        <div>
                            <h3 class="text-base font-semibold leading-7 tracking-tight text-gray-900">
                                {{ $comentario->inscripcione->personale->user->fullname() }}
                                <span class="text-xs text-gray-400">{{ date('d/m/Y H:i:s', strtotime($comentario->created_at))}}</span>
                            </h3>
                            <p class="text-sm font-semibold leading-6 text-indigo-600">
                                {{ $comentario->comentario }}
                            </p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    @endforeach
   
    <div class="p-3">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex items-top gap-x-2 sm:gap-x-6">
                <img class="h-12 sm:h-20 w-12 sm:w-20 rounded-full" src="{{auth()->user()->adminlte_image()}}" alt="">
                <div class="bg-white overflow-hidden shadow-xl rounded-lg p-2">
                    <div class="flex items-center gap-x-2 sm:gap-x-6">
                        <div>
                            <h3 class="text-base font-semibold leading-7 tracking-tight text-gray-900">{{auth()->user()->fullname()}}
                            </h3>
                            <p class="text-sm font-semibold leading-6 text-indigo-600">
                                {!!Form::textarea('comentario', null, [ 'wire:model' => 'newcomentario', 'class'=> 'border-0 w-full', 'rows' => '2', 'placeholder' => 'Agrega un comentario...'])!!}    
                            </p>
                            <div class="text-right">
                                <button id="enviar"
                                    class='inline-flex items-center px-2 py-1
                                        bg-red40-pfj 
                                        border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest 
                                        hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 
                                        focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150'
                                        type="submit" wire:loading.attr="disabled" wire:target="saveComentario" wire:click="saveComentario">
                                        <i class="fas fa-paper-plane"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>


</div>
