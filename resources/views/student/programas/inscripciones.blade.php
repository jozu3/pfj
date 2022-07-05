<x-app-layout programa_id="{{ $programa->id }}">

    <x-slot name="header">
        <h2 class="font-semibold text-3xl leading-tight text-white">

        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6">
                    <!-- This example requires Tailwind CSS v2.0+ -->
                    <div class="flex flex-col">
                        Hola bienvenidos.!
                    </div>

                </div>
            </div>
        </div>
    </div>

    <script src="{{ config('app.url') }}/tw-elements/dist/js/index.min.js"></script>
</x-app-layout>
