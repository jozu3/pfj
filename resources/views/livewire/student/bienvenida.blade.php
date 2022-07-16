<div>
    <div class="w-100 text-center">
        <div class="grid grid-cols-4 gap-4">
            @if ($formsearch)
                <div class="col-start-2 col-span-2">
                    <button type="button" wire:click="$toggle('formsearch')">
                        <i class="fas fa-lg fa-arrow-circle-left"></i>
                    </button><br><br>
                    <p class="text-white font-semibold mb-2">Ingresa el documento de identidad</p>
                    <input type="text" class="form-control w-full rounded-lg text-xl font-semibold" wire:model="search">
                    <button type="button"
                        class="bg-blue-500 hover:bg-blue-400 text-white text-base leading-6 font-semibold mt-2 py-1 px-10 border border-transparent rounded-full"
                        wire:click="$toggle('open')">BUSCAR</button>
                </div>
            @else
                <div class="col-start-2 col-span-1">
                    <a href="{{ route('st.participantes.create', 'programa_id='.$programa->id) }}">
                        <i class="fas fa-user-edit"></i>
                        <p>Crear inscripción de participante</p>
                    </a>
                </div>
                <div class="col-span-1">
                    <button type="button" wire:click="$toggle('formsearch')">
                        <i class="fas fa-search"></i>
                        <p>Buscar inscripción de participante</p>
                    </button>
                </div>
            @endif



        </div>

    </div>
    <x-jet-dialog-modal wire:model="open" class="bg-yellow-500">
        <x-slot name="title">
            {{-- Participante --}}
        </x-slot>
        <x-slot name="content">
            {{-- <table class="min-w-full divide-y divide-gray-200"> --}}
            {{-- <thead class="bg-gray-50">
                    <tr>
                        <th scope="col"
                            class="px-6 py-3 text-left text-lg font-medium text-gray-500 uppercase tracking-wider">
                            Participantes
                        </th>
                    </tr>
                </thead> --}}
            <div class="min-w-full bg-yellow-200 bg-yellow-200 px-8 py-6">
                @forelse ($participantes as $participante)
                    {{-- <tr> --}}
                    <div class="py-4 text-center">
                        <div class="text-gray-900 ">
                            <div class="font-bold text-2xl">
                                @if ($participante->genero)
                                    <i class="fas fa-male text-indigo-500"></i>
                                @else
                                    <i class="fas fa-female text-pink-500"></i>
                                @endif

                                {{ '' . $participante->nombres . ' ' . $participante->apellidos . '' }}
                                ({{ $participante->age }})
                            </div>

                            <span class="text-sm font-bold bg-yellow-300 px-1">Documento:
                                {{ $participante->documento }}</span><br>
                        </div>
                        <div class="grid grid-cols-2 gap-4 pt-3">
                            <div class="text-right">
                                <i class="fas fa-birthday-cake text-yellow-300"></i>
                                {{ ' ' . date('d M y', strtotime($participante->fecnac)) }}
                            </div>
                            <div class="text-left">
                                <i class="fas fa-mobile-alt text-pink-800"></i>
                                {{ ' ' . $participante->telefono }}
                            </div>
                        </div>
                    </div>

                    {{-- <td class="px-6 py-4 whitespace-nowrap text-center">
                                <span
                                    class="px-2 inline-flex text-md leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">

                                </span>
                            </td> --}}


                    <div class="grid grid-cols-3 gap-1 py-3">
                        <div class="font-bold col-span-3">Información del PFJ</div>
                        <div class="">
                            <i class="fas fa-tshirt text-yellow-500"></i>
                            {{ ' ' . $participante->talla }}
                        </div>
                        <div>
                            <i class="fas fa-users text-yellow-500"></i> Compañía
                        </div>
                        <div>
                            <i class="fas fa-bed text-yellow-500"></i> Habitación
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-1 py-3">
                        <div class="font-bold col-span-2">Información de contacto</div>
                        <div class="">
                            <i class="fas fa-place-of-worship text-green-600"></i>
                            {{ ' ' . $participante->barrio->estaca->nombre . ' / ' . $participante->barrio->nombre }}
                        </div>
                        <div>
                            <i class="fas fa-user-tie text-green-600"></i>
                            {{ ' ' . $participante->obispo }}
                        </div>
                        <div class="">
                            <i class="fas fa-phone-square-alt text-green-600"></i>
                            {{ ' ' . $participante->contacto1 }}
                        </div>
                        <div>
                            <i class="fas fa-phone-square-alt text-green-600"></i>
                            {{ ' ' . $participante->contacto2 }}
                        </div>
                    </div>
                    <div class="grid grid-cols-1 gap-1 py-3">
                        <div class="font-bold">Información a considerar</div>
                        <div class="">
                            <i class="fas fa-user-md text-red-500"></i>
                            {{ ' ' . $participante->informacion_medica }}
                        </div>
                        <div class="">
                            <i class="fas fa-utensils text-red-500"></i>
                            {{ ' ' . $participante->informacion_alimentaria }}
                        </div>
                    </div>

                    {{-- Esto podría ir en el pie de página --}}
                    <div class="mt-1 grid grid-cols-2 gap-4">
                        <button class="btn btn-sm btn-info text-right"><i class="fas fa-print"></i> Imprimir</button>
                        <a href="{{ route('st.participantes.edit', $participante) }}"
                            class="btn btn-sm btn-info text-left"><i class="fas fa-edit"></i>
                            Editar</button>
                    </div>
                @empty
                    <div class="px-6 py-4 text-gray-300" colspan="100%">
                        No hay participantes
                    </div>
                @endforelse
            </div>
        </x-slot>
        <x-slot name="footer">

        </x-slot>
    </x-jet-dialog-modal>


    {{-- <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg mb-2">

        
    </div> --}}
</div>
