<div wire:init="loadFormulario">
    <div>
        <h2 id="titulo" class="text-2xl text-center font-black text-gray-900">
            {{ 'Ficha de preinscripción de consejeros' }}
        </h2>
        <x-jet-section-border />
        <div class="md:col-span-1 @if ($requisitos) hidden @endif">
            <div class="px-4 sm:px-0">

                <h4>Consejeros</h4>
                <div class="text-justify">
                    <p class="mt-1 text-gray-600">
                        Todos los consejeros de FSY deben tener un fuerte testimonio del Salvador y de Su evangelio
                        restaurado y estar preparados para promover principios que concuerden con la doctrina de la
                        Iglesia.
                        Los consejeros jóvenes adultos solteros desempeñan una función fundamental en el éxito de las
                        conferencias FSY y ejercen una gran influencia en los jóvenes. Por lo tanto, el servir como
                        consejero de FSY debe considerarse una oportunidad para fortalecer a los jóvenes, en lugar de
                        principalmente una oportunidad de ser fortalecido.
                        <br>
                        <br>
                        Requisitos:
                        <br>• Ser miembro de La Iglesia de Jesucristo de los Santos de los Últimos Días que conserva
                        su plena condición de miembro, como lo demuestra la aprobación de un miembro de su
                        obispado.
                        <br>• Ser capaz de servir como mentor entre sus compañeros y líder de los jóvenes participantes
                        y
                        de otros miembros del personal.
                        <br>• Ajustarse a las pautas de edad, según lo establecido por la Presidencia de Área.
                        <br>• No estar casado actualmente y no tener personas dependientes en el hogar (aunque algunas
                        Áreas podrían optar por usar a matrimonios jóvenes, según lo apruebe la Presidencia de
                        Área).
                        <br>• Pasar la preselección de solicitante, aprobada por el asesor legal de Área.
                        <br>• Completar la capacitación de la Iglesia para la protección de los jóvenes y cualquier otra
                        capacitación requerida por la Presidencia de Área.
                        <br>• Ejemplificar las siguientes características:
                    <ul class="list-decimal">
                        <li class="ml-7">Buenas aptitudes organizativas y de administración del tiempo.</li>
                        <li class="ml-7">Aptitud para el liderazgo.</li>
                        <li class="ml-7">Buen juicio.</li>
                        <li class="ml-7">Habilidades comunicativas y don de gentes.</li>
                        <li class="ml-7">Automotivación.</li>
                        <li class="ml-7">Capacidad para resolver problemas.</li>
                        <li class="ml-7">Enseñable.</li>
                        <li class="ml-7">Responsable de sus actos.</li>
                        <li class="ml-7">Con facilidad para adaptarse.</li>
                        <li class="ml-7">Confiable.</li>
                        <li class="ml-7">Positivo.</li>
                        <li class="ml-7">Dispuesto a recibir y actuar de acuerdo con los comentarios y sugerencias y
                            la orientación de los supervisores</li>
                    </ul>
                    <br>
                    <br>
                    Responsabilidades:
                    <br>
                    <br>• Garantizar la seguridad física y promover el bienestar espiritual de cada participante que
                    asista a FSY, en particular, los participantes de su grupo asignado.
                    <br>• Enseñar y dirigir de manera eficaz análisis formales e informales que concuerden con la
                    doctrina de La Iglesia de Jesucristo de los Santos de los Últimos Días.
                    <br>• Actuar como líder ejemplar, modelo a seguir y mentor para los jóvenes participantes y
                    compañeros consejeros.
                    <br>• Mantener todas las interacciones con los jóvenes dentro de las pautas de la capacitación
                    para la protección de los jóvenes.
                    <br>• Interactuar y motivar a los jóvenes participantes de manera amable y edificante.
                    <br>• Ayudar a los jóvenes a seguir las normas de conducta y abordar la conducta inapropiada de
                    manera amable y profesional.
                    <br>• Trabajar bien con un consejero compañero y contribuir como miembro del equipo.
                    <br>• Participar enérgica y activamente con los jóvenes; esto incluye poder llevar a cabo todos sus
                    deberes, caminar por largos períodos durante el día y participar en actividades físicas, incluso,
                    entre otras, jugar a juegos, subir y bajar escaleras, correr, saltar y bailar.
                    <br>• Demostrar la salud mental y la estabilidad emocional necesarias para participar con
                    seguridad, ser responsables de los participantes y cumplir con sus deberes eficazmente en
                    situaciones estresantes.
                    <br>• Leer y estudiar el manual para el personal de FSY antes de su primera semana de servicio y
                    continuar estudiándolo a lo largo de su servicio.
                    <br>• Obedecer los principios que se enseñan en Para la Fortaleza de la Juventud: Una guía para
                    tomar decisiones.
                    <br>
                    <i>
                        Pag. 20-22 (PFJ GUÍA PARA LA PLANIFICACIÓN DE CONFERENCIAS)
                    </i>
                    </p>
                </div>

            </div>
            <h2 class=" my-4">Cumples con los requisitos?</h2>
        </div>
        <div class="md:col-span-1 @if (!$requisitos) hidden @endif ">
            @if (!$result)
                <jet-validation-errors class="mb-4" />
                <form wire:submit.prevent="guardar">
                    @csrf
                    <div class="grid grid-cols-12 gap-4">
                        <div class="col-span-12 mt-3 sm:col-span-6">
                            <x-jet-label for="nombres" value="{{ __('Name') }}" class="font-black" />
                            <x-jet-input id="nombres" class="block mt-1 w-full" type="text" name="nombres"
                                wire:model="nombres" required autofocus autocomplete="given-name" />
                            @error('apellidos')
                                <small class="text-red-600">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-span-12 mt-3 sm:col-span-6">
                            <x-jet-label for="apellidos" value="{{ __('Last Name') }}" class="font-black" />
                            <x-jet-input id="apellidos" class="block mt-1 w-full" type="text" wire:model="apellidos"
                                required autocomplete="family-name" />
                            @error('apellidos')
                                <small class="text-red-600">{{ $message }}</small>
                            @enderror

                        </div>
                    </div>
                    <div class="mt-4">
                        <x-jet-label for="email" value="{{ __('Email') }}" class="font-black" />
                        <x-jet-input id="email" class="block mt-1 w-full" type="email" wire:model="email"
                            name="email" required />
                        @error('email')
                            <small class="text-red-600">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="mt-4">
                        <x-jet-label for="telefono" value="{{ __('Phone') }}" class="font-black" />
                        <x-jet-input id="telefono" class="block mt-1 w-full" type="number" min="0"
                            wire:model="telefono" name="telefono" required />
                        @error('telefono')
                            <small class="text-red-600">{{ $message }}</small>
                        @enderror

                    </div>
                    <div class="mt-4">
                        <x-jet-label for="fecnac" value="{{ __('Fecha de nacimiento') }}" class="font-black" />
                        <x-jet-input id="fecnac" class="block mt-1 w-full" type="date" wire:model="fecnac"
                            name="fecnac" required />
                        @error('fecnac')
                            <small class="text-red-600">{{ $message }}</small>
                        @enderror

                    </div>
                    <div class="mt-4">
                        <x-jet-label for="genero" value="{{ __('Género') }}" class="font-black" />
                        <div class="mt-2 space-x-4">
                            <label class="inline-flex items-center">
                                <input type="radio" class="form-radio" wire:model="genero" name="genero"
                                    value="Hombre">
                                <span class="ml-2">{{ __('Male') }}</span>
                            </label>

                            <label class="inline-flex items-center">
                                <input type="radio" class="form-radio" wire:model="genero" name="genero"
                                    value="Mujer">
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
                                <x-jet-label for="otro_barrio" value="{{ __('De qué barrio eres?') }}"
                                    class="font-black" />
                                <x-jet-input id="otro_barrio" class="block mt-1 w-full" type="text"
                                    wire:model="otro_barrio" name="otro_barrio" required />
                                @error('otro_barrio')
                                    <small class="text-red-600">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-span-12 mt-3 sm:col-span-6">
                                <x-jet-label for="otra_estaca" value="{{ __('A qué estaca pertenece?') }}"
                                    class="font-black" />
                                <x-jet-input id="otra_estaca" class="block mt-1 w-full" type="text"
                                    wire:model="otra_estaca" name="otra_estaca" required />
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
                        <x-jet-label for="telefono_obispo" value="{{ __('Teléfono de tu obispo') }}"
                            class="font-black" />
                        <x-jet-input id="telefono_obispo" class="block mt-1 w-full" type="number" min="0"
                            wire:model="telefono_obispo" name="telefono_obispo" required />
                        @error('telefono_obispo')
                            <small class="text-red-600">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="mt-4">
                        <x-jet-label for="email_obispo" value="{{ __('Email de tu obispo') }}" class="font-black" />
                        <x-jet-input id="email_obispo" class="block mt-1 w-full" type="email"
                            wire:model="email_obispo" name="email_obispo" />
                        @error('email_obispo')
                            <small class="text-red-600">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="mt-4">
                        <x-jet-label for="llamamiento" value="{{ __('Cuál es tu llamamiento?') }}"
                            class="font-black" />
                        <x-jet-input id="llamamiento" class="block mt-1 w-full" type="text"
                            wire:model="llamamiento" name="llamamiento" required />
                        @error('llamamiento')
                            <small class="text-red-600">{{ $message }}</small>
                        @enderror

                    </div>
                    <div class="mt-4">
                        <x-jet-label for="asiste_instituto" value="{{ __('Asistes a institutos?') }}"
                            class="font-black" />
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
                            <x-jet-input id="instituto" class="block mt-1 w-full" type="text"
                                wire:model="instituto" name="instituto" required />
                            @error('instituto')
                                <small class="text-red-600">{{ $message }}</small>
                            @enderror
                        </div>
                    @endif
                    <div class="mt-4">
                        <x-jet-label for="mretornado" value="{{ __('Eres misionero retornado?') }}"
                            class="font-black" />
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
                            value="{{ __('Posees una recomendación vigente para el Templo?') }}"
                            class="font-black" />
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
                                value="{{ __('Cuándo vence tu recomendación para el templo?') }}"
                                class="font-black" />
                            <div class="grid grid-cols-12 gap-4">
                                <div class="col-span-12 mt-3 sm:col-span-6">
                                    <x-jet-label for="mes_recomendacion" value="{{ __('Month') }}"
                                        class="font-black" />
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
                                            'required' => '',
                                        ],
                                    ) !!}
                                    @error('mes_recomendacion')
                                        <small class="text-red-600">{{ $message }}</small>
                                    @enderror

                                </div>
                                <div class="col-span-12 mt-3 sm:col-span-6">
                                    <x-jet-label for="anio_recomendacion" value="{{ __('Year') }}"
                                        class="font-black" />
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
                    <div class="mt-4" wire:ignore>
                        {!! Form::label('imgrec', 'Foto de tu recomendación vigente(desdoblada, que se bea ambas caras)', ['class' => 'font-black']) !!}
                        <div class="grid grid-cols-12 gap-4">
                            <div class="col-span-12 mt-3 sm:col-span-12" style="position: relative">
                                <label class="custom-file-label" for="imgrec" wire:loading.class="opacity-50"
                                    wire:target="imgrec">
                                    <img id="rec-img-show" class="object-cover m-auto"
                                        src="{{ config('app.url') }}/img/rec_templo2.jpg" alt="" style="width:200px!important;height: 151px!important;opacity:0.4">
                                </label>
                                <div role="status"
                                    class="absolute -translate-x-1/2 -translate-y-1/2 top-0 left-0 items-center justify-center w-full h-full"
                                    wire:loading.flex wire:target="imgrec">
                                    <svg aria-hidden="true"
                                        class="w-8 h-8 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600"
                                        style="fill: #e10f5a;" viewBox="0 0 100 101" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                                            fill="currentColor" />
                                        <path
                                            d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                                            fill="currentFill" />
                                    </svg>
                                    <span class="sr-only">Loading...</span>
                                </div>
                            </div>
                            <div class="col-span-12 mt-3 sm:col-span-12">
                                <div class="custom-file" style="display: none">
                                    {!! Form::file('imgrec', [
                                        'class' => 'custom-file-input',
                                        'accept' => 'image/*',
                                        'wire:model.defer' => 'imgrec',
                                    ]) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    @error('imgrec')
                        <small class="text-red-600">{{ 'Tu foto es requerida.' }}</small>
                        <small class="text-red-600">{{ $message }}</small>
                    @enderror
                    {{-- {{$imgperfil}} --}}
                    <div class="text-green-600" wire:loading wire:target="imgrec">
                        Estamos cargando tu foto...
                    </div>
                    <x-jet-section-border />
                    <div class="mt-4">
                        <x-jet-label for="estudios" value="{{ __('Cuéntanos qué estudios tienes?') }}"
                            class="font-black" />
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
                            <div class="col-span-12 mt-3 sm:col-span-12" style="position: relative">
                                <label class="custom-file-label" for="imgperfil" wire:loading.class="opacity-50"
                                    wire:target="imgperfil">
                                    <img id="img-show" class="rounded-full object-cover m-auto"
                                        src="{{ config('app.url') }}/img/user-pfj.png" alt="" width="160"
                                        height="160" style="width:148px!important;height: 148px!important;">
                                </label>
                                <div role="status"
                                    class="absolute -translate-x-1/2 -translate-y-1/2 top-0 left-0 items-center justify-center w-full h-full"
                                    wire:loading.flex wire:target="imgperfil">
                                    <svg aria-hidden="true"
                                        class="w-8 h-8 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600"
                                        style="fill: #e10f5a;" viewBox="0 0 100 101" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                                            fill="currentColor" />
                                        <path
                                            d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                                            fill="currentFill" />
                                    </svg>
                                    <span class="sr-only">Loading...</span>
                                </div>
                            </div>
                            <div class="col-span-12 mt-3 sm:col-span-12">
                                <div class="custom-file" style="display: none">
                                    {!! Form::file('imgperfil', [
                                        'class' => 'custom-file-input',
                                        'accept' => 'image/*',
                                        'wire:model.defer' => 'imgperfil',
                                    ]) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    @error('imgperfil')
                        <small class="text-red-600">{{ 'Tu foto es requerida.' }}</small>
                        <small class="text-red-600">{{ $message }}</small>
                    @enderror
                    {{-- {{$imgperfil}} --}}
                    <div class="text-green-600" wire:loading wire:target="imgperfil">
                        Estamos cargando tu foto...
                    </div>
                    <div class="flex items-center justify-end mt-4">
                        <button id="enviar"
                            class='inline-flex items-center px-4 py-2 
                        bg-red40-pfj 
                        border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest 
                        hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 
                        focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150'
                            type="submit" wire:loading.attr="disabled" wire:target="imgperfil">
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
        <div class="md:col-span-1 mt-6">
            <button wire:click="$toggle('requisitos')"
                class="px-4 py-2 bg-red40-pfj text-center w-full
                    border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest 
                    hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 
                    focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
                @if (!$requisitos)
                    Continuar, cumplo los requisitos
                @else
                    Ver requisitos
                @endif
            </button>
        </div>
    </div>
    @if ($requisitos)
        <script>
            document.getElementById("titulo").scrollIntoView();
            document.getElementById("nombres").focus();
            document.addEventListener('livewire:load', function() {})
        </script>
    @endif
</div>
