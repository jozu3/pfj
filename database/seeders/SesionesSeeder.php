<?php

namespace Database\Seeders;

use App\Models\Barrio;
use App\Models\Contacto;
use App\Models\Funcione;
use App\Models\Inscripcione;
use App\Models\Personale;
use App\Models\Pfj;
use App\Models\Programa;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class SesionesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if(!Pfj::where('nombre', 'PFJ 2022')->count())
        {
            $pfj = Pfj::create([
                'nombre' => 'PFJ 2022',
                'lema' => '“Confía en Jehová con todo tu corazón, y no te apoyes en tu propia prudencia. Reconócelo en todos tus caminos, y él enderezará tus veredas”. PROVERBIOS 3:5–6',
                'lema_abreviado' => 'Confía en Jehová',
                'estado' => 1
            ]);
        } else {
            $pfj = Pfj::where('nombre', 'PFJ 2022')->first();
        }

        if(!Programa::where('nombre', 'PFJ Lima Norte Sesión 1')->count()){
            $pln1 = Programa::create([
                'pfj_id' => $pfj->id,
                'nombre' => 'PFJ Lima Norte Sesión 1',
                'resena_matrimonio' => '¡¡¡¡¡Bienvenidos!!!!! queridos jóvenes!!! 
                                        <br><br>
                                        Somos el matrimonio Lino.  Nos sentimos profundamente bendecidos por la oportunidad de servirles como matrimonio director en la Sesión 01 Perú Lima Norte.
                                        <br><br>
                                        Sabemos que el PFJ es un programa inspirado, les invitamos a disfrutar de una semana inolvidable en la que viviremos momentos únicos que fortalecerán sus testimonios y les acercarán al Salvador. Esperamos puedan prepararse para vivir momentos espirituales y de diversión, conocerán a otros jóvenes que al igual que ustedes se esfuerzan por vivir el evangelio y mantenerse firmes a la barra de hierro y lo más importante la compañía del Espíritu Santo.
                                        <br><br>
                                        Les invitamos a inscribirse, continuar participando de seminario, aprender la canción y meditar en el lema para los jóvenes de este año 2022.
                                        <br><br>
                                        ¡Esperamos verlos pronto!',
                'fecha_inicio' => '2022-07-25',
                'fecha_fin' => '2022-07-29',
                'estado' => 0
            ]);
        }

        if(!Programa::where('nombre', 'PFJ Lima Norte Sesión 2')->count()){

            $pln2 = Programa::create([
                'pfj_id' => $pfj->id,
                'nombre' => 'PFJ Lima Norte Sesión 2',
                'resena_matrimonio' => 'Amados jóvenes, 
                                        <br><br>
                                        Estamos muy emocionados por vivir junto a ustedes de una extraordinaria semana en este PFJ 2022, el cual es inspirado por el Señor para bendecir de forma especial y personal a cada uno de ustedes. 
                                        <br><br>
                                        Este año nuestro lema es “Confía en Jehová”, y con esa confianza puesta en Él podemos decirles que estamos seguros de que juntos podremos sentir el amor de nuestro Salvador con mucha mas fuerza.
                                        <br><br>
                                        ¡¡Los amamos mucho y esperamos verlos pronto!!',
                'fecha_inicio' => '2022-08-01',
                'fecha_fin' => '2022-08-05',
                'estado' => 0
            ]);
        }
        if(!Programa::where('nombre', 'PFJ Lima Norte Sesión 3')->count()){

            $pln3 = Programa::create([
                'pfj_id' => $pfj->id,
                'nombre' => 'PFJ Lima Norte Sesión 3',
                'resena_matrimonio' => 'Amados jóvenes y jovencitas queremos recordarles que ustedes forman parte de la generación más valiosa que ha tenido la humanidad; Ustedes fueron preservados por miles de años para venir a esta tierra, en esta época y llevar a cabo la obra más importante que tiene NUESTRO PADRE CELESTIAL antes de la SEGUNDA VENIDA DE NUESTRO SALVADOR JESUCRISTO. 
                                        <br><br>
                                        Es por esta razón que NUESTRO PADRE CELESTIAL desea que puedan tener EXPERIENCIAS ESPIRITUALES que les permitan prepararse tanto física, social, emocional y espiritualmente para que puedan cumplir con su MISIÓN CELESTIAL.
                                        <br><br>
                                        Es por ello que mi amada esposa, yo, el matrimonio Pérez y todo un gran equipo de consejeros JAS nos estamos preparando para llevar a cabo la sesión 03 C.C. Lima Norte del PFJ 2022.
                                        <br><br>
                                        Serán 6 días maravillosos que recordarás por el resto de tu vida, TE LO GARANTIZAMOS
                                        <br><br>
                                        ESTACAS A PARTICIPAR:<br>
                                        Lima Perú Begonias Stake<br>
                                        Lima Perú Canto Grande Stake<br>
                                        Lima Perú Wiesse Stake<br>
                                        Lima Perú Magnolias Stake',
                'fecha_inicio' => '2022-08-01',
                'fecha_fin' => '2022-08-05',
                'estado' => 0
            ]);
            Funcione::create([
                'descripcion' => 'Audiovisual',
                'programa_id' => $pln3->id
            ]);

            Funcione::create([
                'descripcion' => 'Logística',
                'programa_id' => $pln3->id
            ]);
        }




    }
}
