<x-app-layout programa_id="{{ $programa->id }}">

    <x-slot name="header">
        <h2 class="font-semibold text-3xl leading-tight text-white">

        </h2>
    </x-slot>
    {{-- <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6">
                    
                    <div class="flex flex-col">
                        Hola bienvenidos.!
                    </div>

                </div>
            </div>
        </div>
    </div> --}}
    <div class="bg-search-participante w-full h-screen bg-cover"
        style="background-image: url('{{ config('app.url', 'http://localhost/pfj/public') . '/img/portadalow.jpg' }}')">
        <div class="flex justify-end items-center h-full">
            <div class="w-2/4">
                @livewire('student.bienvenida', ['programa' => $programa], key($programa->id))
            </div>

        </div>
    </div>
    {{-- <img src="{{ config('app.url', 'http://localhost/pfj/public').'/img/portada.jpg' }}" alt=""> --}}



    <script src="{{ config('app.url') }}/tw-elements/dist/js/index.min.js"></script>
</x-app-layout>
