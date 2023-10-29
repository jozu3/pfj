<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-3xl leading-tight text-white">
            @php
                $bienvenido = 'Bienvenido';
            @endphp
            @if (auth()->user()->personale->contacto->genero == 'Hombre')
            @php
                $bienvenido = 'Bienvenido';
            @endphp    
            @else 
            @php
                $bienvenido = 'Bienvenida';
            @endphp
            @endif
            {{ $bienvenido }} {{ auth()->user()->name }}
        </h2>
    </x-slot>

    <div>
        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            <div class="mt-10 sm:mt-0">
                @livewire('student.update-contacto')
            </div>
            <x-jet-section-border />

            <div class="mt-10 sm:mt-0">
                <x-jet-form-section submit="updateContacto">
                    <x-slot name="title">
                        {{ __('Estado de aprobación por mi Obispo / Pte de Rama') }}
                    </x-slot>
                
                    <x-slot name="description">
                        {{ __('Si aún no estás aprobado, conversa con tu Obispo o Presidente de Rama') }}
                    </x-slot>
                @php
                    $color = 'yellow';
                    $text_estado = 'Aprobación pendiente';

                @endphp
                    <x-slot name="form" >
                        @switch(auth()->user()->personale->contacto->estado_aprobacion)
                            @case(2)
                                @php
                                    $color = 'red';
                                    $text_estado = 'Desaprobado';
                                @endphp
                            @break
                            @case(1)
                                @php
                                    $color = 'green';
                                    $text_estado = 'Aprobado';
                                @endphp
                            @break

                        @endswitch
                        <div class="bg-{{ $color }}-600 text-white p-1 rounded-md">
                                                    {{ $text_estado }}
                        </div>
                    </x-slot>
                
                    <x-slot name="actions">
                    </x-slot>
                </x-jet-form-section>
            </div>
            <x-jet-section-border />
            
            @if (Laravel\Fortify\Features::canUpdateProfileInformation())
                <div class="mt-10 sm:mt-0">
                    @livewire('profile.update-profile-information-form')
                </div>

                <x-jet-section-border />
            @endif

            @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::updatePasswords()))
                <div class="mt-10 sm:mt-0">
                    @livewire('profile.update-password-form')
                </div>

                <x-jet-section-border />
            @endif



            {{-- @if (Laravel\Fortify\Features::canManageTwoFactorAuthentication())
                <div class="mt-10 sm:mt-0">
                    @livewire('profile.two-factor-authentication-form')
                </div>

                <x-jet-section-border />
            @endif
 --}}
            <div class="mt-10 sm:mt-0">
                @livewire('profile.logout-other-browser-sessions-form')
            </div>

            {{-- @if (Laravel\Jetstream\Jetstream::hasAccountDeletionFeatures())
                <x-jet-section-border />

                <div class="mt-10 sm:mt-0">
                    @livewire('profile.delete-user-form')
                </div>
            @endif --}}
        </div>
    </div>
</x-app-layout>
