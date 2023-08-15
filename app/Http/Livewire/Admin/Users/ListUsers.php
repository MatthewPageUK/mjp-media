<?php

namespace App\Http\Livewire\Admin\Users;

use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\View\View;
use Livewire\Component;

class ListUsers extends Component
{
    /**
     * Users list
     *
     * @var Collection
     */
    public Collection $users;

    /**
     * Mount component
     *
     * @return void
     */
    public function mount(): void
    {
        $this->users = User::users()->orderBy('name')->get();
    }

    /**
     * Render the user list table
     *
     * @return \Illuminate\View\View
     */
    public function render(): View
    {
        return view('admin.users.list');
    }
}
