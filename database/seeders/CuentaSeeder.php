<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Cuenta;

class CuentaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Cuenta::create(['cuenta' => 'BCP 1', 'saldo' => 0]);
        Cuenta::create(['cuenta' => 'BCP 2', 'saldo' => 0]);
        Cuenta::create(['cuenta' => 'BCP 3', 'saldo' => 0]);
        Cuenta::create(['cuenta' => 'Interbank 1', 'saldo' => 0]);
        Cuenta::create(['cuenta' => 'Interbank 2', 'saldo' => 0]);
        Cuenta::create(['cuenta' => 'Interbank 3', 'saldo' => 0]);
        Cuenta::create(['cuenta' => 'Scotiabank', 'saldo' => 0]);
        Cuenta::create(['cuenta' => 'BBVA', 'saldo' => 0]);
        Cuenta::create(['cuenta' => 'Yape 1', 'saldo' => 0]);
        Cuenta::create(['cuenta' => 'Yape 2', 'saldo' => 0]);
    }
}
