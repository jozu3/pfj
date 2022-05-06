<?php

namespace Database\Factories;

use App\Models\Programa;
use App\Models\Pfj;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProgramaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Programa::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $fecha = $this->faker->dateTimeThisYear($max = '2022-07-31', $timezone = null)->format('Y-m-d');

        $estado = 1;
        if($fecha > date("Y-m-d")){
            $estado = 0;
        }

        $nombre_sesiones = [
            'Lima Norte',
            'Lima Oeste',
            'Lima Central',
            'Lima Este',
            'Limatambo',
            'Trujillo Norte',
            'Trujillo Sur',
            'Bolivia La Paz',
        ];

        $nombre = 'PFJ '.$this->faker->randomElement($nombre_sesiones);


        return [
            'pfj_id' => Pfj::all()->random()->id,
            'nombre' => $nombre,
            'fecha_inicio' => $fecha,
            'fecha_fin' => $fecha,
            'estado' => $estado,
        ];
    }
}