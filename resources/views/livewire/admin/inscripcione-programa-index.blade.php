<div wire:init="loadPersonal">
    <div class="card">
        <div class="card-header">
            <div class="form-row">
                <div class="col">
                    <input wire:model="search" class="form-control" placeholder="Ingrese nombre para buscar">
                </div>
                <div class="col">
                    <select name="" id="" class="form-control" wire:model="rol">
                        <option value="0">-- Asignación --</option>
                        @foreach ($roles as $role)
                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                        @endforeach
                    </select>

                    @if ($rol > 4)
                        <div class="form-row">
                            @forelse ($funciones as $funcione)
                                <div class="col">
                                    <input type="checkbox" value="{{ $funcione->id }}"
                                        wire:model="functions_selecteds.ca{{ $funcione->id }}"
                                        id="{{ $funcione->descripcion . $funcione->id }}">
                                    <label
                                        for="{{ $funcione->descripcion . $funcione->id }}">{{ $funcione->descripcion }}</label>
                                </div>
                            @empty
                            @endforelse
                        </div>
                    @else
                    @endif
                </div>
                <div class="col">
                    <select name="" id="" class="form-control" wire:model="estaca">
                        <option value="0">-- Estaca --</option>
                        @foreach ($estacas as $stk)
                            <option value="{{ $stk->id }}">{{ $stk->nombre }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col">
                    <select name="" id="" class="form-control" wire:model="familia">
                        <option value="0">-- Familia --</option>
                        @foreach ($familias as $grupo)
                            <option value="{{ $grupo->id }}">{{ $grupo->numero }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col">
                    <select name="" id="" class="form-control" wire:model="estado">
                        <option value="-1">-- Todos --</option>
                        <option value="0">Inactivo</option>
                        <option value="1">Activo</option>
                    </select>
                </div>
                <div class="col">
                    <a href="{{ route('admin.excel.exportExcelPersonal', [$programa_id, $familia, $estaca, $estado, $rol]) }}"
                        class="btn btn-success float-right mr-3">
                        <i class="far fa-file-excel"></i> Descargar
                    </a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th colspan="2">Nombres</th>
                        <th>Apellidos</th>
                        <th>Estaca</th>
                        <th>Asignación</th>
                        <th>Familia</th>
                        {{-- <th>Grupo - Compañerismo</th> --}}
                        <th>Telefono</th>
                        <th>Correo electrónico</th>
                        <th>Pre-Inscripción</th>
                        <th>Activo</th>
                        {{-- <th>Recomendación para el templo</th>
                        <th>Permiso del obispo</th> --}}
                    </tr>
                </thead>
                <tbody>
                    @forelse ($inscripciones as $inscripcione)
                        <tr>
                            <td>
                                <img id="imgperfil" class="rounded-circle {{ $inscripcione->id }}" width="50"
                                    height="50"
                                    style="object-fit: cover;"
                                    src="@if ($inscripcione->personale->user) {{ $inscripcione->personale->user->adminlte_image() }} @else {{ 'https://picsum.photos/300/300' }} @endif"
                                    alt="">
                            </td>
                            <td>
                                {{ $inscripcione->personale->contacto->nombres }}
                                {{-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" wire:click="$emitTo('admin.modal-detalle-contacto', 'showcontacto', '{{$inscripcione->id}}')">
                                  </button> --}}
                            </td>
                            <td>{{ $inscripcione->personale->contacto->apellidos }}</td>
                            <td>
                                {{ $inscripcione->personale->barrio->estaca->nombre }}
                            </td>
                            <td>
                                {{ $inscripcione->role->name }}
                                @forelse ($inscripcione->funciones as $funcione)
                                    {{ ' - ' . $funcione->descripcion }}
                                @empty
                                @endforelse

                            </td>
                            @if ($inscripcione->role->name == 'Matrimonio Director' || $inscripcione->role->name == 'Matrimonio de Logística' || $inscripcione->role->name == 'Coordinador')
                                <td>{{ $inscripcione->role->name }}</td>
                            @else
                                @if ($inscripcione->inscripcioneCompanerismo != null)
                                    <td>
                                        {{ $inscripcione->inscripcioneCompanerismo->companerismo->grupo->numero }}
                                    </td>
                                @else
                                    <td>
                                        No tiene compañero(a)
                                    </td>
                                @endif
                            @endif
                            <td>
                                <span>
                                    <a href="tel:{{ $inscripcione->personale->contacto->telefono }}"
                                        alt="Llamar por teléfono" data-toggle="tooltip" data-placement="top"
                                        title="Llamar por teléfono">{{ $inscripcione->personale->contacto->telefono }}</a>
                                    <a href="https://api.whatsapp.com/send?phone=51{{ $inscripcione->personale->contacto->telefono }}"
                                        class="text-success" target="_blank" alt="Enviar Whatsapp" data-toggle="tooltip"
                                        data-placement="top" title="Enviar Whatsapp"><i class="fab fa-whatsapp"></i></a>
                                </span>
                            </td>
                            <td>
                                @if ($inscripcione->personale->user)
                                    <a href="mailto:{{ $inscripcione->personale->user->email }}" alt="Enviar email"
                                        data-toggle="tooltip" data-placement="top"
                                        title="Enviar email">{{ $inscripcione->personale->user->email }}</a>
                                @else
                                    <a href="{{ route('admin.users.create', ['personale' => $inscripcione->personale]) }}"
                                        class="btn btn-primary">Crear usuario</a>
                                @endif
                            </td>
                            <td>
                                @switch($inscripcione->personale->preinscripcion)
                                    @case(1)
                                        {{ 'Sí' }}
                                    @break

                                    @case(0)
                                        {{ 'No' }}
                                    @break

                                    @default
                                @endswitch
                            </td>
                            <td>
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" @if ($inscripcione->estado) checked @endif
                                        data-inscripcione="{{ $inscripcione->id }}"
                                        class="custom-control-input prevent-inactive"
                                        id="customSwitch{{ $inscripcione->id }}">
                                    <label class="custom-control-label"
                                        for="customSwitch{{ $inscripcione->id }}"></label>
                                </div>
                            </td>
                            <td width="10px">
                                <a href="{{ route('admin.contactos.show', $inscripcione->personale->contacto) }}"
                                    class="btn btn-primary"><i class="fas fa-user-edit"></i></a>
                            </td>
                        </tr>
                        @empty
                            <tr>
                                <td colspan="100%">
                                    <div class=" text-warning">
                                        {{ 'No hay personal' }}
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                @include('admin.programas.partials.card-footer-personal')
            </div>
        </div>
    </div>
