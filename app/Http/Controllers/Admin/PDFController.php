<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Inscripcione;
use App\Models\Pago;
use PDF;

class PDFController extends Controller
{
    public function reciboInscripcione()
    {
    	$inscripcione = Inscripcione::find($_GET['idinscripcione']);

        $data = [
            'title' => 'Hola mundo estoy imprimiendo.com',
            'date' => date('m/d/Y'),
            'inscripcione' => $inscripcione
        ];
        
      //  dd($inscripcione);
        $pdf = PDF::setPaper('a4', 'vertical')->loadView('admin.reports.recibo_inscripcione', $data);

    	//return view('admin.reports.recibo_inscripcione', compact('inscripcione'));
        return $pdf->stream('imprimiendo.pdf');
    }

    public function pagos(){

        $f_inicio = $_GET['f-inicio'];
        $f_fin = $_GET['f-fin'];
        $search = $_GET['search'];

        $data = [];

        if ($f_inicio == '' || $f_fin == '') {
            $pagos = Pago::select('*');
        } else {
            $pagos = Pago::where('pagos.fechapago', '>=', $f_inicio)
                    ->where('pagos.fechapago', '<=', $f_fin);
            $data['f_fin'] = $f_fin;
            $data['f_inicio'] = $f_inicio;
        }

        if ($search != ''){

            $pagos = $pagos->whereHas('obligacione',  function($q){ 
                        $q->whereHas("inscripcione",  function($qu){ 
                            $qu->where("id", $_GET['search']); 
                        }); 
                    });
        }

        $pagos = $pagos->orderBy('fechapago', 'desc')->get();
        $title = 'Reporte de pagos';
        $data = array_merge($data, [
            'title' => $title,
            'date' => date('d/m/Y'),
            'pagos' => $pagos
        ]);
        
      
        $pdf = PDF::setPaper('a4', 'vertical')->loadView('admin.reports.report_pagos', $data);
        
        //return view('admin.reports.report_pagos', compact('pagos', 'title'));
        return $pdf->stream('imprimiendo.pdf');
    }
}