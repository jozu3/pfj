<div>
    <div class="card">
        <div class="card-header">
            <select wire:model="programa" class="form-control" placeholder="Ingrese nombre de un personale">
                <option value="0">--Escoge--</option>
                @foreach ($programas as $programa)
                    <option value="{{ $programa->id }}">{{$programa->nombre}}</option>
                @endforeach                
            </select>
        </div>
        <div class="card-body">
        </div>
    </div>
</div>
