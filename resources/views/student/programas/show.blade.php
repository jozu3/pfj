<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-3xl text-gray-800 leading-tight">
            Bienvenido(a) a tu sesión {{ $inscripcione->programa->nombre }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6">
                    <!-- This example requires Tailwind CSS v2.0+ -->
                    <div class="flex flex-col">
                        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                            <div class="py-2 align-middle min-w-full sm:px-6 lg:px-8">
                                <!-- inline-block --->

                                <div class="container py-6">
                                    <div class="grid grid-cols-1 gap-4 place-content-center text-3xl text-center text-gray-900 border-b-2 mb-6 font-bold">
                                        <p class="">Matrimonio Director</p> <!-- border-b-4 -->
                                    </div>

                                    <div class="grid md:grid-cols-2 sm:grid-cols-1 gap-4 place-content-center mt-4">
                                        <div class="text-center">
                                                @if ($inscripcione->programa->imageMatrimonioDirector)
                                                    <img src="{{ Storage::url($inscripcione->programa->imageMatrimonioDirector->url) }}"
                                                    alt="" class="object-top rounded-full m-auto" width="300px">
                                                @endif
                                            </div>
                                        <div class="md:text-left text-center">
                                            @forelse ($inscripcione->programa->matrimonioDirectores() as $lider)
                                                <p class="text-xl"><b>{{ $lider->personale->user->name }}</b></p>
                                            @empty
                                                <p>No asignados</p>
                                            @endforelse
                                            <br>
                                            @if ($inscripcione->programa->resena_matrimonio)
                                                <p>{!! $inscripcione->programa->resena_matrimonio !!}</p>
                                            @endif
                                        </div>
                                      </div>
                                    <div class="text-center">
                                        
                                    </div>

                                </div>
                              
                                <div class="container py-6" style="height: 600px; max-height: 600px"> 
                                    <div class="text-3xl text-center text-gray-900 border-b-2 mb-4 font-bold">
                                        <p class="">Anuncios</p> <!-- border-b-4 -->
                                    </div>
                                    <div id="carouselExampleIndicators" class="carousel slide relative" style="height: 500px" data-bs-ride="carousel">
                                        <div class="carousel-indicators absolute right-0 bottom-0 left-0 flex justify-center p-0 mb-4">
                                          
                                          @php
                                                $i = 0;
                                            @endphp
                                            @foreach ($inscripcione->programa->anuncios->where('estado', '1') as $anuncio)
                                            {{-- @if ($anuncio->image) --}}
                                            <button
                                                type="button"
                                                data-bs-target="#carouselExampleIndicators"
                                                data-bs-slide-to="{{ $i }}"
                                                @if ($i == 0)
                                                    {{ "class=active aria-current=true"  }}
                                                @endif
                                                aria-label="Slide {{ $i+1 }}"
                                            ></button>
                                                @php
                                                    $i++;
                                                @endphp
                                            {{-- @endif --}}
                                            @endforeach
                                        </div>
                                        <div class="carousel-inner relative w-full overflow-hidden" style="height: 500px; max-height: 500px">
                                            @php
                                                $i = 0;
                                            @endphp
                                            @forelse ($inscripcione->programa->anuncios->where('estado', '1') as $anuncio)
                                            
                                            @switch($anuncio->tipo)
                                                @case(1)
                                                    @php
                                                        $color = 'bg-red-600';
                                                        $texto = 'Urgente!';
                                                        @endphp
                                                    @break
                                                @case(2)
                                                    @php
                                                        $color = 'bg-blue-600'	;
                                                        $texto = 'Información';
                                                    @endphp
                                                    @break
                                                @case(3)
                                                    @php
                                                        $color = 'bg-yellow-500'	;
                                                        $texto = 'Advertencia';
                                                    @endphp
                                                    @break
                                                @default
                                                    
                                            @endswitch
                                            
                                            <div class="carousel-item text-center @if($i == 0){{ "active"  }}@endif w-full overflow-hidden">
                                               
                                            <img
                                                src=" @if ($anuncio->image){{ Storage::url($anuncio->image->url) }}@endif"
                                                class="block m-auto"
                                                width="500"
                                                alt=""
                                                />
                                                @if (!$anuncio->image)
                                                <div class="carousel-caption block absolute inset-0 text-center" style="
                                                display: flex;
                                                align-items: center;
                                                justify-content: center;"        >
                                                    <div class="flex justify-center">
                                                        <div class="block rounded-lg shadow-lg bg-white max-w-sm text-center">
                                                          <div class="py-3 px-6 rounded-lg  border-b border-gray-300 font-extrabold {{ $color }}">
                                                            {{ $texto }}
                                                          </div>
                                                          <div class="p-6">
                                                            <h5 class="text-gray-900 text-xl font-medium mb-2"> {{ $anuncio->descripcion }}</h5>
                                                            {{-- <button type="button" class=" inline-block px-6 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out">Button</button> --}}
                                                          </div>
                                                          {{-- <div class="py-3 px-6 border-t border-gray-300 text-gray-600">
                                                            2 days ago
                                                          </div> --}}
                                                        </div>
                                                      </div>
                                                </div>
                                                @endif
                                            </div>
                                                        
                                            @php
                                                $i = $i+1;
                                            @endphp
                                            @empty
                                            @php
                                                $color = 'bg-blue-600'	;
                                                $texto = 'Información';
                                            @endphp
                                            <div class="carousel-caption block absolute inset-0 text-center" style="
                                                                            display: flex;
                                                                            align-items: center;
                                                                            justify-content: center;"           >
                                                <div class="flex justify-center">
                                                    <div class="block rounded-lg shadow-lg bg-white max-w-sm text-center">
                                                      <div class="py-3 px-6 rounded-lg  border-b border-gray-300 font-extrabold {{ $color }}">
                                                        {{ $texto }}
                                                      </div>
                                                      <div class="p-6">
                                                        <h5 class="text-gray-900 text-xl font-medium mb-2"> {{ 'No hay anuncios' }}</h5>
                                                        {{-- <button type="button" class=" inline-block px-6 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out">Button</button> --}}
                                                      </div>
                                                      {{-- <div class="py-3 px-6 border-t border-gray-300 text-gray-600">
                                                        2 days ago
                                                      </div> --}}
                                                    </div>
                                                  </div>
                                            </div>
                                            @endforelse
                                          
                                        </div>
                                        <button
                                          class="carousel-control-prev absolute top-0 bottom-0 flex items-center justify-center p-0 text-center border-0 hover:outline-none hover:no-underline focus:outline-none focus:no-underline left-0"
                                          type="button"
                                          data-bs-target="#carouselExampleIndicators"
                                          data-bs-slide="prev"
                                        >
                                          <span class="carousel-control-prev-icon inline-block bg-no-repeat" aria-hidden="true"></span>
                                          <span class="visually-hidden">Previous</span>
                                        </button>
                                        <button
                                          class="carousel-control-next absolute top-0 bottom-0 flex items-center justify-center p-0 text-center border-0 hover:outline-none hover:no-underline focus:outline-none focus:no-underline right-0"
                                          type="button"
                                          data-bs-target="#carouselExampleIndicators"
                                          data-bs-slide="next"
                                        >
                                          <span class="carousel-control-next-icon inline-block bg-no-repeat" aria-hidden="true"></span>
                                          <span class="visually-hidden">Next</span>
                                        </button>
                                      </div>
                                </div>
                                <div class="container py-6 shadow overflow-hidden border-b border-gray-200 sm:rounded-lg mb-6">
                                    <table class="min-w-full divide-y divide-gray-200 mx-4">
                                        <tbody class="bg-white divide-y divide-gray-200">
                                            <tr>
                                                <td>
                                                    <p class="col-span-2 text-left text-md sm:text-2xl font-bold sm:ml-6">Tareas cumplidas:</p>
                                                    <p>
                                                </td>
                                                <td>
                                                    <span
                                                        class="p-2 inline-flex text-xl leading-5 text-sm sm:text-xl font-semibold rounded-full bg-green-100 text-green-800">
                                                        {{ $inscripcione->inscripcioneTareas->where('realizado', true)->count().'/'.$inscripcione->programa->tareas->count() }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <a href="{{ route('st.tareas.mislecturas', $inscripcione->programa) }}" class="bg-yellow-pfj sm:p-2 sm:text-md rounded-lg text-white p-1 text-sm">
                                                        <i class="fas fa-check-square"></i> Marcar
                                                    </a>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>

                                </div>
{{-- 
                                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                                    <table class="min-w-full divide-y divide-gray-200">
                                        <thead class="bg-gray-50">
                                            <tr>
                                                <th scope="col"
                                                    class="px-6 py-3 text-left text-lg font-medium text-gray-500 uppercase tracking-wider">
                                                    Próximas capacitaciones
                                                </th>
                                                <th>
                                                    Fecha
                                                </th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y divide-gray-200">
                                            @forelse ($inscripcione->programa->capacitaciones as $capacitacione)
                                                <tr>
                                                    <td class="px-6 py-4 ">
                                                        <div class="flex items-center">
                                                            <div class="ml-4">
                                                                <div class="text-2xl font-medium text-gray-900">
                                                                    <b>{{ $capacitacione->tema }}</b>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-center">
                                                        <span
                                                            class="px-2 inline-flex text-md leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                                            {{ date('d/m/Y', strtotime($capacitacione->fechacapacitacion)) }}
                                                        </span>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <div class="text-sm">
                                                            <div class="flex items-center justify-center">
                                                                <div
                                                                    class="rounded-md bg-yellow-400 text-white font-semibold py-2 px-4">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td class="px-6 py-4 text-gray-300" colspan="100%">
                                                        No hay una próxima reunión
                                                    </td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div> --}}
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
    <style>
        .carousel-control-prev-icon, .carousel-control-next-icon {
            background-color: #fe9321;
            border-radius: 50%;
        }
        .carousel-control-prev-icon{
            background-position-x: -2px!important
        }
        .carousel-control-next-icon{
            background-position-x: 2px !important
        }
    </style>
    <script src="{{ config('app.url') }}/tw-elements/dist/js/index.min.js"></script>
</x-app-layout>
