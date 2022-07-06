<div wire:init="loadParticipantes">
    <div class="card">
        <div class="card-header">
            <div class="form-row">
                <div class="col">
                    <input wire:model="search" class="form-control" placeholder="Ingrese nombre para buscar">
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
                    <select name="" id="" class="form-control" wire:model="compania">
                        <option value="0">-- Compañia --</option>
                        @foreach ($companerismos as $compania)
                            <option value="{{ $compania->id }}">{{ $compania->numero }}</option>
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
                {{-- <div class="col">
                    <a href="{{ route('admin.excel.exportExcelParticipantes', [$programa_id, $compania, $estaca, $estado]) }}"
                        class="btn btn-success float-right mr-3">
                        <i class="far fa-file-excel"></i> Descargar
                    </a>
                </div> --}}
            </div>
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th colspan="2">Nombres</th>
                        <th>Apellidos</th>
                        <th>Estaca</th>
                        <th>Compañia</th>
                        <th>Telefono</th>
                        <th>Correo electrónico</th>
                        <th>Fecha de nacimiento</th>
                        <th>Edad</th>
                        <th>Activo</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($participantes as $participante)
                        <tr>
                            <td>
                                <img id="imgperfil" class="rounded-circle {{ $participante->id }}" width="50"
                                    height="50" style="object-fit: cover;"
                                    src="@if ($participante->image) {{ $participante->image() }} @else {{ 'https://picsum.photos/300/300' }} @endif"
                                    alt="">
                            </td>
                            <td>
                                {{ $participante->nombres }}
                                {{-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" wire:click="$emitTo('admin.modal-detalle-contacto', 'showcontacto', '{{$participante->id}}')">
                                  </button> --}}
                            </td>
                            <td>{{ $participante->apellidos }}</td>
                            <td>
                                {{ $participante->barrio->estaca->nombre }}
                            </td>
                            <td>
                                @if ($participante->participante_compania)
                                    {{ $participante->participante_compania->companerismo->numero }}
                                    
                                @endif
                            </td>
                            <td>
                                <span>
                                    <a href="tel:{{ $participante->telefono }}"
                                        alt="Llamar por teléfono" data-toggle="tooltip" data-placement="top"
                                        title="Llamar por teléfono">{{ $participante->telefono }}</a>
                                    <a href="https://api.whatsapp.com/send?phone=51{{ $participante->telefono }}"
                                        class="text-success" target="_blank" alt="Enviar Whatsapp" data-toggle="tooltip"
                                        data-placement="top" title="Enviar Whatsapp"><i class="fab fa-whatsapp"></i></a>
                                </span>
                            </td>
                            <td>
                                @if ($participante)
                                    <a href="mailto:{{ $participante->email }}" alt="Enviar email"
                                        data-toggle="tooltip" data-placement="top"
                                        title="Enviar email">{{ $participante->email }}</a>
                                @else
                                   
                                @endif
                            </td>
                            <td>
                                {{ date( 'd/m/Y' , strtotime($participante->fecnac)) }}
                            </td>
                            <td>
                                {{ $participante->age }}
                            </td>
                            <td>
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" @if ($participante->estado) checked @endif
                                        data-participante="{{ $participante->id }}"
                                        class="custom-control-input prevent-inactive"
                                        id="customSwitch{{ $participante->id }}">
                                    <label class="custom-control-label"
                                        for="customSwitch{{ $participante->id }}"></label>
                                </div>
                            </td>
                            <td width="10px">
                                <a href="{{ route('admin.participantes.show', $participante) }}"
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
                <div class="form-row">
                    @if ($participantes != [])
                        <div class="col">
                            {{ $participantes->links() }}
                        </div>
                        <div class="col">
                            Viendo <b> {{ count($participantes) }}</b> de un total de <b> {{ $participantes->total() }}</b>
                        </div>
                    @endif
                </div>
                
            </div>
        </div>
    </div>
