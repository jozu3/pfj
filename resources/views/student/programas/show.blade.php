<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-3xl text-gray-800 leading-tight">
            {{ $inscripcione->programa->nombre }}
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
                                    <div class="text-xl text-center text-gray-900 border-b-2 font-bold">
                                        <p class="">Matrimonio de sesión</p> <!-- border-b-4 -->
                                    </div>
                                    <div class="flex justify-center mt-4">
                                        <img src="https://files.mormonsud.org/wp-content/uploads/2018/12/matrimonio1.jpg"
                                            alt="" class="object-top" width="300px">
                                    </div>
                                    <div class="text-center">
                                        @forelse ($inscripcione->programa->matrimonioDirectores() as $lider)
                                            <p><b>{{ $lider->personale->user->name }}</b></p>
                                        @empty
                                            <p>No asignados</p>
                                        @endforelse
                                    </div>

                                </div>

                                <div class="container py-6">
                                    <div class="text-3xl text-center text-gray-900 border-b-2 font-bold">
                                        <p class="">Anuncios</p> <!-- border-b-4 -->
                                    </div>
                                    <div class="flex items-center justify-center">
                                        <div class="grid max-w-2xl flex justify-center ">
                                            <div class="grid col-span-6 relative">

                                                <div
                                                    class="group shadow-lg hover:shadow-2xl duration-200 delay-75 w-full border-2 border-yellow-300 rounded-sm my-4">
                                                    <div class="bg-yellow-300 text-xl font-bold text-white text-center">
                                                        <p class="px-6 py-4">Mensaje</p>
                                                    </div>
                                                    <div class="bg-white py-6 pr-6 pl-9">
                                                        <!-- Description -->
                                                        <p
                                                            class="text-sm font-semibold text-gray-500 group-hover:text-gray-700 mt-2 leading-6  ">
                                                            Lorem ipsum dolor sit, amet consectetur
                                                            adipisicing elit. Quae officiis animi nisi
                                                            in
                                                            cupiditate eius, dolores natus atque,
                                                            distinctio, ratione eveniet! Ea
                                                            exercitationem
                                                            enim non repellendus itaque iusto officia
                                                            porro?
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div class="container py-6">
                                    <div class=" grid grid-cols-3 border-b-2 font-bold">
                                        <p class="col-span-2 text-lef text-2xl text-gray-400">Metas de lectura</p>
                                        <!-- border-b-4 -->
                                        <p class="col-span-1 text-right"><a
                                                href="{{ route('st.tareas.mislecturas', $inscripcione->programa) }}"><span class="border-l-2 pl-2">
                                                    Mis lecturas</span></a></p>                                                    
                                    </div>
                                    <div class="overflow-hidden border-b border-gray-200 sm:rounded-lg">
                                        <table class="min-w-full divide-y divide-gray-200 text-center">
                                            <tbody class="bg-white divide-y divide-gray-200">
                                                @forelse ($inscripcione->programa->tareas->sortByDesc('fecha')->take(3) as $tarea)
                                                    <tr>
                                                        <td class="w-1/4 px-6 py-4 font-bold text-gray-400">{{$tarea->fecha}}</td>
                                                        <td class="px-6 py-4 font-bold whitespace-normal">{{$tarea->descripcion}}
                                                        </td>                                                        
                                                    </tr>                                                
                                                @empty
                                                    <p>No asignados</p>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>

                                </div>

                                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                                    <table class="min-w-full divide-y divide-gray-200">
                                        <thead class="bg-gray-50">
                                            <tr>
                                                <th scope="col"
                                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Nombre
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y divide-gray-200">
                                            @forelse ($inscripcione->programa->lideres() as $lider)
                                                <tr>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <div class="flex items-center">
                                                            <div class="ml-4">
                                                                <div class="text-2xl font-medium text-gray-900">
                                                                    <b>{{ $lider->personale->user->name }}</b>
                                                                </div>
                                                                <div class="text-sm text-gray-500">
                                                                    {{-- {{ date('d/m/Y', strtotime($personale_unidade->unidad->fechainicio)) }} --}}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <span
                                                            class="px-2 inline-flex text-md leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                            {{ $lider->role->name }}
                                                        </span>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <div class="text-sm">
                                                            <div class="flex items-center justify-center">
                                                                <div
                                                                    class="rounded-md bg-yellow-400 text-white font-semibold py-2 px-4">
                                                                    {{-- {{ $personale_unidade->nota }} --}}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                {{-- <tr>
                                <td class="px-6 py-4" colspan="100%">
                                  <b>Comentario del docente:</b> 
                                  @if ($personale_unidade->comentario == '')
                                    <i class="text-gray-300">No hay comentario del docente.</i>
                                  @else
                                  {{ $personale_unidade->comentario }}
                                  @endif
                                </td>
                              </tr>                                  
                              <tr>
                                <td class="px-6 whitespace-nowrap">
                                      <div class="ml-12">
                                        <div class="text-xl text-gray-900">
                                          Notas
                                      </div>
                                </td>
                                <td colspan="2" class="px-6 py-4 whitespace-nowrap">
                                  @foreach ($personale_unidade->personaleNotasorden('asc') as $personale_nota)
                                  <div class="">
                                      <div class="flex my-2">
                                        <div class="flex-1 flex items-center">
                                          {{ $personale_nota->descripcionnota }}
                                          @if ($personale_nota->tiponota == 1)
                                            (Nota recuperatoria)
                                          @endif
                                        </div>
                                        @if ($personale_nota->valorpersonale_nota != '')
                                        <div class="flex-1 flex items-center justify-center ">
                                          <div class="rounded-md bg-yellow-600 text-white font-semibold py-2 px-4">
                                            {{ $personale_nota->valorpersonale_nota }}
                                          </div>
                                        </div>
                                        @endif
                                      </div>
                                  </div>
                                  @endforeach
                                </td>
                              </tr> --}}
                                            @empty
                                                <tr>
                                                    <td class="px-6 py-4 text-gray-300" colspan="100%">
                                                        Aun no empiezan las clases
                                                    </td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
</x-app-layout>
