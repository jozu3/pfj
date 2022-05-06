<?php

namespace Database\Factories;

use App\Models\Inscripcione;
use App\Models\Personale;
use App\Models\Contacto;
use App\Models\User;
use App\Models\Grupo;
use Illuminate\Database\Eloquent\Factories\Factory;

class InscripcioneFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Inscripcione::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $contacto = Contacto::all()->random();
        $personale_existe = Personale::where('contacto_id', '=', $contacto->id)->get();

        if (count($personale_existe) == 0){//entra si el personale no existe
    
            //crear el usuario y asignarlo al request
            $user = User::create([
                'name' => $contacto->nombres . ' ' . $contacto->apellidos,
                'email' => $contacto->email,
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'estado' => 1,
            ])->assignRole('Personale');

            //obtener el ultimo codigo de personale y asignar el nuevo
            //PersonaleObserver / creating

            //crear el personale 
            $personale = Personale::create([
                'estado' => 0,
                'contacto_id' => $contacto->id,
                'user_id' => $user->id,
            ]);

        } else {
            $personale = $contacto->personale;
        }

        if (isset($personale)) {
            $contacto->update([
                'estado' => 5
            ]);
        }


        return [
            'personale_id' => $personale->id,
            'grupo_id' => Grupo::all()->random()->id,
            'personal_id' => Personale::all()->random()->id,
            'estado' => 0,
            'tipoinscripcione' => $this->faker->numberBetween($min = 0, $max = 1),
            'fecha' => $this->faker->dateTimeThisYear($max = '2021-12-31', $timezone = null)->format('Y-m-d')
        ];
    }
}
