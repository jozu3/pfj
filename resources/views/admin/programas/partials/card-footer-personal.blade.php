<div class="form-row">
    <div class="col">
        {{ $inscripciones->links() }}
    </div>
    <div class="col">
        Viendo <b> {{ count($inscripciones)  }}</b> de un total de <b> {{ $inscripciones->total() }}</b>
    </div>
</div>