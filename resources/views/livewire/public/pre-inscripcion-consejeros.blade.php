<div>
    <form method="POST" submit.prevent="" action="">
        @csrf
        <div class="grid grid-cols-12 gap-4">
            <div class="col-span-12 mt-3 sm:col-span-6">
                <x-jet-label for="nombre" value="{{ __('Name') }}" class="font-black" />
                <x-jet-input id="nombre" class="block mt-1 w-full" type="text" wire:model="nombre" name="nombre" :value="old('nombre')"
                    required autofocus autocomplete="nombre" />
            </div>

            <div class="col-span-12 mt-3 sm:col-span-6">
                <x-jet-label for="apellidos" value="{{ __('Last Name') }}" class="font-black" />
                <x-jet-input id="apellidos" class="block mt-1 w-full" type="text" wire:model="apellidos" name="apellidos"
                    :value="old('apellidos')" required autocomplete="apellidos" />
            </div>
        </div>
        <div class="mt-4">
            <x-jet-label for="email" value="{{ __('Email') }}" class="font-black" />
            <x-jet-input id="email" class="block mt-1 w-full" type="email" wire:model="email" name="email" :value="old('email')"
                required />
        </div>
        <div class="mt-4">
            <x-jet-label for="telefono" value="{{ __('Phone') }}" class="font-black" />
            <x-jet-input id="telefono" class="block mt-1 w-full" type="text" wire:model="telefono" name="telefono" :value="old('telefono')"
                required />
        </div>
        <div class="mt-4">
            <x-jet-label for="fecnac" value="{{ __('Fecha de nacimiento') }}" class="font-black" />
            <x-jet-input id="fecnac" class="block mt-1 w-full" type="date" wire:model="fecnac" name="fecnac" :value="old('fecnac')"
                required />
        </div>
        <div class="mt-4">
            <x-jet-label for="genero" value="{{ __('Sexo') }}" class="font-black" />
            <div class="mt-2 space-x-4">
                <label class="inline-flex items-center">
                    <input type="radio" class="form-radio" wire:model="genero" name="genero" value="male" {{ old('gender') === 'male' ? 'checked' : '' }}>
                    <span class="ml-2">{{ __('Male') }}</span>
                </label>
            
                <label class="inline-flex items-center">
                    <input type="radio" class="form-radio" wire:model="genero" name="genero" value="female" {{ old('gender') === 'female' ? 'checked' : '' }}>
                    <span class="ml-2">{{ __('Female') }}</span>
                </label>
            </div>
        </div>
        <div class="mt-4">
            {!! Form::label('barrio_id', 'Estaca / Barrio', ['class' => 'block text-sm text-gray-700 font-black']) !!}
            {!! Form::select('barrio_id', $estacasselect, null, [
                'class' =>
                    'border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-full',
                    'placeholder' => 'Seleccione',
                    'wire:model' => 'barrio_id'
            ]) !!}
        </div>
        <div class="mt-4">
            <x-jet-label for="obispo" value="{{ __('Nombre de tu obispo') }}" class="font-black" />
            <x-jet-input id="obispo" class="block mt-1 w-full" type="text" wire:model="obispo" name="obispo" :value="old('obispo')"
                required />
        </div>
        <div class="mt-4">
            <x-jet-label for="telobispo" value="{{ __('Teléfono de tu obispo') }}" class="font-black" />
            <x-jet-input id="telobispo" class="block mt-1 w-full" type="text" wire:model="telobispo" name="telobispo" :value="old('telobispo')"
                required />
        </div>
        <div class="mt-4">
            <x-jet-label for="email_obispo" value="{{ __('Email de tu obispo') }}" class="font-black" />
            <x-jet-input id="email_obispo" class="block mt-1 w-full" type="email" wire:model="email_obispo" name="email_obispo" :value="old('email_obispo')"
                required />
        </div>
        <div class="mt-4">
            <x-jet-label for="estudios" value="{{ __('Qué carrera estudias?') }}" class="font-black" />
            <x-jet-input id="estudios" class="block mt-1 w-full" type="text" wire:model="estudios" name="estudios" :value="old('estudios')"
                required />
        </div>
        <div class="mt-4">
            <x-jet-label for="primeros_auxilios" value="{{ __('Conoces de primeros auxilios?') }}" class="font-black"/>
            <div class="mt-2 space-x-4">
                <label class="inline-flex items-center">
                    <input type="radio" class="form-radio" wire:model="primeros_auxilios" name="primeros_auxilios" value="si" {{ old('primeros_auxilios') === 'si' ? 'checked' : '' }}>
                    <span class="ml-2">{{ __('Yes') }}</span>
                </label>
            
                <label class="inline-flex items-center">
                    <input type="radio" class="form-radio" wire:model="primeros_auxilios" name="primeros_auxilios" value="no" {{ old('primeros_auxilios') === 'no' ? 'checked' : '' }}>
                    <span class="ml-2">{{ __('No') }}</span>
                </label>
            </div>
        </div>
        <div class="mt-4">
            <x-jet-label for="ocupacion" value="{{ __('En qué trabajas o a qué te dedicas?') }}" class="font-black" />
            <x-jet-input id="ocupacion" class="block mt-1 w-full" type="text" wire:model="ocupacion" name="ocupacion" :value="old('ocupacion')"
                required />
        </div>
        <div class="mt-4">
            <x-jet-label for="llamamiento" value="{{ __('Tienes un llamamiento? Cuál?') }}" class="font-black" />
            <x-jet-input id="llamamiento" class="block mt-1 w-full" type="text" wire:model="llamamiento" name="llamamiento" :value="old('llamamiento')"
                required />
        </div>
        <div class="mt-4">
            <x-jet-label for="mretornado" value="{{ __('Eres misionero retornado?') }}" class="font-black"/>
            <div class="mt-2 space-x-4">
                <label class="inline-flex items-center">
                    <input type="radio" class="form-radio" wire:model="mretornado" name="mretornado" value="si" {{ old('mretornado') === 'si' ? 'checked' : '' }}>
                    <span class="ml-2">{{ __('Yes') }}</span>
                </label>
            
                <label class="inline-flex items-center">
                    <input type="radio" class="form-radio" wire:model="mretornado" name="mretornado" value="no" {{ old('mretornado') === 'no' ? 'checked' : '' }}>
                    <span class="ml-2">{{ __('No') }}</span>
                </label>
            </div>
        </div>
        <div class="mt-4">
            <x-jet-label for="mision" value="{{ __('Qué misión serviste y en qué año?') }}" class="font-black" />
            <x-jet-input id="mision" class="block mt-1 w-full" type="text" wire:model="mision" name="mision" :value="old('mision')"
                required />
        </div>
        <div class="mt-4">
            <x-jet-label for="vencimiento_recomendacion" value="{{ __('Cuándo vence tu recomendación para el templo?') }}" class="font-black" />
            <div class="grid grid-cols-12 gap-4">
                <div class="col-span-12 mt-3 sm:col-span-6">
                    <x-jet-label for="mes_recomendacion" value="{{ __('Month') }}" class="font-black" />
                    {!! Form::select('mes_recomendacion', [
                            '1' => 'Enero',
                            '2' => 'Febrero',
                            '3' => 'Marzo',
                            '4' => 'Abril',
                            '5' => 'Mayo',
                            '6' => 'Junio',
                            '7' => 'Julio',
                            '8' => 'Agosto',
                            '9' => 'Septiembre',
                            '10' => 'Octubre',
                            '11' => 'Noviembre',
                            '12' => 'Diciembre',
                        ], null, [
                        'class' =>
                            'border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-full',
                            'placeholder' => '-- Seleccione --',
                            'wire:model' => 'mes_recomendacion',
                    ]) !!}
                </div>

                <div class="col-span-12 mt-3 sm:col-span-6">
                    <x-jet-label for="anio_recomendacion" value="{{ __('Year') }}" class="font-black" />
                    <x-jet-input id="anio_recomendacion" class="block mt-1 w-full" type="number" wire:model="anio_recomendacion" name="anio_recomendacion"
                        :value="old('anio_recomendacion')" required autocomplete="anio_recomendacion" />
                </div>
            </div>
           
        </div>
        <div class="flex items-center justify-end mt-4">
            <x-jet-button class="ml-4">
                {{ __('Enviar') }}
            </x-jet-button>
        </div>
    </form>
</div>
