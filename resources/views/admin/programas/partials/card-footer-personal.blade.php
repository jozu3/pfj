<div class="form-row">
    @if ($inscripciones != [])
        <div class="col-md-6 d-flex align-items-center">
            {{ $inscripciones->links() }}
        </div>
        <div class="col-md-6 d-flex align-items-center">
            Viendo <b> {{ count($inscripciones) }}</b> de un total de <b> {{ $inscripciones->total() }}</b>
        </div>
    @endif
</div>
