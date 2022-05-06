<?php

namespace App\Http\Livewire\Admin;

use App\Models\Grupo;
use App\Models\Companerismo;
use Livewire\Component;
use Spatie\Permission\Models\Role;

class GruposIndex extends Component
{
    public $info_grupo;
	public $programa;
    public $nombre_grupo;
    public $numero_grupo;
    public $grupos;


    protected $rules = [
		'nombre_grupo' => 'required',
		'numero_grupo' => 'required',
	];


    public function submit(){
		
		$this->validate();

		$grupo = new Grupo([
            'nombre' => $this->nombre_grupo,
			'numero' => $this->numero_grupo,
            'programa_id' => $this->programa->id
		]);

		if ($grupo->save())
        {
            $this->info_grupo = 'Grupo creado con éxito.';
        }
        
		$this->nombre_grupo = '';
		$this->numero_grupo = '';

	}

    public function render()
    {
    	$this->grupos = Grupo::where('programa_id', $this->programa->id)->get();
        $roles = Role::whereIn('id', [6,5])->pluck('name', 'id');

        return view('livewire.admin.grupos-index', compact('roles'));
    }
}
