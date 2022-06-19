<div>
    <div class="card">
    	<div class="card-header">
    		<input wire:model="search" class="form-control" placeholder="Ingrese nombre o correo de un usuario">
    	</div>
        @if ($sessions->count())
    	<div class="card-body">
    		<table class="table table-striped">
    			<thead>
    				<tr>
    					<th>ID</th>
                        <th>Usuario</th>
                        <th>IP</th>
    					<th>Última actividad</th>
    					<th></th>
    				</tr>
    			</thead>
    			<tbody>
    				@foreach($sessions as $session)
						@php
							$user = App\Models\User::find( $session->user_id);	
						@endphp
					<tr>
						<td></td>
						@if ($user)
							
                        <td>{{ $user->name }}</td>
						@else
						<td></td>
						@endif
						<td>{{ $session->ip_address }}</td>
                        <td>{{ date('d/m/Y h:i:s', $session->last_activity) }}</td>
						@can('admin.sessions.destroy')
						<td width="10px">
							
						</td>
						@endcan
					</tr>
					@endforeach
    			</tbody>
    		</table>
    	</div>
        <div class="card-footer">
            {{-- {{ $sessions->links() }} --}}
        </div>
        @else
            <div class="card-body">
                <b>No hay registros</b>        
            </div>
        @endif
    </div>
</div>
