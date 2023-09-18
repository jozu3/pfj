<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct(){
        $this->middleware('can:student.home');
    }
    
    public function index(){

        $inscripciones = auth()->user()->personale->inscripciones->where('estado', '1');
        
        
        if ($inscripciones->count() >= 1) {
            $programa = null;
            foreach ($inscripciones as $inscripcione) {
                if ($inscripcione->programa->pfj->estado == 1) {
                    $programa = $inscripcione->programa;
                }
            }

            if($programa){
                return redirect()->route('st.programas.show', $programa);
            }
        }

        return view('student.index', compact('inscripciones'));
    }
}
