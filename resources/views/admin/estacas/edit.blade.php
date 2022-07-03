{!! Form::model($estaca, ['route' => ['admin.estacas.update', $estaca], 'method' => 'put']) !!}


<div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel">Editar estaca</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body">
    @include('admin.estacas.partials.form')
</div>
<div class="modal-footer">
    {!! Form::submit('Actualizar estaca', ['class' => 'btn btn-sm btn-success']) !!}
    <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
</div>


{!! Form::close() !!}

