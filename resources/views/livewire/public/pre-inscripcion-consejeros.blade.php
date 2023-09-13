<div wire:init="loadFormulario">
    @if (!$result)
        <jet-validation-errors class="mb-4" />
        <form wire:submit.prevent="guardar">
            @csrf
            <div class="grid grid-cols-12 gap-4">
                <div class="col-span-12 mt-3 sm:col-span-6">
                    <x-jet-label for="nombres" value="{{ __('Name') }}" class="font-black" />
                    <x-jet-input id="nombres" class="block mt-1 w-full" type="text" name="nombres" wire:model="nombres"
                        required autofocus autocomplete="given-name" />
                    @error('apellidos')
                        <small class="text-red-600">{{ $message }}</small>
                    @enderror
                </div>

                <div class="col-span-12 mt-3 sm:col-span-6">
                    <x-jet-label for="apellidos" value="{{ __('Last Name') }}" class="font-black" />
                    <x-jet-input id="apellidos" class="block mt-1 w-full" type="text" wire:model="apellidos" required
                        autocomplete="family-name" />
                    @error('apellidos')
                        <small class="text-red-600">{{ $message }}</small>
                    @enderror

                </div>
            </div>
            <div class="mt-4">
                <x-jet-label for="email" value="{{ __('Email') }}" class="font-black" />
                <x-jet-input id="email" class="block mt-1 w-full" type="email" wire:model="email" name="email"
                    required />
                @error('email')
                    <small class="text-red-600">{{ $message }}</small>
                @enderror
            </div>
            <div class="mt-4">
                <x-jet-label for="telefono" value="{{ __('Phone') }}" class="font-black" />
                <x-jet-input id="telefono" class="block mt-1 w-full" type="number" min="0" wire:model="telefono"
                    name="telefono" required />
                @error('telefono')
                    <small class="text-red-600">{{ $message }}</small>
                @enderror

            </div>
            <div class="mt-4">
                <x-jet-label for="fecnac" value="{{ __('Fecha de nacimiento') }}" class="font-black" />
                <x-jet-input id="fecnac" class="block mt-1 w-full" type="date" wire:model="fecnac" name="fecnac"
                    required />
                @error('fecnac')
                    <small class="text-red-600">{{ $message }}</small>
                @enderror

            </div>
            <div class="mt-4">
                <x-jet-label for="genero" value="{{ __('Género') }}" class="font-black" />
                <div class="mt-2 space-x-4">
                    <label class="inline-flex items-center">
                        <input type="radio" class="form-radio" wire:model="genero" name="genero" value="Hombre">
                        <span class="ml-2">{{ __('Male') }}</span>
                    </label>

                    <label class="inline-flex items-center">
                        <input type="radio" class="form-radio" wire:model="genero" name="genero" value="Mujer">
                        <span class="ml-2">{{ __('Female') }}</span>
                    </label>
                </div>
                @error('genero')
                    <small class="text-red-600">{{ $message }}</small>
                @enderror
            </div>
            <x-jet-section-border />
            <div class="mt-4">
                {!! Form::label('barrio_id', 'Estaca / Barrio', ['class' => 'block text-sm text-gray-700 font-black']) !!}
                {!! Form::select('barrio_id', $estacasselect, null, [
                    'class' =>
                        'border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-full',
                    'placeholder' => 'Seleccione',
                    'wire:model' => 'barrio_id',
                ]) !!}
                   @error('barrio_id')
                   <small class="text-red-600">{{ $message }}</small>
               @enderror
            </div>
            @if ($barrio_id == 1)
                <div class="grid grid-cols-12 gap-4">
                    <div class="col-span-12 mt-3 sm:col-span-6">
                        <x-jet-label for="otro_barrio" value="{{ __('De qué barrio eres?') }}" class="font-black" />
                        <x-jet-input id="otro_barrio" class="block mt-1 w-full" type="text" wire:model="otro_barrio"
                            name="otro_barrio" required />
                        @error('otro_barrio')
                            <small class="text-red-600">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-span-12 mt-3 sm:col-span-6">
                        <x-jet-label for="otra_estaca" value="{{ __('A qué estaca pertenece?') }}"
                            class="font-black" />
                        <x-jet-input id="otra_estaca" class="block mt-1 w-full" type="text" wire:model="otra_estaca"
                            name="otra_estaca" required />
                        @error('otra_estaca')
                            <small class="text-red-600">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
            @endif
            <div class="mt-4">
                <x-jet-label for="obispo" value="{{ __('Nombre de tu obispo') }}" class="font-black" />
                <x-jet-input id="obispo" class="block mt-1 w-full" type="text" wire:model="obispo"
                    name="obispo" required />
                @error('obispo')
                    <small class="text-red-600">{{ $message }}</small>
                @enderror
            </div>
            <div class="mt-4">
                <x-jet-label for="telefono_obispo" value="{{ __('Teléfono de tu obispo') }}" class="font-black" />
                <x-jet-input id="telefono_obispo" class="block mt-1 w-full" type="number" min="0" wire:model="telefono_obispo"
                    name="telefono_obispo" required />
                @error('telefono_obispo')
                    <small class="text-red-600">{{ $message }}</small>
                @enderror
            </div>
            <div class="mt-4">
                <x-jet-label for="email_obispo" value="{{ __('Email de tu obispo') }}" class="font-black" />
                <x-jet-input id="email_obispo" class="block mt-1 w-full" type="email" wire:model="email_obispo"
                    name="email_obispo" />
                @error('email_obispo')
                    <small class="text-red-600">{{ $message }}</small>
                @enderror
            </div>
            <div class="mt-4">
                <x-jet-label for="llamamiento" value="{{ __('Cuál es tu llamamiento?') }}" class="font-black" />
                <x-jet-input id="llamamiento" class="block mt-1 w-full" type="text" wire:model="llamamiento"
                    name="llamamiento" required />
                @error('llamamiento')
                    <small class="text-red-600">{{ $message }}</small>
                @enderror

            </div>
            <div class="mt-4">
                <x-jet-label for="asiste_instituto" value="{{ __('Asistes a institutos?') }}" class="font-black" />
                <div class="mt-2 space-x-4">
                    <label class="inline-flex items-center">
                        <input type="radio" class="form-radio" wire:model="asiste_instituto"
                            name="asiste_instituto" value="1"
                            {{ old('asiste_instituto') === '1' ? 'checked' : '' }}>
                        <span class="ml-2">{{ __('Yes') }}</span>
                    </label>

                    <label class="inline-flex items-center">
                        <input type="radio" class="form-radio" wire:model="asiste_instituto"
                            name="asiste_instituto" value="0"
                            {{ old('asiste_instituto') === '0' ? 'checked' : '' }}>
                        <span class="ml-2">{{ __('No') }}</span>
                    </label>
                </div>
                @error('asiste_instituto')
                    <small class="text-red-600">{{ $message }}</small>
                @enderror
            </div>
            @if ($asiste_instituto == 1)
                <div class="mt-4">
                    <x-jet-label for="instituto" value="{{ __('A qué curso estás inscrito?') }}"
                        class="font-black" />
                    <x-jet-input id="instituto" class="block mt-1 w-full" type="text" wire:model="instituto"
                        name="instituto" required />
                    @error('instituto')
                        <small class="text-red-600">{{ $message }}</small>
                    @enderror
                </div>
            @endif
            <div class="mt-4">
                <x-jet-label for="mretornado" value="{{ __('Eres misionero retornado?') }}" class="font-black" />
                <div class="mt-2 space-x-4">
                    <label class="inline-flex items-center">
                        <input type="radio" class="form-radio" wire:model="mretornado" name="mretornado"
                            value="1" {{ old('mretornado') === '1' ? 'checked' : '' }}>
                        <span class="ml-2">{{ __('Yes') }}</span>
                    </label>

                    <label class="inline-flex items-center">
                        <input type="radio" class="form-radio" wire:model="mretornado" name="mretornado"
                            value="0" {{ old('mretornado') === '0' ? 'checked' : '' }}>
                        <span class="ml-2">{{ __('No') }}</span>
                    </label>
                </div>
                @error('mretornado')
                    <small class="text-red-600">{{ $message }}</small>
                @enderror
            </div>
            @if ($mretornado == 1)
                <div class="mt-4">
                    <x-jet-label for="mision" value="{{ __('Qué misión serviste y en qué año?') }}"
                        class="font-black" />
                    <x-jet-input id="mision" class="block mt-1 w-full" type="text" wire:model="mision"
                        name="mision" required />
                    @error('mision')
                        <small class="text-red-600">{{ $message }}</small>
                    @enderror
                </div>
            @endif
            <div class="mt-4">
                <x-jet-label for="recomendacion_vigente"
                    value="{{ __('Posees una recomendación vigente para el Templo?') }}" class="font-black" />
                <div class="mt-2 space-x-4">
                    <label class="inline-flex items-center">
                        <input type="radio" class="form-radio" wire:model="recomendacion_vigente"
                            name="recomendacion_vigente" value="1"
                            {{ old('recomendacion_vigente') === '1' ? 'checked' : '' }}>
                        <span class="ml-2">{{ __('Yes') }}</span>
                    </label>

                    <label class="inline-flex items-center">
                        <input type="radio" class="form-radio" wire:model="recomendacion_vigente"
                            name="recomendacion_vigente" value="0"
                            {{ old('recomendacion_vigente') === '0' ? 'checked' : '' }}>
                        <span class="ml-2">{{ __('No') }}</span>
                    </label>
                </div>
                @error('recomendacion_vigente')
                    <small class="text-red-600">{{ $message }}</small>
                @enderror
            </div>
            @if ($recomendacion_vigente == 1)
                <div class="mt-4">
                    <x-jet-label for="vencimiento_recomendacion"
                        value="{{ __('Cuándo vence tu recomendación para el templo?') }}" class="font-black" />
                    <div class="grid grid-cols-12 gap-4">
                        <div class="col-span-12 mt-3 sm:col-span-6">
                            <x-jet-label for="mes_recomendacion" value="{{ __('Month') }}" class="font-black" />
                            {!! Form::select(
                                'mes_recomendacion',
                                [
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
                                ],
                                null,
                                [
                                    'class' =>
                                        'border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-full',
                                    'placeholder' => '-- Seleccione --',
                                    'wire:model' => 'mes_recomendacion',
                                    'required' => ''
                                ],
                            ) !!}
                            @error('mes_recomendacion')
                                <small class="text-red-600">{{ $message }}</small>
                            @enderror

                        </div>
                        <div class="col-span-12 mt-3 sm:col-span-6">
                            <x-jet-label for="anio_recomendacion" value="{{ __('Year') }}" class="font-black" />
                            <x-jet-input id="anio_recomendacion" class="block mt-1 w-full" type="number"
                                wire:model="anio_recomendacion" name="anio_recomendacion" required
                                autocomplete="anio_recomendacion" />
                            @error('anio_recomendacion')
                                <small class="text-red-600">{{ $message }}</small>
                            @enderror

                        </div>
                    </div>
                </div>
            @endif
            <x-jet-section-border />
            <div class="mt-4">
                <x-jet-label for="estudios" value="{{ __('Cuéntanos qué estudios tienes?') }}" class="font-black" />
                <x-jet-input id="estudios" class="block mt-1 w-full" type="text" wire:model="estudios"
                    name="estudios" required />
                @error('estudios')
                    <small class="text-red-600">{{ $message }}</small>
                @enderror

            </div>
            <div class="mt-4">
                <x-jet-label for="ocupacion" value="{{ __('En qué trabajas o a qué te dedicas?') }}"
                    class="font-black" />
                <x-jet-input id="ocupacion" class="block mt-1 w-full" type="text" wire:model="ocupacion"
                    name="ocupacion" required />
                @error('ocupacion')
                    <small class="text-red-600">{{ $message }}</small>
                @enderror
            </div>
            <div class="mt-4">
                <x-jet-label for="primeros_auxilios" value="{{ __('Conoces de primeros auxilios?') }}"
                    class="font-black" />
                <div class="mt-2 space-x-4">
                    <label class="inline-flex items-center">
                        <input type="radio" class="form-radio" wire:model="primeros_auxilios"
                            name="primeros_auxilios" value="1"
                            {{ old('primeros_auxilios') === '1' ? 'checked' : '' }}>
                        <span class="ml-2">{{ __('Yes') }}</span>
                    </label>

                    <label class="inline-flex items-center">
                        <input type="radio" class="form-radio" wire:model="primeros_auxilios"
                            name="primeros_auxilios" value="0"
                            {{ old('primeros_auxilios') === '0' ? 'checked' : '' }}>
                        <span class="ml-2">{{ __('No') }}</span>
                    </label>
                </div>
                @error('primeros_auxilios')
                    <small class="text-red-600">{{ $message }}</small>
                @enderror
            </div>
            <x-jet-section-border />
            <div class="mt-4" wire:ignore>
                {!! Form::label('imgperfil', 'Tómate un selfie ;)', ['class' => 'font-black']) !!}
                <div class="grid grid-cols-12 gap-4">
                    <div class="col-span-12 mt-3 sm:col-span-12">
                        <label class="custom-file-label" for="imgperfil">
                            <img id="img-show" class="rounded-full object-cover m-auto" src="{{config('app.url')}}/img/user-pfj.png" alt="" width="148" height="148"
                                style="width:148px!important;height: 148px!important;"
                            >
                        </label>
                    </div>
                    <div class="col-span-12 mt-3 sm:col-span-12">
                        <div class="custom-file" style="display: none">
                            {!! Form::file('imgperfil', ['class' => 'custom-file-input', 'accept' => 'image/*', "wire:model.defer" => "imgperfil"]) !!}
                        </div>
                    </div>
                </div>
            </div>
            @error('imgperfil')
                <small class="text-red-600">{{ 'Tu foto es requerida.' }}</small>
                <small class="text-red-600">{{ $message }}</small>
                @enderror
                {{-- {{$imgperfil}} --}}
            @if ($disabled_enviar)
                <small class="text-green-600 font-black">{{ 'Cargando...' }}</small>
            @endif
            <div class="flex items-center justify-end mt-4">
                <button
                    id="enviar"
                    class='inline-flex items-center px-4 py-2 
                    bg-red40-pfj 
                    border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest 
                    hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 
                    focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150'
                    type="submit"  {{ $disabled_enviar }}>
                    {{ __('Enviar') }}
                </button>
            </div>
        </form>
    @else
        <div class="bg-green-500 rounded-md text-white p-2">
            Gracias por unirte esta nueva aventura llamada <b>PFJ Lima Norte 2024!</b>
        </div>
    @endif
</div>
