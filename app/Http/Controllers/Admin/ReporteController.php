<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Estaca;
use Illuminate\Http\Request;

class ReporteController extends Controller
{
    public function __construct(){
        $this->middleware('can:admin.reportes.index')->only('index');

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $estacas = Estaca::where('nombre', '<>', 'Desconocido')->get();
        
        return view('admin.reportes.index', compact('estacas'));
    }

}
