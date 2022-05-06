<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Grupo;
use App\Models\Programa;

class GrupoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Grupo::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
       /* $grupos = Grupo::all();
         $ids_grupos = [];

        foreach ($grupos as $grupo){
            array_push($ids_grupos, $grupo->id);
        }

       $profesores = Profesore::all();
        $ids_profesores = [];

        foreach ($profesores as $profesore){
            array_push($ids_profesores, $profesore->id);
        }
*/
        return [
            'nombre' => $this->faker->word(2),
            'numero' => $this->faker->randomDigitNot(0),
            'programa_id' => Programa::all()->random()->id,
        ];
    }
}
