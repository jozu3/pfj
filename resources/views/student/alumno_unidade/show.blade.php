<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-3xl text-gray-800 leading-tight">
            {{ $inscripcione->grupo->pfj->nombre }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6">
                <!-- This example requires Tailwind CSS v2.0+ -->
                <div class="flex flex-col">
                  <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                      <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-200">
                          <thead class="bg-gray-50">
                            <tr>
                              <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                
                              </th>
                              <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Asistencias
                              </th>
                              <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Nota
                              </th>
                              <th scope="col" class="relative px-6 py-3">
                                <span class="sr-only">Promedio</span>
                              </th>
                            </tr>
                          </thead>
                          <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($personale_unidades as $personale_unidade)
                                <tr>
                                  <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                      
                                      <div class="ml-4">
                                        <div class="text-2xl font-medium text-gray-900">
                                          {{ $personale_unidade->unidad->descripcion }}
                                        </div>
                                        <div class="text-sm text-gray-500">
                                          {{ date('d/m/Y', strtotime($personale_unidade->unidad->fechainicio)) }}                                
                                        </div>
                                      </div>
                                    </div>
                                  </td>
                                  <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-md leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                        {{ $inscripcione->asistenciasUnidad($personale_unidade->unidad)->count() }} - {{ $personale_unidade->unidad->clases->count() }}
                                    </span>
                                  </td>
                                  <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">
                                        {{ $personale_unidade->nota }}
                                    </div>
                                  </td>
                                  <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                    </span>
                                  </td>
                                  <td width="10px" class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <a href="{{ route('st.personale_unidade.show', $personale_unidade) }}" class="text-indigo-600 text-3xl hover:text-indigo-900"><i class="fas fa-chevron-circle-right"></i></a>
                                  </td>
                                </tr>
                            @endforeach
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