<?php

namespace App\Http\Livewire\Admin\Users;

use App\Facades\UserStorage;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Illuminate\Validation\Rules;

class CreateUser extends Component
{

    public array $user = [];

    /**
     * Validation rules.
     *
     * @var array<string, string>
     */
    public function rules()
    {
        return [
            'user.name' => 'required|string|min:3|max:255',
            'user.email' => 'required|email|max:255|unique:users,email',
            'user.directory' => ['required', 'max:16', 'unique:users,directory', 'regex:/^[a-z0-9-]+$/'],
            'user.active' => 'required|boolean',
            'user.capacity' => 'required|integer|min:1|max:' . floor(UserStorage::getUnassignedSpace() / 1024 / 1024),
            'user.password' => ['required', 'confirmed', Rules\Password::defaults()],
        ];
    }

    /**
     * Custom validation messages.
     *
     * @return array<string, string>
     */
    public function messages()
    {
        return [
            'user.name.required' => 'The name field is required.',
            'user.name.min' => 'The name must be at least 3 characters.',
            'user.email.required' => 'The email field is required.',
            'user.email.email' => 'The email must be a valid email address.',
            'user.email.unique' => 'The email has already been taken.',
            'user.directory.required' => 'The directory field is required.',
            'user.directory.max' => 'The directory may not be greater than 16 characters.',
            'user.directory.unique' => 'This directory has already been taken.',
            'user.directory.regex' => 'The directory field must only include lowercase a-z, 0-9 or hypen.',
            'user.active.required' => 'The active field is required.',
            'user.active.boolean' => 'The active field is required.',
            'user.capacity.required' => 'The capacity field is required.',
            'user.capacity.max' => 'Capacity can not exceed unassigned storage.',
            'user.password.required' => 'The password field is required.',
            'user.password.confirmed' => 'The password confirmation does not match.',
        ];
    }

    /**
     * Mount the component.
     *
     * @return void
     */
    public function mount()
    {
        $this->user = (new User(['active' => 1, 'capacity' => 250]))->toArray();
    }

    /**
     * Updated a property.
     *
     * @param string $propertyName
     * @return void
     */
    public function updated($propertyName)
    {
        if ($propertyName == 'user.password_confirmation') {
            $this->validateOnly('user.password');
            return;
        }

        $this->validateOnly($propertyName);
    }

    /**
     * Save new user
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function save()
    {
        $this->validate();

        try {
            $user = User::create([
                'name' => $this->user['name'],
                'email' => $this->user['email'],
                'directory' => $this->user['directory'],
                'active' => $this->user['active'],
                'capacity' => $this->user['capacity'],
                'password' => Hash::make($this->user['password']),
                'is_admin' => false,
            ]);

            Storage::makeDirectory($user->storagePath);

            Storage::put($user->storagePath.'/welcome.md', '#Welcome to your new storage\n\nHere you can store all your images and media files.\n\n##How to upload\n\nClick the upload file button..\n\n');

        } catch (\Exception $e) {
            session()->flash('error', 'Something went wrong. Please try again.');
            return;
        }

        session()->flash('success', 'User created successfully.');

        return redirect()->route('users');
    }

    /**
     * Render the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('admin.users.create');
    }
}
