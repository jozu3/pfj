<?php

namespace Database\Factories;

use App\Models\Contacto;
use App\Models\Pfj;
use App\Models\Personale;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ContactoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Contacto::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $nombres = $this->faker->firstName().' '.$this->faker->firstName();

        //after (' ', 'biohazard@online.ge');
        //before ('@', 'biohazard@online.ge');
        //between ('@', '.', 'biohazard@online.ge');


        return [
            'nombres' => $nombres,
            'apellidos' => $this->faker->lastName().' '.$this->faker->lastName(),
            'telefono' => $this->faker->phoneNumber(),
            'email' => $this->faker->unique()->safeEmail,
            'genero' => $this->faker->randomElement(['Hombre', 'Mujer']),
            'doc' => $this->faker->unique()->dni,
            'estado' => $this->faker->numberBetween($min = 0, $max = 3),
        ];
    }
}
