<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Pago;
use App\Models\Cuenta;
use DB;

class CuentasIndex extends Component
{
    public $f_inicio = '';
    public $f_fin = '';

    public function render()
    {
    	$pagos = Cuenta::select('cuentas.id as idcuenta','cuentas.cuenta as nombrecuenta', DB::raw('SUM(pagos.monto) as sumpagos'))
    			->join('pagos', 'cuentas.id', '=', 'pagos.cuenta_id')
                ->where('pagos.fechapago', '>=', $this->f_inicio)
                ->where('pagos.fechapago', '<=', $this->f_fin)
    			->groupBy('cuentas.id', 'cuentas.cuenta')
    			->get();

    	//dd($pagos1);
/*
    	$pagos = Cuenta::select('id as idcuenta', 'cuentas.cuenta as nombrecuenta', DB::raw('0 as sumpagos'))
    			->unionAll($pagos1)
    			->groupBy('cuentas.id', 'cuentas.cuenta')
    			->get();*/


        return view('livewire.admin.cuentas-index', compact('pagos'));
    }
}
