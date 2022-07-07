<div>
    <div class="w-100 text-center">
        <div class="grid grid-cols-4 gap-4">
            <div class="col-start-2 col-span-2">
                <p class="text-white font-semibold mb-2">Ingresa el documento de identidad</p>
                <input type="text" class="form-control w-full rounded-lg text-xl font-semibold" wire:model="search">
                <button type="button"
                    class="bg-blue-500 hover:bg-blue-400 text-white text-base leading-6 font-semibold mt-2 py-1 px-10 border border-transparent rounded-full"
                    wire:click="$toggle('open')">BUSCAR</button>
            </div>

        </div>

    </div>
    <x-jet-dialog-modal wire:model="open" class="bg-yellow-500">
        <x-slot name="title">
            {{-- Participante --}}
        </x-slot>
        <x-slot name="content">
            <table class="min-w-full divide-y divide-gray-200">
                {{-- <thead class="bg-gray-50">
                    <tr>
                        <th scope="col"
                            class="px-6 py-3 text-left text-lg font-medium text-gray-500 uppercase tracking-wider">
                            Participantes
                        </th>
                    </tr>
                </thead> --}}
                <tbody class="bg-yellow-200 bg-yellow-200">
                    @forelse ($participantes as $participante)
                        <tr>
                            <td class="px-4 py-4" rowspan="2" colspan="2">
                                <div class="flex items-center">
                                    <div class="ml-4">
                                        <div class="font-medium text-gray-900 text-center">
                                            <b class="text-2xl">
                                                @if ($participante->genero)
                                                    <i class="fas fa-male text-indigo-500"></i>
                                                @else
                                                    <i class="fas fa-female text-pink-500"></i>
                                                @endif
                                                {{ '' . $participante->nombres . ' ' . $participante->apellidos . '' }}
                                                ({{ $participante->age }})
                                            </b><br>
                                            <span class="text-sm font-bold bg-yellow-300 px-1">Documento:
                                                {{ $participante->documento }}</span><br>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td><i
                                    class="fas fa-birthday-cake text-yellow-300"></i>{{ ' ' . date('d M y', strtotime($participante->fecnac)) }}
                            </td>
                            {{-- <td class="px-6 py-4 whitespace-nowrap text-center">
                                <span
                                    class="px-2 inline-flex text-md leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">

                                </span>
                            </td> --}}
                        </tr>
                        <tr>
                            <td><i class="fas fa-mobile-alt text-pink-800"></i>{{ ' ' . $participante->telefono }}</td>
                        </tr>
                        <tr>
                            <td colspan="3" class="font-bold pl-2">Información del PFJ</td>
                        </tr>
                        <tr>
                            <td class="pl-2"><i class="fas fa-tshirt text-yellow-500"></i>{{ ' ' . $participante->talla }}</td>
                            <td><i class="fas fa-users text-yellow-500"></i> Compañía</td>
                            <td><i class="fas fa-bed text-yellow-500"></i> Habitación</td>
                        </tr>
                        <tr>
                            <td colspan="3" class="font-bold pl-2">Información de contacto</td>
                        </tr>
                        <tr>
                            <td class="pl-2"><i class="fas fa-place-of-worship text-green-600"></i>{{ ' ' . $participante->barrio->estaca->nombre . ' / ' . $participante->barrio->nombre }}
                            </td>
                            <td colspan="2"><i
                                    class="fas fa-user-tie text-green-600"></i>{{ ' ' . $participante->obispo }}</td>
                        </tr>
                        <tr>
                            <td class="pl-2"><i class="fas fa-phone-square-alt text-green-600"></i>{{ ' ' . $participante->contacto1 }}
                            </td>
                            <td colspan="2"><i
                                    class="fas fa-phone-square-alt text-green-600"></i>{{ ' ' . $participante->contacto2 }}
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3" class="font-bold pl-2">Información a considerar</td>
                        </tr>
                        <tr>
                            <td colspan="3" class="pl-2"><i
                                    class="fas fa-user-md text-red-500"></i>{{ ' ' . $participante->informacion_medica }}
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3" class="pl-2"><i
                                    class="fas fa-utensils text-red-500"></i>{{ ' ' . $participante->informacion_alimentaria }}
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3">

                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td class="px-6 py-4 text-gray-300" colspan="100%">
                                No hay participantes
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </x-slot>
        <x-slot name="footer">
            <div class="text-center mt-1">
                <button class="btn btn-sm btn-info"><i class="fas fa-print"></i> Imprimir</button>
                <button class="btn btn-sm btn-info"><i class="fas fa-edit"></i> Editar</button>
            </div>
        </x-slot>
    </x-jet-dialog-modal>


    {{-- <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg mb-2">

        
    </div> --}}
</div>
