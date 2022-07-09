<div>
    <div class="card">
        <div class="card-header">
            <h2>Edificios</h2>
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <td>Nombre</td>
                        <td>Pisos</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($edificios as $edificio)
                        <tr>
                            <td>
                                {{ $edificio->nombre }}
                            </td>
                            <td>
                                {{ count($edificio->pisos) }}
                            </td>
                            <td></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer"></div>
    </div>
</div>
