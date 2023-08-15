<?php

namespace App\Http\Livewire\Admin\Users;

use App\Facades\VirtualStorage;
use App\Models\User;
use Livewire\Component;
use Illuminate\Validation\Rules;

class UpdateUser extends Component
{

    public User $user;

    /**
     * Validation rules.
     *
     * @var array<string, string>
     */
    public function rules()
    {
        return [
            'user.name' => 'required|string|min:3|max:255',
            'user.email' => 'required|email|max:255|unique:users,email,' . $this->user->id,
            'user.directory' => ['required', 'max:16', 'unique:users,directory,' . $this->user->id, 'regex:/^[a-z0-9-]+$/'],
            'user.active' => 'required|boolean',
            'user.capacity' => 'required|integer|min:1|max:' . VirtualStorage::getUnassignedSpace(),
            // 'user.password' => ['required', 'confirmed', Rules\Password::defaults()],
        ];
    }

    public function mount(User $user)
    {

    }

    public function updated($propertyName)
    {
        if ($propertyName == 'user.password_confirmation') {
            $this->validateOnly('user.password');
            return;
        }

        $this->validateOnly($propertyName);
    }

    public function save()
    {
        $this->validate();

        $this->user->save();

        session()->flash('success', 'User updated successfully.');

        return redirect()->route('users');
    }

    public function render()
    {
        return view('admin.users.edit');
    }
}
