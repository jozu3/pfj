<x-app-layout>
    <x-slot name="header"></x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6">
                    <h1 class="text-3xl"><i class="fas fa-book-reader"></i>&nbsp;Mis lecturas</h1>
                    <div class="border-2 grid grid-cols-4 text-center">
                        {{-- <div class=""> 80 / 100%</div> --}}
                    </div>                    

                    @livewire('student.create-lectura', ['programa' => $programa])


                </div>
            </div>
        </div>
    </div>
</x-app-layout>
