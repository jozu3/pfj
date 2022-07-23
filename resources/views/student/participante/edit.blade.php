<x-app-layout>
    {{-- programa_id="{{ $programa->id }}" --}}

    <x-slot name="header">
        <h2 class="font-semibold text-3xl leading-tight text-white">
            {{ $participante->programa->nombre }}
        </h2>
    </x-slot>
    
    @if (session('info'))
        <div class=" max-w-7xl mx-auto sm:px-6 lg:px-8 p-2 bg-green-400 mt-6 rounded-sm text-white w-full">
            <div>
                {{ session('info') }}
            </div>
            <div>
                <a href="{{ route('admin.pdf.ingreso_participante', $participante) }}" target="_blank" class="p-2 bg-red-400 mt-6 rounded-sm text-white">pdf</a>
            </div>
        </div>
    @endif

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6">
                    <h1 class="my-2 text-2xl">Editar datos del participante</h1>
                    <div>
                        {!! Form::model($participante, ['route' => ['st.participantes.update', $participante], 'method' => 'put']) !!}

                        @include('student.participante.partials.form')

                        {!! Form::submit('Actualizar Participante', ['class' => 'p-2 bg-blue-400 mt-6 rounded-md text-white cursor-pointer']) !!}
                        <a href="{{ route('admin.pdf.ingreso_participante', $participante) }}" target="_blank" class="p-2 bg-red-400 mt-6 rounded-sm text-white"><i class="fas fa-file-pdf"></i> Ficha de ingreso</a>
                        {!! Form::close() !!}

                    </div>
                </div>
            </div>

        </div>

        <script src="{{ config('app.url') }}/tw-elements/dist/js/index.min.js"></script>
</x-app-layout>
