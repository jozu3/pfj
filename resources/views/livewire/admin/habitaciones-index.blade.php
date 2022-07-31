<div>
    <div class="card">
        <div class="card-header">
            <div class="form-row align-items-center">
                <div class="col-md-10 my-1">
                    <input wire:model="search" class="form-control" placeholder="Ingrese la habitación que desea buscar">
                </div>
                <div class="col-md-1 my-1">
                    <div style="text-align:right; font-weight:bold">Mostrar:</div>
                </div>
                <div class="col-md-1 my-1">
                    <label class="mr-sm-2 sr-only" for="inlineFormCustomSelect">Preference</label>
                    <select class="custom-select mr-sm-2" wire:model="cant" id="inlineFormCustomSelect">
                        <option value="15">15</option>
                        <option value="30">30</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                </div>
            </div>
           
            @if (session()->has('message'))
                <div class="text-danger">
                    {{ session('message') }}
                </div>
            @endif
            <!--div class="form-row align-items-center">
                <div class="col-auto my-1">
                  <div class="custom-control custom-checkbox mr-sm-2">
                    <input type="checkbox" class="custom-control-input" id="customControlAutosizing">
                    <label class="custom-control-label" for="customControlAutosizing">Remember my preference</label>
                  </div>
                </div>
              </div-->
        </div>
        @if ($habitaciones->count())
            <div class="card-body" style="overflow-x: auto">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Local</th>
                            <th>Edificio - Piso</th>
                            <th>Número o nombre</th>
                            <th>Cupos</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($habitaciones as $habitacione)
                            <tr>
                                <td>{{$habitacione->piso->edificio->locale->nombre}}</td>
                                <td>{{ $habitacione->piso->edificio->nombre . ' - ' .$habitacione->piso->num }}</td>
                                <td>
                                    {{ $habitacione->numero }}
                                </td>
                                <td>
                                    {{ $habitacione->cupos }}
                                </td>
                                <td width="10px">
                                    <a href="{{ route('admin.habitaciones.edit', $habitacione) }}"
                                        class="btn btn-primary">Editar</a>
                                </td>
                                @can('admin.habitaciones.destroy')
                                    <td width="10px">
                                        <form method="POST" class=""
                                            action="{{ route('admin.habitaciones.destroy', $habitacione) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger ">Eliminar</button>
                                        </form>
                                    </td>
                                @endcan
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                {{ $habitaciones->links() }}
            </div>
        @else
            <div class="card-body">
                <b>No hay registros</b>
            </div>
        @endif
    </div>
</div>
