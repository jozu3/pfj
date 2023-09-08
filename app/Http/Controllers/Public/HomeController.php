<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Barrio;
use App\Models\Estaca;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct(){
    }
    
    public function preinscripcione(){

        return view('public.pre-inscripcione');
    }

    public function contactoStore (Request $request){   
      
    }
}
