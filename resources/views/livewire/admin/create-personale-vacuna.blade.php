<div>
    <div class="card">
        <div class="card-header">
            <b>Dosis de vacunas contra el COVID-19</b>
        </div>
        <div class="card-body">
            <div></div>
            <div>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Nombres</th>
                            <th>Apellidos</th>
                            @foreach ($vacunas as $vacuna)
                                <th class="text-center">{{ $vacuna->descripcion }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($inscripciones as $inscripcione)
                            <tr>
                                <td><b>{{ $inscripcione->personale->contacto->nombres }}</b></td>
                                <td><b>{{ $inscripcione->personale->contacto->apellidos }}</b></td>
                                @foreach ($vacunas as $vacuna)
                                    <td class="text-center">
                                        @php
                                            $checkedVacuna = $inscripcione->personale->vacunas->isNotEmpty() 
                                                            && $inscripcione->personale->vacunas->where(('vacuna_id'), $vacuna->id)->firstWhere('vacunado', true) ? 'checked' : '';
                                        @endphp

                                        <input type="checkbox" {{ $checkedVacuna }} wire:click="vacunado({{ $inscripcione->personale->id }}, {{ $vacuna->id }})">
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
    </div>
</div>
