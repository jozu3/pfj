<x-app-layout>
    <x-slot name="header">

    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">              
                <div class="px-14 py-12">
                    <div class="text-3xl text-gray-900 border-b-2 font-bold mb-8">
                        <p class="text-yellow-500 uppercase">GRUPO: {{$grupo->nombre}}</p>
                    </div>
                    <div class="grid grid-cols-6 gap-4 flex items-center justify-center">
                        @foreach ($grupo->companerismos as $companerismo)

                            <div
                                class="bg-gray-100 border-2 rounded-lg col-span-4 p-4 flex justify-center lg:col-span-2 md:col-span-3 shadow-md">
                                @foreach ($companerismo->inscripcioneCompanerismos as $inscripcioneCompanerismo)
                                    <div class="flex flex-col w-1/2 rounded-lg space-y-4">
                                      <p class="text-gray-500 text-sm">{{ $companerismo->role->name}}</p>
                                        <img class="rounded-full border-gray-100 shadow-sm w-24 h-24"
                                            src="{{$inscripcioneCompanerismo->inscripcione->personale->user->adminlte_image()}}" alt="user image">
                                        <h1 class="text-yellow-600 font-semibold px-1">
                                            {{ $inscripcioneCompanerismo->inscripcione->personale->user->name }}</h1>
                                            <h2 class="text-gray-500 text-xs"><i class="fas fa-birthday-cake"></i>
                                              {{$inscripcioneCompanerismo->inscripcione->personale->contacto->fecnac}}
                                            </h2>
                                            <h2 class="text-gray-500 text-xs rounded">
                                              <i class="fas fa-phone-alt"></i> 
                                              {{$inscripcioneCompanerismo->inscripcione->personale->contacto->telefono}}
                                            </h2>                                            
                                        {{-- <button class="px-8 py-1 border-2 border-indigo-600 bg-indigo-600 rounded-full text-gray-50 font-semibold">Follow</button> --}}
                                    </div>
                                @endforeach
                            </div>
                        @endforeach
                    </div>                  
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
