<?php

namespace App\Http\Livewire\Admin\Users;

use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Livewire\Component;

class DeleteUser extends Component
{

    public User $user;

    /**
     * Validation rules.
     *
     * @var array<string, string>
     */
    // public function rules()
    // {
    //     return [
    //         'user.name' => 'required|string|min:3|max:255',
    //         'user.email' => 'required|email|max:255|unique:users,email,' . $this->user->id,
    //         'user.directory' => 'nullable|url|max:255',
    //         'user.active' => 'required|boolean',
    //         'user.capacity' => 'required|integer|min:1|max:100000',
    //     ];
    // }

    public function mount(User $user)
    {
        if ($this->user->isAdmin()) {
            session()->flash('error', 'You cannot delete an admin user.');
            return redirect()->route('users');
        }
    }

    /**
     * Delete the user and storage
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete()
    {
        try {
            $this->user->delete();
            Storage::deleteDirectory($this->user->storagePath);
            session()->flash('success', 'User deleted successfully.');
        } catch (\Exception $e) {
            session()->flash('error', 'An error occurred while deleting the user. ' . $e->getMessage());
        }

        return redirect()->route('users');
    }

    /**
     * Suspend a user
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function suspend()
    {
        // reset login token @todo
        $this->user->active = false;
        $this->user->save();

        session()->flash('success', 'User suspended successfully.');

        return redirect()->route('user.read', $this->user);
    }

    /**
     * Render the delete user page
     *
     * @return \Illuminate\View\View
     */
    public function render(): View
    {
        return view('admin.users.delete');
    }
}
