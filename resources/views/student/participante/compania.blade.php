<x-app-layout programa_id="{{ $companerismo->grupo->programa->id }}">

    <x-slot name="header">
        <h2 class="font-semibold text-3xl leading-tight text-white">
            Mi compañia {{ $companerismo->numero }}
            {{-- {{var_dump($companerismo)}} --}}
        </h2>
    </x-slot>
    @if ($companerismo->grupo->programa->mostrarGrupos == 1)
    
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="col-span-4 bg-white text-center border-2 rounded-lg p-4 flex  shadow-md">
                @foreach ($companerismo->inscripcioneCompanerismos as $inscripcioneCompanerismo)
                    <div class="flex flex-col w-1/2 rounded-lg space-y-4">
                        <p class="text-gray-500 text-sm">{{ $companerismo->role->name }}</p>
                        <div class="flex justify-center">
                            @if ($inscripcioneCompanerismo->inscripcione->personale->user)
                                <img class="rounded-full border-gray-100 shadow-sm w-24 h-24 object-cover"
                                    src="{{ $inscripcioneCompanerismo->inscripcione->personale->user->adminlte_image() }}"
                                    alt="user image">
                            @else
                                <img id="imgperfil" class="rounded-circle" width="50" height="50"
                                    src="https://picsum.photos/300/300" alt="">
                            @endif


                        </div>
                        <h1 class="text-yellow-600 font-semibold px-1">
                            @php
                                $contacto = $inscripcioneCompanerismo->inscripcione->personale->contacto;
                            @endphp
                            {{ $contacto->nombres . ' ' . $contacto->apellidos }}
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
        </div>
    </div>
    <div class="py-2">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 overflow-hidden shadow-xl sm:rounded-lg text-center">

                <h2 class="text-2xl font-medium  ">Mis Participantes</h2>
            </div>
        </div>
    </div>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th>#</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                Nombre
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                Apellido
                            </th>
                            <th>
                                Estaca
                            </th>
                            <th>
                                Barrio
                            </th>
                            <th>
                                Edad
                            </th>
                            <!--th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                          Unidades completadas
                        </th-->
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($companerismo->participanteCompanias as $participanteCompania)
                            @php
                                $participante = $participanteCompania->participante;
                            @endphp
                            <tr>
                                <td class="px-2 text-center">
                                    {{ $loop->index + 1 }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ $participante->nombres }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ $participante->apellidos }}
                                </td>
                                <td>
                                    {{ $participante->barrio->estaca->nombre }}
                                </td>
                                <td>
                                    {{ $participante->barrio->nombre }}
                                </td>
                                <td>
                                    {{ $participante->age }}
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span
                                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                        {{-- {{ $inscripcione->programa->count() }} --}}
                                    </span>
                                </td>
                                <td width=" 10px" class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    {{-- <a href="{{ route('st.programas.show', $inscripcione->programa) }}"
                                        class="text-indigo-600 text-3xl hover:text-indigo-900"><i
                                            class="fas fa-chevron-circle-right"></i></a> --}}
                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @else
    <div class="py-2">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 overflow-hidden shadow-xl sm:rounded-lg text-center">

                <h2 class="text-2xl font-medium  ">Espera un poco más...</h2>
            </div>
        </div>
    </div>
    @endif

    <script src="{{ config('app.url') }}/tw-elements/dist/js/index.min.js"></script>
</x-app-layout>
