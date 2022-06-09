<div>
    <div class="card">
        <div class="card-body">
            <table class="table table-bordered table-striped dataTable dtr-inline">
                <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th>Descripcion</th>
                        <th colspan="2"></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="text-center"># <input type="hidden" wire:model="idFuncione"></td>
                        <td>
                            <input type="text" class="form-control" wire:model="descripcion">
                            <x-jet-input-error class="text-danger" for="descripcion" />
                        </td>
                        <td class="text-center" colspan="2">
                            <button class="btn btn-sm btn-primary" wire:click="saveFuncione">
                                Agregar
                            </button>
                        </td>
                    </tr>
                    @forelse ($funciones as $funcione)
                        <tr>
                            <td class="text-center">{{ $funcione->id }}</td>
                            <td>{{ $funcione->descripcion }}</td>
                            <td style="width: 20px;"><i class="fas fa-edit text-warning" wire:click="editFuncione({{ $funcione }})" style="cursor: pointer;"></i></td>
                            <td style="width: 20px;"><i class="fas fa-trash-alt text-danger" wire:click="removeFuncione({{ $funcione->id }})" style="cursor: pointer;"></i></td>
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
