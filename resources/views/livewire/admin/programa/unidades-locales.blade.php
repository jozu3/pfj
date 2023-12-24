<div>
    <div class="card">
        <div class="card-header">
            <button class="btn btn-sm btn-success float-right" wire:click="guardar" wire:target="guardar" wire:loading.attr='disabled'>Guardar</button>
            Escoja las estacas participantes para la sesión
        </div>
        <div class="card-body">
            <div class="form-row">
                @forelse ($ccrdnes as $cc)
                    <div class="col-2">
                        <div class="font-weight-bold">{{ $cc->nombre }}</div>
                        @foreach ($cc->estacas as $estaca)
                        <div>
                            {!! Form::checkbox('', $estaca->id, null, ['class' => 'mr-1', 'id' => 'estaca' . $estaca->id, 'wire:model' => 'estacasselecteds.'.$estaca->id]  ) !!}
                            {!! Form::label('estaca' . $estaca->id, $estaca->nombre) !!}
                        </div>
                        @endforeach
                    </div>
                @empty
                    <div class="col">
                        No ha creado estacas
                    </div>
                @endforelse

                @error('estacas')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>

    </div>
    <div class="card-footer">
        {{ var_export($estacasselecteds) }}
        <ul>
            @forelse ($estacasselecteds as $estacaInscripcione)
                <li>{{ $estacaInscripcione }}</li>
                @empty
            @endforelse
        </ul>
    </div>
</div>
