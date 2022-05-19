<?php

namespace App\Http\Livewire\Admin;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class SessionsIndex extends Component
{
    public function render()
    {
        $sessions = DB::table('sessions')->orderBy('last_activity', 'desc')->get();


        return view('livewire.admin.sessions-index', compact('sessions'));
    }
}