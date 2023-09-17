<div wire:init="loadContactos">
    <div class="card">
        <div class="card-header">
            <div class="form-row">
                <div class="col">
                    <input wire:model="search" class="form-control" placeholder="Ingrese nombre para buscar">
                </div>
                @can('admin.contactos.allcontactos')
                    <div class="col">
                        <select name="" id="" class="form-control" wire:model="estaca_id">
                            <option value="0">-- Todas las estacas --</option>
                            @foreach ($estacas as $stk)
                                <option value="{{ $stk->id }}">{{ $stk->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col">
                        <select name="" id="" class="form-control" wire:model="barrio_id">
                            <option value="0">-- Todos los barrios --</option>
                            @foreach ($barrios as $ward)
                                <option value="{{ $ward->id }}">{{ $ward->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroup-sizing-default">Preinscrito a partir de:</span>
                            </div>
                            <input wire:model="created_at" type="date" class="form-control"
                                aria-describedby="inputGroup-sizing-default">
                        </div>
                    </div>
                @elsecan('admin.contactos.contactos_barrio')
                    <div class="col">
                        <input name="" id="" class="form-control"
                            value="{{ auth()->user()->personale->contacto->barrio->nombre }}" disabled>
                    </div>
                @endcan
                {{-- <div class="col">
                    <a href="{{ route('admin.excel.exportExcelPersonal', [$programa_id, $familia, $estaca, $estado, $rol]) }}"
                        class="btn btn-success float-right mr-3">
                        <i class="far fa-file-excel"></i> Descargar
                    </a>
                </div> --}}
            </div>
            @can('admin.contactos.allcontactos')
                <div class="form-check mt-1 d-inline">
                    <input class="form-check-input" wire:model="nocontactado" type="checkbox" value="true" id="nocontac1">
                    <label class="form-check-label" for="nocontac1">
                        Preinscrito
                    </label>
                </div>
            @endcan
            <div class="form-check mt-1 d-inline">
                <input class="form-check-input" wire:model="contactado" type="checkbox" value="true" id="contact1">
                <label class="form-check-label" for="contact1">
                    Enviado al obispo
                </label>
            </div>

            <div class="form-check mt-1 d-inline">
                <input class="form-check-input" wire:model="probable" type="checkbox" value="true"
                    id="flexCheckDefault1">
                <label class="form-check-label" for="flexCheckDefault1">
                    Aprobado por el obispo
                </label>
            </div>
            {{-- <div class="form-check mt-1 d-inline">
                <input class="form-check-input" wire:model="confirmado" type="checkbox" value="true" id="flexCheckDefault2">
                <label class="form-check-label" for="flexCheckDefault2">
                    Confirmado
                </label>
            </div> --}}
            <div class="form-check mt-1 d-inline">
                <input class="form-check-input" wire:model="inscrito" type="checkbox" value="true"
                    id="flexCheckDefault3">
                <label class="form-check-label" for="flexCheckDefault3">
                    Inscrito
                </label>
            </div>
        </div>
        @if ($contactos->count())
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th style="cursor:pointer">
                                <span wire:click="sortBy('nombres')">Nombre</span>
                                @include('partials._sort-icon', ['field' => 'nombres'])
                                <span wire:click="sortBy('newassign')" class="ml-1">Nuevos</span>
                                @include('partials._sort-icon', ['field' => 'newassign'])
                            </th>
                            <th wire:click="sortBy('apellidos')" style="cursor:pointer">Apellidos
                                @include('partials._sort-icon', ['field' => 'apellidos'])
                            </th>
                            <th wire:click="sortBy('telefono')" style="cursor:pointer">Telefono
                                @include('partials._sort-icon', ['field' => 'telefono'])
                            </th>
                            <th wire:click="sortBy('estaca_id')" style="cursor:pointer">Estaca
                                @include('partials._sort-icon', ['field' => 'estaca_id'])
                            </th>
                            <th wire:click="sortBy('barrio_id')" style="cursor:pointer">Barrio
                                @include('partials._sort-icon', ['field' => 'barrio_id'])
                            </th>
                            <th wire:click="" style="">Edad
                            </th>
                            <th wire:click="" style="">Recomendación para el templo
                            </th>
                            <th wire:click="sortBy('estado')" style="cursor:pointer">Estado
                                @include('partials._sort-icon', ['field' => 'estado'])
                            </th>
                            <th wire:click="" style="">Observaciones
                            </th>
                            {{-- <th wire:click="" style="">Total de comentarios
                        </th> --}}
                            @if (Auth::user()->can('admin.contactos.edit') || Auth::user()->can('admin.contactos.destroy'))
                                <th class="text-center">Acciones</th>
                            @endif
                            @can('admin.contactos.aprobacionobispo')
                                <th class="text-center">Aprobación del obispo</th>
                            @endcan
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $estados = [
                                '1' => 'Preinscrito',
                                '2' => 'Enviado al obispo',
                                '3' => 'Aprobado por el obispo',
                                '4' => 'Confirmado',
                                '5' => 'Inscrito',
                            ];
                        @endphp
                        @foreach ($contactos as $contacto)
                            <tr>
                                <td>{{ $contacto->id }}</td>
                                <td>{{ $contacto->nombres }}
                                    @if ($contacto->newassign == 1)
                                        <span class="badge badge-success right">N</span>
                                    @endif
                                </td>
                                <td>{{ $contacto->apellidos }}</td>
                                <td>
                                    <span>
                                        <a href="tel:{{ $contacto->telefono }}" alt="Llamar por teléfono"
                                            data-toggle="tooltip" data-placement="top"
                                            title="Llamar por teléfono">{{ $contacto->telefono }}</a>
                                        <a href="https://api.whatsapp.com/send?phone=51{{ $contacto->telefono }}"
                                            class="text-success" target="_blank" alt="Enviar Whatsapp"
                                            data-toggle="tooltip" data-placement="top" title="Enviar Whatsapp"><i
                                                class="fab fa-whatsapp"></i></a>
                                    </span>
                                </td>
                                <td>
                                    {{-- @if ($contacto->personale != null)
                                        {{ $contacto->personale->barrio->estaca->nombre }}
                                    @else
                                        @if ($contacto->barrio_id == 1)
                                            {{ $contacto->otra_estaca }}
                                        @else
                                        @endif
                                        @endif --}}
                                    {{ $contacto->barrio->estaca->nombre }}
                                </td>
                                <td>
                                    {{-- @if ($contacto->personale != null)
                                        {{ $contacto->personale->barrio->nombre }}
                                    @else
                                        @if ($contacto->barrio_id == 1)
                                            {{ $contacto->otro_barrio }}
                                        @else
                                        @endif
                                    @endif --}}
                                    {{ $contacto->barrio->nombre }}
                                </td>
                                <td>
                                    @php
                                        $fecha_nacimiento = new DateTime($contacto->fecnac);
                                        $hoy = new DateTime();
                                        echo (string) $hoy->diff($fecha_nacimiento)->format('%y');
                                    @endphp
                                </td>
                                <td>
                                    @if (!empty($contacto->mes_recomendacion) || !empty($contacto->anio_recomendacion))
                                        {{ $meses[$contacto->mes_recomendacion] . ' - ' . $contacto->anio_recomendacion }}
                                    @else
                                        --
                                    @endif
                                </td>
                                <td>
                                    {{ $estados[$contacto->estado] }}
                                </td>
                                {{-- <td>
                                    @php
                                    //cantidad de veces contactadas por mi
                                        $vcp_mi = 0
                                    @endphp 
                                    @foreach ($contacto->seguimientos as $segui)
                                        @php
                                            if ($segui->personal->id == $contacto->personal->id){
                                                $vcp_mi++;
                                            }
                                        @endphp
                                    @endforeach
                                    @if ($vcp_mi == 0)
                                        <b class="alert-warning">Ningún comentario</b>
                                    @else
                                        <b class="">{{ $vcp_mi }}</b>
                                    @endif
                                </td>    --}}
                                <td>
                                    {{ count($contacto->seguimientos) }}
                                </td>
                                @if (Auth::user()->can('admin.contactos.edit') || Auth::user()->can('admin.contactos.destroy'))
                                    <td width="">
                                        <div class="d-flex" style="align-items: center; ">
                                            @can('admin.contactos.edit')
                                                <span class="mx-2">
                                                    <a href="{{ route('admin.contactos.show', $contacto) }}"
                                                        class="btn btn-sm btn-success">
                                                        <i class="fas fa-file-signature"></i> Ver / Editar</a>
                                                </span>
                                            @endcan
                                            @if ($contacto->estado < 5)
                                                @can('admin.contactos.destroy')
                                                    <span class="mx-2">
                                                        <form method="POST" class="eliminar-contactos"
                                                            action="{{ route('admin.contactos.destroy', $contacto) }}">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                class="btn btn-sm btn-danger ">Eliminar</button>
                                                        </form>
                                                    </span>
                                                @endcan
                                            @endif
                                        </div>
                                    </td>
                                @endif

                                <td class="text-center">
                                    @if (in_array($contacto->estado, [2, 3]))
                                        @can('admin.contactos.aprobacionobispo')
                                            <span class="mx-2">
                                                <div class="custom-control custom-switch">
                                                    <input type="checkbox" @if ($contacto->estado == 3) checked @endif
                                                        data-contacto="{{ $contacto->id }}"
                                                        class="custom-control-input prevent-inactive"
                                                        id="customSwitch{{ $contacto->id }}" />
                                                    <label class="custom-control-label"
                                                        for="customSwitch{{ $contacto->id }}"></label>
                                                </div>
                                            </span>
                                        @endcan
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                <div class="form-row">
                    @if ($contactos != [])
                        <div class="col-md-6 d-flex align-items-center">
                            {{ $contactos->links() }}
                        </div>
                        <div class="col-md-6 d-flex align-items-center">
                            Viendo <b> {{ ' '. count($contactos) . ' ' }}</b> de un total de <b> {{ ' '. $contactos->total() }}</b>
                        </div>
                    @endif
                </div>
            </div>
        @else
            <div class="card-body">
                <b>No hay registros</b>
            </div>
        @endif
    </div>
</div>
