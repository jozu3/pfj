<div>
    <div class="card">
        <div class="card-body">
            <div>

            </div>
            <table id="example1" class="table table-bordered table-striped dataTable dtr-inline"
                aria-describedby="example1_info">
                <thead>
                    <tr>
                        <th class="text-center sorting sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                            aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">
                            #</th>
                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                            aria-label="Browser: activate to sort column ascending">Descripción del material</th>
                        <th class="text-center sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                            aria-label="Platform(s): activate to sort column ascending" style="width: 40px;">Estado</th>
                         <th class="" style="width: 20px;">&nbsp;</th>
                        <th class="" style="width: 20px;">&nbsp;</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="odd">
                        <td class="text-center dtr-control sorting_1" tabindex="0">
                          # <input type="hidden" wire:model='idMateriale'>
                        </td>
                        <td>
                          <input type="text" class="form-control" wire:model='materiale'>
                          <x-jet-input-error class="text-danger" for="materiale" />
                        </td>
                        <td class="text-center" colspan="3">
                         <button class="btn btn-primary" wire:click="saveMateriale">
                           <i class="fas fa-save"></i>
                          </button>
                        </td>
                    </tr>
                    @foreach ($materiales as $materiale)
                        <tr class="even">
                            <td class="text-center dtr-control sorting_1" tabindex="0">{{ $materiale->id }}</td>
                            <td>{{ $materiale->descripcion }}</td>
                            <td class="text-center"><span class="badge badge-success">Habilitado</span></td>
                            <td class="w-auto"><i class="fas fa-edit text-warning" wire:click='editMateriale({{ $materiale }})' style="cursor:pointer;"></i></td>
                            <td class="w-auto"><i class="fas fa-trash-alt text-danger" wire:click='removeMateriale({{ $materiale->id }})' style="cursor:pointer;"></i></td>
                        </tr>
                    @endforeach
                </tbody>
                {{-- <tfoot>
                    <tr>
                        <th rowspan="1" colspan="1">Rendering engine</th>
                        <th rowspan="1" colspan="1">Browser</th>
                        <th rowspan="1" colspan="1">Platform(s)</th>
                        <th rowspan="1" colspan="1">Engine version</th>
                        <th rowspan="1" colspan="1">CSS grade</th>
                    </tr>
                </tfoot> --}}
            </table>
        </div>
    </div>
</div>
