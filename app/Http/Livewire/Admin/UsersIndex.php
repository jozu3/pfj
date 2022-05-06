<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;

use App\Models\User;
use Spatie\Permission\Models\Role;

class UsersIndex extends Component
{
	use WithPagination;

	public $search;
  public $admin = true;
  public $mdirector = true;
  public $mlogística = true;
  public $cordinador = true;
  public $cordauxiliar = true;	
  public $consejero = true;	
  public $otros = true;	
	
	protected $paginationTheme = 'bootstrap';

	public function updatingSearch(){
		$this->resetPage();
	}

  public function render()
  {
    $all_roles = Role::all();

  	$that = $this;

  	$roles_checked = [];


		$this->admin == true ? array_push($roles_checked, "admin") : ''; 
    $this->mdirector == true ? array_push($roles_checked, "mdirector") : '';
    $this->mlogística == true ? array_push($roles_checked, "mlogística") : '';
    $this->cordinador == true ? array_push($roles_checked, "cordinador") : '';
    $this->cordauxiliar == true ? array_push($roles_checked, "cordauxiliar") : '';
    $this->consejero == true ? array_push($roles_checked, "consejero") : '';
    $this->otros == true ? array_push($roles_checked, "otros") : '';

  	$users = User::where(function($query) use ($that) {
                      $query->where('email', 'like','%'.$that->search.'%')
                            ->orWhere('name', 'like','%'.$that->search.'%');
                		})
  								->whereHas("roles", function($q) use ($roles_checked, $all_roles, $that){
		  										$q->whereIn("slug", $roles_checked); 
                          // if($that->otros == true){
                          //   $q->whereIn("slug", $roles_checked)
                          //     ->orWhereNotIn('slug', $all_roles->pluck('slug'));
                          // }
		  							});

    if ($this->otros == true) {
      $users = User::doesntHave('roles')->where(function($query) use ($that) {
        $query->where('email', 'like','%'.$that->search.'%')
              ->orWhere('name', 'like','%'.$that->search.'%');
      })
                    ->union($users);
    }

    $users = $users->paginate();

    return view('livewire.admin.users-index', compact('users', 'all_roles'));
  }
}
