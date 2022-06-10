<div wire:init="loadPersonal">
    <div class="card">
        <div class="card-header">
            <div class="form-row">
                <div class="col">
                    <input wire:model="search" class="form-control" placeholder="Ingrese nombre para buscar">
                </div>
                <div class="col">
                    <select name="" id="" class="form-control" wire:model="rol">
                        <option value="">-- Asignación --</option>
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
            </div>
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th colspan="2">Nombres</th>
                        <th>Apellidos</th>
                        <th>Asignación</th>
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
                                @if ( $inscripcione->personale->user)
                                <img id="imgperfil" class="rounded-circle" width="50" height="50"
                                    src="{{ $inscripcione->personale->user->adminlte_image() }}" alt="">
                                @else
                                <img id="imgperfil" class="rounded-circle" width="50" height="50" src="https://picsum.photos/300/300" alt="">
                                @endif
                            </td>
                            <td>
                                {{ $inscripcione->personale->contacto->nombres }}
                            </td>
                            <td>{{ $inscripcione->personale->contacto->apellidos }}</td>
                            <td>
                                {{ $inscripcione->role->name }}
                                @forelse ($inscripcione->funciones as $funcione)
                                    {{ ' - ' . $funcione->descripcion }}
                                @empty
                                @endforelse

                            </td>
                            {{-- @if ($inscripcione->role->name == 'Matrimonio Director' || $inscripcione->role->name == 'Coordinador')
                                <td>{{ $inscripcione->role->name }}</td>
                            @else
                                @if ($inscripcione->inscripcioneCompanerismo != null)   
                                <td>
                                    {{  $inscripcione->inscripcioneCompanerismo->companerismo->grupo->numero . ' - ' . $inscripcione->inscripcioneCompanerismo->companerismo->numero }}
                                </td>
                                @else
                                <td> No tiene compañero(a)</td>
                                @endif
                            @endif --}}

                            <td>
                                <span>
                                    <a href="tel:{{ $inscripcione->personale->contacto->telefono }}"
                                        alt="Llamar por teléfono" data-toggle="tooltip" data-placement="top"
                                        title="Llamar por teléfono">{{ $inscripcione->personale->contacto->telefono }}</a>
                                    <a href="https://api.whatsapp.com/send?phone=51{{ $inscripcione->personale->contacto->telefono }}"
                                        class="text-success" target="_blank" alt="Enviar Whatsapp"
                                        data-toggle="tooltip" data-placement="top" title="Enviar Whatsapp"><i
                                            class="fab fa-whatsapp"></i></a>
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
                                        {{-- onChange="Livewire.emit('changeEstado', )" --}}
                                        class="custom-control-input prevent-inactive" id="customSwitch{{ $inscripcione->id }}">
                                    <label class="custom-control-label"
                                        for="customSwitch{{ $inscripcione->id }}"></label>
                                </div>
                            </td>
                            <td width="10px">
                                <a href="{{ route('admin.contactos.show', $inscripcione->personale->contacto) }}"
                                    class="btn btn-primary"><i class="fas fa-user-edit"></i></a>
                            </td>
                            {{-- <td width="10px">
                                <a href="{{ route('admin.inscripciones.show', $inscripcione) }}" class="btn btn-primary"><i class="fas fa-edit"></i></a>
                            </td> --}}
                        </tr>
                        @empty
                            <tr>
                                <td colspan="100%">
                                    <div class="card">
                                        <div class="card-header text-warning">
                                            {{ 'No hay personal' }}
                                        </div>
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
