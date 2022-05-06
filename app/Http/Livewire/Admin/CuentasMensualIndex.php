<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Pago;
use App\Models\Obligacione;
use App\Models\Cuenta;
use DB;

class CuentasMensualIndex extends Component
{ 
	public $mes = 5;
	public $anio = 2021;

    public function sumaporsemana($f_ini_sem1, $f_fin_sem1){
        $sem = Cuenta::select('cuentas.id as idcuenta','cuentas.cuenta as nombrecuenta', DB::raw('SUM(pagos.monto) as sumpagos'))
                ->join('pagos', 'cuentas.id', '=', 'pagos.cuenta_id')
                ->where('pagos.fechapago', '>=', $f_ini_sem1)
                ->where('pagos.fechapago', '<=', $f_fin_sem1)
                ->groupBy('cuentas.id', 'cuentas.cuenta')
                ->get();
        return $sem;
    }

    public function render()
    {
        $hoy = date('Y-m-d', strtotime(now()));
    	//$year_actual = date('Y', strtotime(now()));
        $years = Obligacione::select(DB::raw('year(fechalimite) as year'))->groupBy('year')->get();


    	$cuentas_mensual = Cuenta::select('cuentas.id as idcuenta','cuentas.cuenta as nombrecuenta', DB::raw('SUM(pagos.monto) as sumpagos'))
    			->join('pagos', 'cuentas.id', '=', 'pagos.cuenta_id')
                ->where(DB::raw('month(pagos.fechapago)'), '=', $this->mes)
                ->where(DB::raw('year(pagos.fechapago)'), '=', $this->anio)
    			->groupBy('cuentas.id', 'cuentas.cuenta')
    			->get();

        $primerdiames = date('w', strtotime($this->anio.'-'.$this->mes.'-01'));
        $cant_dias_mes = date('t', strtotime($this->anio.'-'.$this->mes.'-01'));
        
        //Semana 1
        $dias_faltan_terminar_sem1 = 7 - $primerdiames;
        $ultim_fecha_sem1 = 1 + $dias_faltan_terminar_sem1;
        
        $f_ini_sem1 = $this->anio.'-'.$this->mes.'-'.'01';
        $f_fin_sem1 = $this->anio.'-'.$this->mes.'-'.$ultim_fecha_sem1;

        //Semana 2
        $primera_fecha_sem2 = $ultim_fecha_sem1 +1;
        $ultim_fecha_sem2 = $primera_fecha_sem2 + 6;
        
        $f_ini_sem2 = $this->anio.'-'.$this->mes.'-'.$primera_fecha_sem2;
        $f_fin_sem2 = $this->anio.'-'.$this->mes.'-'.$ultim_fecha_sem2;

        //Semana 3
        $primera_fecha_sem3 = $ultim_fecha_sem2 +1;
        $ultim_fecha_sem3 = $primera_fecha_sem3 + 6;
        
        $f_ini_sem3 = $this->anio.'-'.$this->mes.'-'.$primera_fecha_sem3;
        $f_fin_sem3 = $this->anio.'-'.$this->mes.'-'.$ultim_fecha_sem3;

        //Semana 4
        $primera_fecha_sem4 = $ultim_fecha_sem3 +1;
        $ultim_fecha_sem4 = $primera_fecha_sem4 + 6;
        if ($ultim_fecha_sem4 > $cant_dias_mes) {
            $ultim_fecha_sem4 = $cant_dias_mes;
        }
        
        $f_ini_sem4 = $this->anio.'-'.$this->mes.'-'.$primera_fecha_sem4;
        $f_fin_sem4 = $this->anio.'-'.$this->mes.'-'.$ultim_fecha_sem4;

        //Semana 5
        if ($ultim_fecha_sem4 !== $cant_dias_mes) {
            
            $primera_fecha_sem5 = $ultim_fecha_sem4 +1;
            $ultim_fecha_sem5 = $cant_dias_mes;
            
            $f_ini_sem5 = $this->anio.'-'.$this->mes.'-'.$primera_fecha_sem5;
            $f_fin_sem5 = $this->anio.'-'.$this->mes.'-'.$ultim_fecha_sem5;
            
            $sem5 = $this->sumaporsemana($f_ini_sem5, $f_fin_sem5);
        } else {
            $sem5 = null;
        }


   
        $sem1 = $this->sumaporsemana($f_ini_sem1, $f_fin_sem1);
        $sem2 = $this->sumaporsemana($f_ini_sem2, $f_fin_sem2);
        $sem3 = $this->sumaporsemana($f_ini_sem3, $f_fin_sem3);
        $sem4 = $this->sumaporsemana($f_ini_sem4, $f_fin_sem4);



        return view('livewire.admin.cuentas-mensual-index', compact('cuentas_mensual', 'years','sem1', 'sem2', 'sem3', 'sem4', 'sem5'));
    }

}