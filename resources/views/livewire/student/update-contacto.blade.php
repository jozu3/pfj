<div>
    <x-jet-form-section submit="updateContacto">
        <x-slot name="title">
            {{ __('Información de contacto') }}
        </x-slot>
    
        <x-slot name="description">
            {{ __('Actualiza tus datos personales') }}
        </x-slot>
    
        <x-slot name="form">
            <!-- Email -->
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="nombres" value="{{ __('Nombres') }}" />
                <x-jet-input id="nombres" type="text" class="mt-1 block w-full" wire:model.defer="nombres" />
                <x-jet-input-error for="nombres" class="mt-2" />
            </div>
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="apellidos" value="{{ __('Apellidos') }}" />
                <x-jet-input id="apellidos" type="text" class="mt-1 block w-full" wire:model.defer="apellidos" />
                <x-jet-input-error for="apellidos" class="mt-2" />
            </div>
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="fecnac" value="{{ __('Fecha de nacimiento') }}" />
                <x-jet-input id="fecnac" type="date" class="mt-1 block w-full" wire:model.defer="fecnac" />
                <x-jet-input-error for="fecnac" class="mt-2" />
            </div>
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="telefono" value="{{ __('Teléfono') }}" />
                <x-jet-input id="telefono" type="text" class="mt-1 block w-full" wire:model.defer="telefono" />
                <x-jet-input-error for="telefono" class="mt-2" />
            </div>
        </x-slot>
    
        <x-slot name="actions">
            <x-jet-action-message class="mr-3 text-green-600" on="saved">
                {{ __('Guardado.') }}
            </x-jet-action-message>
    
            <x-jet-button wire:loading.attr="disabled" wire:target="updateContacto">
                {{ __('Guardar') }}
            </x-jet-button>
        </x-slot>
    </x-jet-form-section>
    
</div>
