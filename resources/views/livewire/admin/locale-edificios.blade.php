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
                            @can('admin.edificios.destroy')
                            <td width="10px">
                               <form method="POST" action="{{ route('admin.edificios.destroy', $edificio) }}">
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
        <div class="card-footer"></div>
    </div>
</div>
