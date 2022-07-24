<x-app-layout>
    {{-- programa_id="{{ $programa->id }}" --}}

    <x-slot name="header">
        <h2 class="font-semibold text-3xl leading-tight text-white">
            {{ $participante->programa->nombre }}
        </h2>
    </x-slot>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6">
                    @if (session('info'))
                        <div
                            class=" max-w-7xl mx-auto sm:px-6 lg:px-8 p-2 bg-green-400 mt-6 rounded-sm text-white w-full">
                            <div>
                                {{ session('info') }}
                            </div>
                            {{-- <div class="mt-3">
                                <a href="{{ route('admin.pdf.ingreso_participante', $participante) }}" target="_blank"
                                    class="p-2 bg-red-400 mt-6 rounded-sm text-white"><i class="fas fa-file-pdf"></i>
                                    Ficha de ingreso</a>
                            </div> --}}
                        </div>
                    @endif

                    <h1 class="my-2 text-2xl">Editar datos del participante</h1>
                    <x-jet-validation-errors class="mb-4" />
                    <div>
                        {!! Form::model($participante, ['route' => ['st.participantes.update', $participante], 'method' => 'put']) !!}

                        @include('student.participante.partials.form')

                        @if (isset($participante->participanteCompania))
                            <div class="col-span-12 sm:col-span-4 mt-3">
                                {!! Form::label('compania', 'Compañia', [
                                    'class' => 'block font-medium text-sm text-gray-700',
                                    ]) !!}
                                {!! Form::select('compania', $participante->programa->companias()->pluck('numero', 'id'), null, [
                                    'class' =>
                                        'border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-full',
                                        'placeholder' => 'Seleccione',
                                ]) !!}
                                @error('compania')
                                    <small class="text-red-600">{{ $message }}</small>
                                @enderror
                            </div>
                        @endif

                        {!! Form::submit('Actualizar Participante', [
                            'class' => 'p-2 bg-blue-400 mt-6 rounded-md text-white cursor-pointer',
                        ]) !!}
                        <a href="{{ route('admin.pdf.ingreso_participante', $participante) }}" target="_blank"
                            class="p-2 bg-red-400 mt-6 rounded-sm text-white"><i class="fas fa-file-pdf"></i> Ficha de
                            ingreso</a>
                        {!! Form::close() !!}

                    </div>
                </div>
            </div>

        </div>

        <script src="{{ config('app.url') }}/tw-elements/dist/js/index.min.js"></script>
</x-app-layout>
