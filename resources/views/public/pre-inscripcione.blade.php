<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <div id="inicio" class="pt-16">
            </div>
            <div class="text-center">
                <x-jet-authentication-card-logo />
            </div>
            <div class="text-center mt-4">
                <img src="{{ config('ap-url') }}/img/fsy2026/fsy2026.png" class="m-auto" width="30%" alt="">
            </div>
            {{-- <div class="text-center" style='color:#2d999b;font-family: system-ui;'>
                <span class="text-5xl">pfj <b>2024</b></span>
                <br>
                <span class="text-xl">Lima Norte</span>
            </div> --}}
        </x-slot>

        @livewire('public.pre-inscripcion-consejeros', key($user->id))
        <div id="inicio" class="pb-16">
        </div>
        <div class="mt-4 text-center text-sm text-gray-600">
            Sitio web no oficial de La Iglesia.
        </div>

    </x-jet-authentication-card>
    <style>
        * {
            scroll-behavior: smooth;
        }
    </style>
    <script>
        var temp_image = ''
        var temp_image_rec = ''
        let stateCheck = setInterval(() => {
            if (document.readyState === 'complete') {
                clearInterval(stateCheck);
                // document ready
                console.log("ready!");
                document.getElementById("inicio").focus();
                document.getElementById("inicio").scrollIntoView();


                document.getElementById('imgperfil').addEventListener('change', cambiarImagen);
                document.getElementById('imgrec').addEventListener('change', cambiarImagenRecTemplo);

                function cambiarImagen(event) {
                    console.log('changee');
                    document.getElementById("img-show").setAttribute('src',
                        '{{ config('app.url') }}/img/user-pfj.png');
                    var file = event.target.files[0];

                    var reader = new FileReader();
                    reader.onload = (event) => {
                        temp_image = event.target.result;
                    };
                    reader.readAsDataURL(file);

                    Livewire.on('imagen_cargada', () => {
                        document.getElementById("img-show").setAttribute('src', temp_image);
                    })
                }

                function cambiarImagenRecTemplo(event) {
                    console.log('changee');
                    document.getElementById("rec-img-show").style.opacity = "0.5"
                    document.getElementById("rec-img-show").setAttribute('src',
                        '{{ config('app.url') }}/img/rec_templo2.jpg');
                    var file = event.target.files[0];

                    var reader = new FileReader();
                    reader.onload = (event) => {
                        temp_image_rec = event.target.result;
                    };
                    reader.readAsDataURL(file);

                    Livewire.on('rec_imagen_cargada', () => {
                        document.getElementById("rec-img-show").setAttribute('src', temp_image_rec);
                        document.getElementById("rec-img-show").style.opacity = "1"
                    })
                }

            }
        }, 100);
    </script>
</x-guest-layout>
