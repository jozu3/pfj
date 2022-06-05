<div>
    <div class="card">
        <div class="card-body">
            <table class="table table-bordered table-striped dataTable dtr-inline">
<thead>
    <tr>
        <th>#</th>
        <th>Descripcion</th>
    </tr>
</thead>
<tbody>
    @forelse ($funciones as $funcione)
    <tr>
        <td>{{$funcione->id}}</td>
        <td>{{$funcione->descripcion}}</td>
    </tr>
    @empty
        <tr>
            <td>No se encontraron regisstros</td>
        </tr>
    @endforelse
    
</tbody>
            </table>
        </div>
    </div>
    
</div>
