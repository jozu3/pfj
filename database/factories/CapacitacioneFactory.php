<?php

namespace Database\Factories;

use App\Models\Capacitacione;
use App\Models\Programa;
use Illuminate\Database\Eloquent\Factories\Factory;

class CapacitacioneFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Capacitacione::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'tema' => $this->faker->word(2),
            'estado' => 1,
            'fechacapacitacion' => $this->faker->dateTimeThisYear($max = '2022-07-17', $timezone = null)->format('Y-m-d'),
            'programa_id' => Programa::all()->random()->id,
        ];
    }
}
