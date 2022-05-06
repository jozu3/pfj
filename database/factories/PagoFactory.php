<?php

namespace Database\Factories;

use App\Models\Pago;
use App\Models\Obligacione;
use App\Models\Cuenta;
use App\Models\Personale;
use Illuminate\Database\Eloquent\Factories\Factory;

class PagoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Pago::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        $obligacione = Obligacione::whereIn('estado',[1,2])->get()->random();

        $monto_pagado = Pago::where('obligacione_id', $obligacione->id)->sum('monto');

        $maximo = $obligacione->montofinal - $obligacione->montopagado;
 
        return [
            'cuenta_id' => Cuenta::all()->random()->id,
            'obligacione_id' => $obligacione->id,
            'monto' => $maximo,
            'fechapago' => $this->faker->dateTimeThisYear($max = '2021-05-22', $timezone = null)->format('Y-m-d'),
            'personal_id' => Personale::all()->random()->id,
        ];
    }
}
