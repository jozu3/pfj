<div>
    <div class="card">
        <div class="card-header">
            <h3>Dosis de vacunas contra el COVID-19</h3>
            <div class="form-row">
                <div class="col">
                    <input wire:model="search" class="form-control" placeholder="Ingrese nombre de un personal">
                </div>
                <div class="col">
                    <select name="" id="" class="form-control" wire:model="familia">
                        <option value="">-- Familias --</option>
                        @foreach ($familias as $familia)
                            <option value="{{ $familia->id }}">{{ $familia->nombre.' '.$familia->numero }}</option>  
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div></div>
            <div>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Nombres</th>
                            <th>Apellidos</th>
                            <th>Familia</th>
                            @foreach ($vacunas as $vacuna)
                                <th class="text-center">{{ $vacuna->descripcion }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($inscripciones as $inscripcione)
                            <tr>
                                <td>
                                    @php
                                        $ins = \App\Models\Inscripcione::find($inscripcione->inscripcione_id);
                                    @endphp
                                    @if ($ins->personale->user)
                                        <img id="imgperfil" class="rounded-circle" width="50" height="50" src=" {{ $ins->personale->user->adminlte_image() }}" alt="">
                                    @else
                                        <img id="imgperfil" class="rounded-circle" width="50" height="50" src="https://picsum.photos/300/300" alt="">
                                    @endif
                                </td>
                                <td>
                                    {{ $inscripcione->contacto_nombres }}
                                </td>
                                <td>
                                    {{ $inscripcione->contacto_apellidos }}
                                </td>
                                <td>
                                    @php
                                        $ic = \App\Models\InscripcioneCompanerismo::where('inscripcione_id',$inscripcione->inscripcione_id)->first();
                                        if($ic){
                                            echo $ic->companerismo->grupo->numero ;
                                        }
                                    @endphp
                                </td>
                                @foreach ($vacunas as $vacuna)
                                    <td class="text-center">
                                        @php
                                            $checkedVacuna = $ins->personale->vacunas->isNotEmpty() 
                                            && $ins->personale->vacunas->where(('vacuna_id'), $vacuna->id)->firstWhere('vacunado', true) ? 'checked' : '';
                                        @endphp

                                        <input type="checkbox" {{ $checkedVacuna }} wire:click="vacunado({{ $ins->personale->id }}, {{ $vacuna->id }})">
                                        {{-- @livewire('admin.create-inscripcione-vacuna', 
                                        ['vacuna_id' => $vacuna->id, 'personale_id' => $inscripcione->personale->id]) --}}
                                    </td>
                                @endforeach
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer">
            @include('admin.programas.partials.card-footer-personal')
        </div>
    </div>
</div>
