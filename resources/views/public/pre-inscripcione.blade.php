<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <x-jet-authentication-card-logo />
        </x-slot>

        <x-jet-validation-errors class="mb-4" />
        <div class="md:col-span-1">
            <div class="px-4 sm:px-0">
                <h2 class="text-lg font-medium text-gray-900">{{ 'Ficha de preinscripción de consejeros PFJ Lima Norte 2024' }}</h2>
                <x-jet-section-border />
                <h4>Consejeros</h4>
                <p class="mt-1 text-sm text-gray-600">
                    Los consejeros son la clave del éxito de la conferencia PFJ. Por medio de sus ejemplos, liderazgo
                    y enseñanzas, los consejeros siguen el llamado del Salvador para alzar “vuestra luz para que brille
                    ante el mundo. He aquí, yo soy la luz que debéis sostener en alto: aquello que me habéis visto
                    hacer” (3 Nefi 18:24). Cada consejero supervisa a un grupo del consejero compuesto de 8 a 10
                    jóvenes y está con ellos en todo momento. Un consejero debe:
                    <br>
                    1. Ser ex misionero (es un requisito para los varones y una preferencia para las mujeres).
                    <br>
                    2. Tener por lo menos 20 años de edad y madurez espiritual.
                    <br>
                    3. Demostrar un testimonio del evangelio restaurado de Jesucristo por medio de la dignidad
                    para entrar al templo y el servicio en la Iglesia.
                    <br>
                    4. Ser divertido, amoroso, ver la vida con entusiasmo y no enojarse con facilidad.
                    <br>
                    5. Enseñar a los jóvenes y relacionarse con ellos por medio de la guía del Espíritu.
                    <br>
                    <br>
                    <i>
                        Pag. 17 (PFJ Guia para la Planificacion)
                    </i>
                </p>
            </div>
        </div>
        <x-jet-section-border />
        
        @livewire('public.pre-inscripcion-consejeros')
        
    </x-jet-authentication-card>
</x-guest-layout>
