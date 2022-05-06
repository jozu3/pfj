@extends('layouts.print')
@section('title', 'Recibo de Matrícula')
@section('content')
    <div class="recibo border border-dark rounded-lg">
	    RECIBO DE PAGO
	    <div style="font-size:18px">N° de Matrícula</div>
	    <div style="font-size:18px">{{ $inscripcione->id }}</div>
	</div>
    <div class="">		
    	<div class="d-flex" style="border:1px solid black">
			<div class="" style="height:65px">
				<img class="logo" src="{{ config('app.url') }}/img/logo_pfj.jpg" alt="">
			</div>
			<div class="" style="margin-left:150px; height:65px">
				<div><b style="font-size:25px">INYAWA PERU</b></div>
				<div><b style="font-size:15px">Capacitaciones Profesionales</b></div>
			</div>
    	</div>
		<div class="datos">
			<div class="mt-1 ml-2">
				<span class="text1">Personale:</span>
				<span class="">{{ $inscripcione->personale->user->name}}     </span>
				<span class="text1">Código de personale:</span>
				<span class="">{{ $inscripcione->personale->codigo }}</span>
			</div>
			<div class="mt-1 ml-2">
				<span class="text1">DNI:</span>
				<span class="">{{ $inscripcione->personale->contacto->doc}}</span>
			</div>
			<div class="mt-1 ml-2">
				<span class="text1">Correo electrónico:</span>
				<span class="">{{ $inscripcione->personale->contacto->email}}</span>
			</div>
			<div class="mt-1 ml-2">
				<span class="text1">Teléfono:</span>
				<span class="">{{ $inscripcione->personale->contacto->telefono}}</span>
			</div>
			<div class="mt-1 ml-2">
			</div>
			<div class="mt-1 ml-2 mb-1">
				<span class="text1">Pfj:</span>
				<span class="col-md-9">{{ $inscripcione->grupo->pfj->nombre }}     </span>
				<span class="text1">Fecha de inicio del grupo:</span>
				<span class="col-md-9">{{ date('d/m/Y',strtotime($inscripcione->grupo->fecha)) }}</span>
			</div>
			<div class="mt-1 ml-2 mb-1">
			</div>
		</div>
		<div class="mt-3">
			<div class="">
				<div class="mt-1">
					<b>Obligaciones por pagar</b>
				</div>
				<div class="">
					<table class="table table-striped mt-4">
						<thead>
							<tr>
								<th>Concepto</th>
								<th>Fecha</th>
								<th>Estado</th>
								<th>Importe inicial</th>
								<th>Descuento</th>
								<th>Importe final</th>
							</tr>
						</thead>
						<tbody>
							@php
								$total = 0;
							@endphp
							@foreach ($inscripcione->obligaciones as $obligacione)
								<tr>
									<td>{{$obligacione->concepto}}</td>
									<td>{{$obligacione->fechalimite}}</td>
									<td>
										@switch ($obligacione->estado)
											@case(0)
										        Exonerado
										        @break
										    @case(1)
										        Por pagar
										        @break
										    @case(2)
										        Parcial
										    	@break
										    @case(3)
										        Pagado
										    	@break
										@endswitch
										@if ($obligacione->fechapagadototal > $obligacione->fechalimite)
			                                <small class="text-danger">({{ date('d/m/Y', strtotime($obligacione->fechapagadototal)) }})</small>
			                            @endif
									</td>
									<td>{{ 'S/ '.number_format($obligacione->monto, 2) }}</td>
									<td>{{ 'S/ '.number_format($obligacione->descuento, 2) }}</td>
									<td>{{ 'S/ '.number_format($obligacione->montofinal, 2) }}</td>
								</tr>
								@php
									$total += $obligacione->montofinal;
								@endphp
							@endforeach
							<tr>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td><b>Total</b></td>
								<td><b>{{ 'S/ '.number_format($total, 2) }}</b></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	<br>

	<footer class="footer"> 
		<div class="align-items-center" style="height: 100%; padding-top:10px">
			<span class="" style="margin-left:20px">
				<img src="{{ config('app.url') }}/img/ic_fb_white.png" width="18px" alt="">
			</span>
			<span style="">
				INYAWA PERU
			</span>	
			<span class="ml-4" style="margin-left: 50px;" >
				Av Elmer Faucett 16-27 jardines de Viru - Bella Vista - Callao
			</span>
			
		</div>
	</footer>
@endsection
@section('styles')

<style>
	.recibo{
		font-size:23px;
		font-weight:bold;
		position:absolute;
		right:0px;
		top:0px;
		text-align:center;
		width: 250px
	}
	.datos{
		font-size:14px;
		border:1px solid black;
	}
	.icfb{
		color: #385898;
	}
	.text1 {
		width: 25%;
		font-weight: bold;
		/*background-color:red;*/
	}
	.logo{
		width: 150px;
	}
	table{
		font-size: 12px;
	}
	.cont-logo{
		/*position: absolute;
		top: 80px;
		right: 30px;*/
	}
	.p-footer{
		font-weight: bold;
	}
	td, th {
     	padding: .4rem!important;
    }
    .ic-fb{
    	width: 18px;
    }
    .footer{
    	position: absolute;
    	bottom:-35;
    	left:-35;
    	right:-35;
    	width: 100%;
    	height:50px;
    	background-color: #864c4a;
    	color: #fff;
		font-size: 17px;
		padding-left: 20px;
    }
</style>
@endsection