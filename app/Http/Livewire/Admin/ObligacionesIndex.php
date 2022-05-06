<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Obligacione;
use App\Models\Personale;
use DB;

class ObligacionesIndex extends Component
{
	use WithPagination;

	public $search = '';
	public $readyToLoad = false;
	public $cant = 50;
   public $mes;
   public $year;
   public $vertodas = false;
   public $estado = -1;
   public $vendedor = -1;

   protected $paginationTheme = 'bootstrap';

   public function load(){
      $this->mes = date('m');
      $this->year = date('Y');
   }

   public function render()
   {
      $years = Obligacione::select(DB::raw('year(fechalimite) as year'))->groupBy('year')->get();

   	$obligaciones = Obligacione::where('estado','<>', '');
      $that = $this;

   	if($this->search !== ''){
        $obligaciones = $obligaciones->where(function($query) use ($that) {
                       $query
                         ->orWhere('inscripcione_id', 'like','%'.$that->search.'%')
                         ->orWhere('obligaciones.id', 'like','%'.$that->search.'%');
                     });
      }

      if (!$this->vertodas) {
         $obligaciones = $obligaciones->where(DB::raw('month(fechalimite)'), $this->mes)
                            ->where(DB::raw('year(fechalimite)'), $this->year);
      }

      if ($this->estado != -1) {
         $obligaciones = $obligaciones->where('estado', $this->estado);
      }

      if ($this->vendedor != -1) {
         $obligaciones = $obligaciones->whereHas('inscripcione', function($q) use ($that){
                                          $q->whereHas('personale', function($qu) use ($that){
                                             $qu->whereHas('contacto', function($que) use ($that){
                                                $que->where('personal_id', $that->vendedor);
                                             });
                                          });
                                       });
      }

      $obligaciones = $obligaciones->orderBy('fechalimite', 'desc')->paginate($this->cant);

      $personales = Personale::all();

      return view('livewire.admin.obligaciones-index', compact('obligaciones', 'years', 'personales'));
   }
}
