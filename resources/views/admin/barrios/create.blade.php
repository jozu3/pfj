{!! Form::open(['route' => 'admin.barrios.store']) !!}

<div class="modal-header">
    <h5 class="modal-title" >Nueva estaca</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body">
    @include('admin.barrios.partials.form')
</div>
<div class="modal-footer">
    {!! Form::submit('Crear barrio', ['class' => 'btn btn-sm btn-success']) !!}
    <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
</div>

{!! Form::close() !!}