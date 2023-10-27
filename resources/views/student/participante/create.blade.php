<x-app-layout>
    {{-- programa_id="{{ $programa->id }}" --}}

    <x-slot name="header">
        <h2 class="font-semibold text-3xl leading-tight text-white">
            {{ \App\Models\Programa::where('id',$_GET['programa_id'])->first()->nombre }}
        </h2>
    </x-slot>
    
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6">
                    @if (session('info'))
                        <div class="p-2 bg-green-400 mt-6 rounded-sm text-white w-full">
                            {{ session('info') }}
                        </div>
                    @endif
                    <x-jet-validation-errors class="mb-4" />

                    <h1 class="my-2 text-2xl">Crear nuevo participante</h1>
                    <div>
                        {!! Form::open(['route' => 'st.participantes.store']) !!}
                        {!! Form::hidden('programa_id', $_GET['programa_id']) !!}

                        @include('student.participante.partials.form')

                        {!! Form::submit('Crear inscripción', ['class' => 'p-2 bg-blue-400 mt-6 rounded-md text-white cursor-pointer']) !!}
                        {!! Form::close() !!}

                    </div>
                </div>
            </div>

        </div>

        <script src="{{ config('app.url') }}/tw-elements/dist/js/index.min.js"></script>
</x-app-layout>
