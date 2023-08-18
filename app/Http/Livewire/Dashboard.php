<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Livewire\Component;

class Dashboard extends Component
{

    /**
     * Render the explorer page
     *
     * @return \Illuminate\View\View
     */
    public function render(): View
    {
        if (Auth::user()->isAdmin()) {
            return view('admin.dashboard');
        }

        return view('user.dashboard');
    }
}
