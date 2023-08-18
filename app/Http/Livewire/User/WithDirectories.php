<?php

namespace App\Http\Livewire\User;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

trait WithDirectories
{
    /**
     * Current directory
     *
     * @var string
     */
    public $directory = '/';

    /**
     * Directories in the current directory
     *
     * @var array
     */
    public $directories = [];

    /**
     * Show the create directory modal
     *
     * @var boolean
     */
    public $showCreateDirectory = false;

    /**
     * New directory name
     *
     * @var string
     */
    public $newDirectory = '';

    /**
     * Show the delete directory modal
     *
     * @var boolean
     */
    public $showDeleteDirectory = false;

    /**
     * Confirm the delete directory
     *
     * @var boolean
     */
    public $confirmDeleteDirectory = false;


    /**
     * Updated the new directory - validate it
     *
     * @param string $value
     * @return void
     */
    public function updatedNewDirectory($value): void
    {
        $this->newDirectory = Str::fileSlug($value, '-');
        $this->validateOnly('newDirectory');
    }

    /**
     * Set the directories property
     *
     * @return void
     */
    public function setDirectories(): void
    {
        $this->directories = collect(Storage::directories(Auth::user()->storagePath . $this->directory))
            ->map(function ($directory) {
                return [
                    'name' => basename($directory),
                    'path' => $directory,
                ];
            })
            ->sortBy('name');
    }

    /**
     * Append the supplied directory to the current directory
     *
     * @param string $directory
     * @return void
     */
    public function appendDirectory(string $directory): void
    {
        $this->directory = $this->directory . $directory . '/';
        $this->setDirectories();
        $this->setFiles();
    }

    /**
     * Go up 1 directory
     *
     * @return void
     */
    public function goUp()
    {
        $this->directory = str_replace('//', '/', dirname($this->directory) . '/');
        $this->setDirectories();
        $this->setFiles();
    }

    /**
     * Show the create directory modal
     *
     * @return void
     */
    public function showCreateDirectory()
    {
        $this->showCreateDirectory = true;
    }

    /**
     * Cancel the create directory modal
     *
     * @return void
     */
    public function cancelCreateDirectory()
    {
        $this->newDirectory = '';
        $this->showCreateDirectory = false;
    }

    /**
     * Create a new directory
     *
     * @return void
     */
    public function createDirectory()
    {
        $this->validate();

        if (Storage::makeDirectory(Auth::user()->storagePath . $this->directory . $this->newDirectory)) {
            session()->flash('success', 'Directory created successfully.');
        } else {
            session()->flash('error', 'Directory could not be created.');
        }

        $this->cancelCreateDirectory();

        $this->setDirectories();
        $this->setFiles();

    }

    /**
     * Show the delete directory modal
     *
     * @return void
     */
    public function showDeleteDirectory()
    {
        $this->confirmDeleteDirectory = false;
        $this->showDeleteDirectory = true;
    }

    /**
     * Cancel the delete directory modal
     *
     * @return void
     */
    public function cancelDeleteDirectory()
    {
        $this->confirmDeleteDirectory = false;
        $this->showDeleteDirectory = false;
    }

    /**
     * Delete a directory
     *
     * @return void
     */
    public function deleteDirectory()
    {
        $this->validate();

        if (Storage::deleteDirectory(Auth::user()->storagePath . $this->directory)) {
            session()->flash('success', 'Directory deleted successfully.');
            $this->goUp();

        } else {
            session()->flash('error', 'Directory could not be deleted.');
        }

        $this->cancelDeleteDirectory();

    }

    // public function rules()
    // {
    //     if ($this->showCreateDirectory) {
    //         return [
    //             'newDirectory' => [
    //                 'required',
    //                 'max:16',
    //                 'regex:/^[a-z0-9-]+$/',
    //                 Rule::notIn(collect($this->directories)->pluck('name')->toArray()),
    //             ],
    //         ];
    //     }

    //     if ($this->showDeleteDirectory) {
    //         return [
    //             'confirmDeleteDirectory' => 'accepted',
    //         ];
    //     }

    //     return [];
    // }

}
