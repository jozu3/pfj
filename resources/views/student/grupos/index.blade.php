<x-app-layout>
    <x-slot name="header">
        @include('student.partials.menu-pagos')
    </x-slot>
    @foreach ($inscripciones as $inscripcione)
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="mt-4 text-2xl">
                       <b>{{ $inscripcione->grupo->pfj->nombre.' - '.date('d/m/Y', strtotime($inscripcione->grupo->fecha)) }}</b>
                    </div>
                </div>
                <div class="p-6">
                <div class="flex flex-col">
                  <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                      <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-200">
                          <thead class="bg-gray-50">
                            <tr>
                              <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Código
                              </th>
                              <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Concepto
                              </th>
                              <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Fecha de vencimiento
                              </th>
                              <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Estado
                              </th>
                              <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Monto pagado
                              </th>
                              <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Monto final
                              </th>
                              <th scope="col" class="relative px-6 py-3">
                                <span class="sr-only">Promedio</span>
                              </th>
                            </tr>
                          </thead>
                          <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($inscripcione->obligaciones as $obligacione)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">
                                            {{$obligacione->id }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">
                                            {{$obligacione->concepto }}
                                        </div>
                                    </td>
                                  <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                      <div class="ml-4">
                                        <div class="text-2xl font-medium text-gray-900">
                                        </div>
                                        <div class="text-sm text-gray-500">
                                          {{ date('d/m/Y', strtotime($obligacione->fechalimite)) }}
                                        </div>
                                      </div>
                                    </div>
                                  </td>
                                  <td class="px-6 py-4 whitespace-nowrap">
                                    @switch ($obligacione->estado)
                                        @case(0)
                                            Exonerado
                                            @break
                                        @case(1)
                                            Por pagar
                                            @break
                                        @case(2)
                                            Parcial
                                            @break
                                        @case(3)
                                            Pagado
                                            @if ($obligacione->fechapagadototal > $obligacione->fechalimite)
                                                <small class="text-red-500">({{ date('d/m/Y', strtotime($obligacione->fechapagadototal)) }})</small>
                                            @endif
                                            @break
                                    @endswitch
                                  </td>
                                  <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">
                                        {{ $obligacione->montopagado }}
                                    </div>
                                  </td>
                                  <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">
                                        {{ $obligacione->montofinal }}
                                    </div>
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
    @endforeach

</x-app-layout>
