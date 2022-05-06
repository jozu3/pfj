<div>
    <div class="card">
    	<div class="card-header">
            <div class="">
                <h3>Ingreso por fechas</h3>
            </div>
            <div class="form-row align-items-center">
                <div class="col-auto my-1">
                    <label class="ml-1" for="">Fecha de inicio</label>
                    <input wire:model="f_inicio" type="date" class="form-control" style="" placeholder="Ingrese  código de inscripcione para ver los pagos correspondientes">
                </div>
                <div class="col-auto my-1 mx-2">
                    <label class="ml-1" for="">Fecha de fin</label>
                    <input wire:model="f_fin" type="date" class="form-control" style="" placeholder="Ingrese  código de inscripcione para ver los pagos correspondientes">
                </div>
            </div>
            <div class="form-row align-items-center">
            </div>
    	</div>
        @if ($pagos->count())
    	<div class="card-body" style="overflow-x: auto">
    		<table class="table table-striped">
    			<thead>
    				<tr>
    					<th>Cuenta</th>
    					<th>Ingreso</th>
    				</tr>
    			</thead>
    			<tbody>
    				@foreach($pagos as $pago)
    				  <tr>
                        <td>{{ $pago->nombrecuenta}}</td>
                        <td>
                            <b>{{ 'S/ '.number_format($pago->sumpagos, 2)  }}</b>
                        </td>
    				  </tr>
    				@endforeach
    			</tbody>
    		</table>
    	</div>
        @else
            <div class="card-body">
                <b>No hay registros</b>        
            </div>
        @endif
    </div>
</div>
