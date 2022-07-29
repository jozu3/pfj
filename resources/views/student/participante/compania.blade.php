<x-app-layout programa_id="{{ $companerismo->grupo->programa->id }}">

    <x-slot name="header">
        <h2 class="font-semibold text-3xl leading-tight text-white">
            Mi compañia
            {{var_dump($companerismo)}}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Nombre
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">

                            </th>
                            <!--th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
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
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ $participante->nombres }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                {{ $participante->apellidos }}
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

    <script src="{{ config('app.url') }}/tw-elements/dist/js/index.min.js"></script>
</x-app-layout>
