<?php

namespace Database\Factories;

use App\Models\Pfj;
use Illuminate\Database\Eloquent\Factories\Factory;

class PfjFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Pfj::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        return [
            'nombre' => 'PFJ '.$this->faker->numberBetween($min = 2013, $max = 2022),//year($max = 'now') ,
            'lema' => $this->faker->sentence($nbWords = 15, $variableNbWords = true),
            'lema_abreviado' => $this->faker->sentence($nbWords = 3, $variableNbWords = true),
            'estado' => $this->faker->numberBetween($min = 0, $max = 1),
        ];
    }
}
/*
            */