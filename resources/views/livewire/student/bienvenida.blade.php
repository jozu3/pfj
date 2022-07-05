<div>
    <div class="w-100 text-center">
        <input type="text" class="form-control" wire:model="search">
        <button type="button" class="form-control">Buscar</button>
    </div>

    <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg mb-2">

        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col"
                        class="px-6 py-3 text-left text-lg font-medium text-gray-500 uppercase tracking-wider">
                        Participantes
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse ($participantes as $participante)
                    <tr>
                        <td class="px-6 py-4 ">
                            <div class="flex items-center">
                                <div class="ml-4">
                                    <div class="text-2xl font-medium text-gray-900">
                                        <b>{{ $participante->nombres . ' ' . $participante->apellidos }}</b>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-center">
                            <span
                                class="px-2 inline-flex text-md leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">

                            </span>
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
    </div>
</div>
