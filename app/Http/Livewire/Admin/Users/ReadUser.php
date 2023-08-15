<?php

namespace App\Http\Livewire\Admin\Users;

use App\Models\User;
use Livewire\Component;

class ReadUser extends Component
{

    public User $user;

    public function mount(User $user)
    {

    }

    public function render()
    {
        return view('admin.users.read');
    }
}
