<div>
    {{-- <x-jet-secondary-button wire:click="createShowModal">
        Añadir lectura
    </x-jet-secondary-button> --}}
    <button class="btn btn-sm btn-primary" wire:click="createShowModal">
        <i class="fas fa-plus-circle"></i> Añadir lectura
    </button>

    <x-jet-dialog-modal wire:model="abierto">
        <x-slot name="title">

        </x-slot>
        <x-slot name="content">

        </x-slot>
        <x-slot name="footer">

        </x-slot>

        </x-jet-dialog-modal>   
</div>
