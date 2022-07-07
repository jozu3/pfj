<div>
    <div class="card">
        <div class="card-header">
            <div class="form-row">
                <div class="col">
                    <input wire:model="search" class="form-control" placeholder="Ingrese nombre para buscar">
                </div>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Local</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($locales as $locale)
                        <tr>
                            <td>
                                {{$locale->nombre}}
                            </td>
                            <td width="10px">
                                <a href="{{ route('admin.locales.show', $locale) }}" class="btn btn-sm btn-primary" >Administrar</a>
                            </td>
                            <td width="10px">
                                <a href="{{ route('admin.locales.edit', $locale) }}" class="btn btn-sm btn-primary" >Editar</a>
                            </td>
                            @can('admin.locales.destroy')
                            <td width="10px">
                               <form method="POST" class="" action="{{ route('admin.locales.destroy', $locale) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger ">Eliminar</button>
                                </form>
                            </td>
                            @endcan
                        </tr>
                        @empty
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
