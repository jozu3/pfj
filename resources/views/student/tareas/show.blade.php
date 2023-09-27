<x-app-layout programa_id="{{ $tarea->programa->id }}">
    <x-slot name="header">
        <h2 class="font-semibold text-3xl leading-tight text-white">
            Mi Tarea
        </h2>
    </x-slot>
    
    @livewire('student.tarea-comentarios', ['tarea' => $tarea], key(auth()->user()->id))

</x-app-layout>
