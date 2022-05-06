<div>
    <b class="">{{ $personaleUnidad->nota }}</b>
    @if (!$is_report)
    <i class="fas {{ $icon_comment }} text-green-400 cursor-pointer" wire:click="openModalComentario"></i>
    <x-jet-dialog-modal wire:model="open_modalComentario">
        <x-slot name="title">
            Agregar Comentario
        </x-slot>
        <x-slot name="content">
            <div class="mb-4 text-left">
                <x-jet-label value="Personale" class=""/>
                <input type="text" class="w-full form-control" value="{{ $personaleUnidad->inscripcione->personale->user->name }}" disabled>
            </div>
            <div class="mb-4 text-left">
                <x-jet-label value="Comentario"/>
                <div class="input-group">
                    <textarea name="comentario" class="form-control w-full" id="" cols="30" rows="10" wire:model="comentario"></textarea>
                </div>
                <x-jet-input-error for="comentario" />
            </div>
        </x-slot>
        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$set('open_modalComentario', false)">
                Cancelar
            </x-jet-secondary-button>
            <x-jet-danger-button wire:click="saveComentario" wire:loading.attr="disabled" wire.target="saveComentario" class="disabled:opacity-25">
                Guardar
            </x-jet-danger-button>
        </x-slot>
    </x-jet-dialog-modal>
    @endif
</div>
