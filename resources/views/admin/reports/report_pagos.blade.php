@extends('layouts.print')
@section('title', $title)
@section('content')
    <div class="">
    	<div class="date">
			Impreso el {{ $date }}
		</div>
    	<div class="" style="">
			<div class="" style="">
				<span><b style="font-size:15px">INYAWA PERU - </b></span>
				<span><b style="font-size:15px">Capacitaciones Profesionales</b></span>
			</div>
    	</div>
		<div class="">
			<div class="">
				<div class="mb-3" style="">
					<b>Reporte de pagos</b>
					<span class="filtros">
					@if (isset($f_inicio))
						Fecha de inicio: {{ date('d/m/Y', strtotime($f_inicio)) }}
					@endif
					@if (isset($f_fin))
						Fecha de fin: {{ date('d/m/Y', strtotime($f_fin)) }}
					@endif
					</span>
				</div>
				<div class="">
					<table class="table table-striped tpagos">
						<thead>
							<tr>
								<th>Fecha de pago</th>
								<th>Código de mátricula</th>
								<th>Cuenta</th>
								<th>Personale</th>
								<th>Concepto</th>
								<th>Monto</th>
								<th>Registrado por:</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($pagos as $pago)
								<tr>
									<td>{{ date('d/m/Y', strtotime($pago->fechapago)) }}</td>
									<td>{{ $pago->obligacione->inscripcione_id }}</td>
									<td>{{ $pago->cuenta->cuenta }}</td>	
									<td>{{ $pago->obligacione->inscripcione->personale->user->name }}</td>
									<td>{{ $pago->obligacione->concepto }}</td>
									<td>{{ $pago->monto }}</td>
									<td>{{ $pago->personal->user->name }}</td>
								</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	<footer>
		
	</footer>
@endsection
@section('styles')

<style>
	.tpagos{
		font-size: 10px;
	}
	.date{
		position: absolute;
		right: 0;
		top: 0;
		font-size: 12px
	}
	.filtros{
		font-size:12px
	}
</style>
@endsection