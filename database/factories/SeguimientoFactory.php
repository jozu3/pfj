<?php

namespace Database\Factories;

use App\Models\Seguimiento;
use App\Models\Contacto;
use App\Models\Pfj;
use Illuminate\Database\Eloquent\Factories\Factory;

class SeguimientoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Seguimiento::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        $contactos = Contacto::all();
        $ids_contactos = [];

        foreach ($contactos as $contacto){
            array_push($ids_contactos, $contacto->id);
        }

        $pfjs = Pfj::all();
        $ids_cursos = [];

        foreach ($pfjs as $pfj){
            array_push($ids_cursos, $pfj->id);
        }


        return [
            'fecha' => $this->faker->dateTimeThisYear($max = 'now', $timezone = null)->format('Y-m-d'),
            'contacto_id' => $this->faker->randomElement($ids_contactos),
            'pfj_id' => $this->faker->randomElement($ids_cursos),
            'tipo' => 0,
            'comentario' => $this->faker->sentence(),
            'personal_id' => $this->faker->numberBetween($min = 3, $max = 9),
        ];
    }
}
