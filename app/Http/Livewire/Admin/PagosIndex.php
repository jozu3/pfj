<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Pago;
use Livewire\WithPagination;

class PagosIndex extends Component
{
	use WithPagination;
	
	protected $paginationTheme = 'bootstrap';

    public $search = '';
	public $cant = 15;
    public $f_inicio = '';
    public $f_fin = '';

    public function render()
    {
        $that = $this;

    	$pagos = Pago::select('*','personales.nombres as nom_personal', 'personales.apellidos as ape_personal', 'pagos.monto as montopago','pagos.id as idpago')
                ->join('personales', 'pagos.personal_id', '=', 'personales.id')
                ->join('obligaciones', 'pagos.obligacione_id', '=', 'obligaciones.id')
                ->join('inscripciones', 'inscripciones.id', '=', 'obligaciones.inscripcione_id')
                ->join('personales', 'personales.id', '=', 'inscripciones.personale_id')
                ->join('contactos', 'contactos.id', '=', 'personales.contacto_id');
    			//->join('inscripciones', 'obligaciones.inscripcione_id', '=', 'inscripciones.id')

        if($this->search !== ''){
            $pagos = $pagos->where(function($query) use ($that) {
                      $query->orWhere('obligaciones.inscripcione_id', '=', $this->search)
                            ->orWhere('contactos.nombres', 'like','%'.$this->search.'%')
                            ->orWhere('contactos.apellidos', 'like','%'.$this->search.'%');
                        });
        }

        if ($this->f_inicio != '' && $this->f_fin != '') {
            if ($this->f_inicio <= $this->f_fin) {
                $pagos = $pagos->where('pagos.fechapago', '>=', $this->f_inicio)
                            ->where('pagos.fechapago', '<=', $this->f_fin);
            } else {
                session()->flash('message', 'La fecha de inicio debe ser anterior a la fecha de fin.');
            }
        }   

    	if(!auth()->user()->hasRole(['Admin', 'Asistente'])){
    			$pagos = $pagos->where('personal_id','=',auth()->user()->personal->id);
    	}
    	
    	$pagos = $pagos->orderBy('pagos.fechapago', 'desc')->paginate($this->cant);

        $this->resetPage();

        return view('livewire.admin.pagos-index', compact('pagos'));
    }
}
