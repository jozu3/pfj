<?php

namespace Database\Factories;

use App\Models\Personale;
use App\Models\Contacto;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PersonaleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Personale::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $users = User::whereHas("roles", function($q){ $q->where("name", ["Consejero"]); })->pluck('id');
    
        $contacto = Contacto::factory(1)->create()[0];

        return [
            'permiso_obispo' => 0,
            'contacto_id' => $contacto->id,
            'user_id' => $this->faker->unique()->randomElement($users)
        ];
    }
}
