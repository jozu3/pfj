<div class="card">
			<div class="card-header">
				<b>Comentarios</b>
				{{-- <div class="form-check mt-2 d-inline float-right">
					<input class="form-check-input" wire:model= "vermis_comentarios" type="checkbox" id="vermis_comentarios">
					<label class="form-check-label" for="vermis_comentarios">
						Ver solo del vendedor actual
					</label>
				</div> --}}
			</div>
			<div class="card-body">
				<table class="table table-striped">
					<thead>
						<tr>
							<th>Fecha</th>
							<th>Pfj</th>
							<th>Comentario</th>
							<th>Usuario</th>
							<th>Estado del contacto</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						@foreach ($seguimientos as $seg)
							<tr>
								<td>{{$seg->fecha}}</td>
								<td>{{$seg->pfj->nombre}}</td>
								<td>{{$seg->comentario}}</td>
								<td colspan="2">{{$seg->personal->user->name}}</td>
								<td></td>
							</tr>
						@endforeach
                        <tr>
						{!! Form::open(['route' => 'admin.seguimientos.store']) !!}
							{!! Form::hidden('contacto_id', $contacto->id) !!}
							{!! Form::hidden('tipo', 0) !!}
							{!! Form::hidden('user_id', auth()->user()->id) !!}
							{!! Form::hidden('personal_id', auth()->user()->personale->id) !!}

                            <td width="100px">
								{!! Form::date('', date('Y-m-d'), ['class' => 'form-control', 'disabled' => 'disabled']) !!}
                            </td>
                            <td>
                            	{!! Form::select('pfj_id', $pfjs, null, ['class' => 'form-control', 'placeholder' => 'Escoge un pfj']); !!}
							@error('pfj_id')
								<small class="text-danger">{{ $message }}</small>
							@enderror
                            </td>
                            <td>
								{!! Form::text('comentario', null, ['class' => 'form-control', 'placeholder' => 'Ingrese un comentario']) !!}
							@error('comentario')
								<small class="text-danger">{{ $message }}</small>
							@enderror
                            </td>
                            <td width="200px">
                                {!! Form::text('user', auth()->user()->name, ['class' => 'form-control', 'disabled' => 'disabled']) !!}
                            </td>
                            <td>
								{!! Form::select('estado', [
										'2' => 'Contactado',
										'3' => 'Probable',
										'4' => 'Confirmado',
									], null, ['class' => 'form-control', 'placeholder' => 'Escoge', 'style' => '']); !!}
								@error('estado')
									<small class="text-danger">{{ $message }}</small>
								@enderror
                            </td>	
                            <td>
                            	{!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
                            </td>
                    	{!! Form::close() !!}
                        </tr>
					</tbody>
				</table>
			</div>
</div>