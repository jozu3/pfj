<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-3xl leading-tight text-white">
            @php
                $bienvenido = 'Bienvenido';
            @endphp
            @if (auth()->user()->personale->contacto->genero == 'Hombre')
                @php
                    $bienvenido = 'Bienvenido';
                @endphp
            @else
                @php
                    $bienvenido = 'Bienvenida';
                @endphp
            @endif
            {{ $bienvenido }} a tu familia PFJ! 
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="px-14 py-12">
                    <div class="text-3xl text-gray-900 border-b-2 font-bold mb-8">
                        <p class="text-yellow-500">Familia {{$grupo->numero}}: {{ $grupo->nombre }}</p>
                    </div>

                    <div class="grid grid-cols-4 gap-4">
                        @foreach ($grupo->companerismos->sortBy('role_id ') as $companerismo)
                            @php
                                $colspan = $companerismo->role_id == 5 ? 'md:col-start-2 md:col-span-2' : 'md:col-span-2';
                            @endphp
                            {{-- <div class="col-start-2 col-span-2 bg-gray-100 border-2 rounded-lg shadow-md lg:col-span-2 md:col-span-3">
                                    {{ $companerismo->role_id }}
                                </div> --}}

                            <div
                                class="col-span-4 {{ $colspan }}  bg-gray-100 border-2 rounded-lg p-4 flex  shadow-md">
                                @foreach ($companerismo->inscripcioneCompanerismos as $inscripcioneCompanerismo)
                                    <div class="flex flex-col w-1/2 rounded-lg space-y-4">
                                        <p class="text-gray-500 text-sm">{{ $companerismo->role->name }}</p>
                                        <div class="flex justify-center">
                                            <img class="rounded-full border-gray-100 shadow-sm w-24 h-24"
                                                src="{{ $inscripcioneCompanerismo->inscripcione->personale->user->adminlte_image() }}"
                                                alt="user image">
                                        </div>
                                        <h1 class="text-yellow-600 font-semibold px-1">
                                            {{ $inscripcioneCompanerismo->inscripcione->personale->user->name }}
                                        </h1>
                                        <h2 class="text-gray-500 text-xs"><i class="fas fa-birthday-cake"></i>
                                            {{ date('d/m/Y', strtotime($inscripcioneCompanerismo->inscripcione->personale->contacto->fecnac)) }}
                                        </h2>
                                        <h2 class="text-gray-500 text-xs rounded">
                                            <i class="fas fa-phone-alt"></i>
                                            <a
                                                href="https://api.whatsapp.com/send?phone=51{{ $inscripcioneCompanerismo->inscripcione->personale->contacto->telefono }}">{{ $inscripcioneCompanerismo->inscripcione->personale->contacto->telefono }}</a>
                                        </h2>
                                        <h2 class="text-gray-500 text-xs rounded">
                                            <i class="fas fa-place-of-worship"></i>
                                            {{ $inscripcioneCompanerismo->inscripcione->personale->barrio->nombre }}
                                            /
                                            {{ $inscripcioneCompanerismo->inscripcione->personale->barrio->estaca->nombre }}
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
