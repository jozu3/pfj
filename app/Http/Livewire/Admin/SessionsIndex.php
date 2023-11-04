<?php

namespace App\Http\Livewire\Admin;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class SessionsIndex extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        $sessions = DB::table('sessions')->whereNotNull('user_id')->orderBy('last_activity', 'desc')->get();


        return view('livewire.admin.sessions-index', compact('sessions'));
    }
}
