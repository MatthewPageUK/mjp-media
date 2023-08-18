<?php

namespace App\Http\Livewire\Admin\Users;

use App\Models\User;
use Illuminate\View\View;
use Livewire\Component;

class ReadUser extends Component
{
    /**
     * The user being viewed.
     *
     * @var User
     */
    public User $user;

    /**
     * Mount the component.
     *
     * @param  User  $user
     * @return void
     */
    public function mount(User $user): void
    {
        //
    }

    /**
     * Render the component.
     *
     * @return \Illuminate\View\View
     */
    public function render(): View
    {
        return view('admin.users.read');
    }
}
