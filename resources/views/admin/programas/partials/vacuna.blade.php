<div>
    <div class="card">
        <div class="card-header">
            <b>Dosis de vacunas contra el COVID-19</b>
        </div>
        <div class="card-body">
            <div>

            </div>
            <div class="">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th class="">Apellidos</th>
                            <th class="">Nombres</th>
                            @foreach ($vacunas as $vacuna)
                                <th class="text-center">{{ $vacuna->descripcion }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($programa->inscripcionesEstado([0, 1, 2]) as $inscripcione)
                            <tr>
                                <td><b>{{ $inscripcione->personale->contacto->apellidos }}</b></td>
                                <td><b>{{ $inscripcione->personale->contacto->nombres }}</b></td>
                                @foreach ($vacunas as $vacuna)
                                    <td class="text-center">
                                        @livewire('admin.create-inscripcione-vacuna', 
                                        ['vacuna_id' => $vacuna->id, 'personale_id' => $inscripcione->personale->id])
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
