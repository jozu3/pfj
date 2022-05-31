<div class="p-6 sm:px-20 bg-white border-b border-gray-200">
    <!--div>
        <x-jet-application-logo class="block h-12 w-auto" />
    </div-->
    <div class="mt-4 text-2xl">
       <b>Mis sesiones</b>
    </div>
</div>

<div class="bg-gray-200 bg-opacity-25 grid grid-cols-1 md:grid-cols-1">
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
                        Sesion
                      </th>
                      <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        
                      </th>
                      <!--th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Unidades completadas
                      </th-->                      
                    </tr>
                  </thead>
                  <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($inscripciones as $inscripcione)
                        <tr>
                          <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                              <div class="ml-4">
                                <div class="text-2xl font-medium text-gray-900">
                                  {{ $inscripcione->programa->nombre }}
                                </div>
                                <div class="text-sm text-gray-500">
                                  {{ date('d/m/Y', strtotime($inscripcione->programa->fecha_inicio)) }}                                
                                </div>
                              </div>
                            </div>
                          </td>
                          
                          <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                              {{-- {{ $inscripcione->programa->count() }} --}}
                            </span>
                          </td>
                          <td width=" 10px" class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <a href="{{ route('st.programas.show', $inscripcione->programa) }}" class="text-indigo-600 text-3xl hover:text-indigo-900"><i class="fas fa-chevron-circle-right"></i></a>
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
@can('admin.programas.viewList')

<div class="p-6 sm:px-20 bg-white border-b border-gray-200">
  <!--div>
      <x-jet-application-logo class="block h-12 w-auto" />
  </div-->
  <div class="mt-4 text-2xl">
     <b>Todas las sesiones</b>
  </div>
</div>

<div class="bg-gray-200 bg-opacity-25 grid grid-cols-1 md:grid-cols-1">
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
                      Sesion
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                      
                    </th>
                    <!--th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                      Unidades completadas
                    </th-->                      
                  </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                  @foreach (\App\Models\Programa::all() as $programa)
                      <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                          <div class="flex items-center">
                            <div class="ml-4">
                              <div class="text-2xl font-medium text-gray-900">
                                {{ $programa->nombre }}
                              </div>
                              <div class="text-sm text-gray-500">
                                {{ date('d/m/Y', strtotime($programa->fecha_inicio)) }}                                
                              </div>
                            </div>
                          </div>
                        </td>
                        
                        <td class="px-6 py-4 whitespace-nowrap">
                          <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                            {{-- {{ $programa->count() }} --}}
                          </span>
                        </td>
                        <td width=" 10px" class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                          <a href="{{ route('st.programas.show', $programa) }}" class="text-indigo-600 text-3xl hover:text-indigo-900"><i class="fas fa-chevron-circle-right"></i></a>
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
@endcan