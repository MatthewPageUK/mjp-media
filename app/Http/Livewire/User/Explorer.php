<?php

namespace App\Http\Livewire\User;

use App\Facades\UserStorage;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\WithFileUploads;

class Explorer extends Component
{
    use WithFileUploads;
    use WithDirectories;
    use WithFileUpload;

    /**
     * Selected file
     *
     * @var string
     */
    public $file = null;


    public $mode = 'list';

    /**
     * Files
     *
     * @var array
     */
    public $files = [];


    public $showFile = false;

    public $showDeleteFile = false;

    // public function rules()
    // {
    //     if ($this->showCreateDirectory) {
    //         return [
    //             'newDirectory' => [
    //                 'required',
    //                 'max:32',
    //                 'regex:/^[a-z0-9-]+$/',
    //                 Rule::notIn(collect($this->directories)->pluck('name')->toArray()),
    //             ],
    //         ];
    //     }

    //     // if ($this->showDeleteDirectory) {
    //     //     return [
    //     //         'confirmDeleteDirectory' => 'accepted',
    //     //     ];
    //     // }

    //     return [];
    // }

    public function showDeleteFile()
    {
        $this->showDeleteFile = true;
    }

    public function cancelFileDelete()
    {
        $this->showDeleteFile = false;
    }

    public function setListMode()
    {
        $this->mode = 'list';
    }

    public function deleteFile(?string $path = null)
    {
        if ($path) {
            $file = Auth::user()->storagePath . $this->directory . $path;
        } else {
            $file = $this->file['path'];
        }

        if (UserStorage::deleteFile($file)) {
            session()->flash('success', 'File deleted successfully.');
            $this->deselectFile();
            $this->cancelFileDelete();
            $this->setFiles();
        } else {
            session()->flash('error', 'File could not be deleted.');
        }
    }

    public function setPreviewMode()
    {
        $this->mode = 'preview';
    }

    // public function messages()
    // {
    //     return [
    //         'newDirectory.required' => 'Please enter a directory name.',
    //         'newDirectory.max' => 'Directory name must be less than 16 characters.',
    //         'newDirectory.regex' => 'Directory name must only contain lowercase letters, numbers and hyphens.',
    //         'newDirectory.not_in' => 'Directory name already exists.',
    //     ];
    // }

    public function mount()
    {
        $this->deselectFile();
        $this->setDirectories();
        $this->setFiles();
    }




    /**
     * Set the files list
     *
     * @return void
     */
    public function setFiles()
    {
        $this->files = collect(Storage::files(Auth::user()->storagePath . $this->directory))
            ->map(function ($file) {
                return [
                    'name' => basename($file),
                    'path' => $file,
                ];
            });
    }




    /**
     * Select a file
     *
     * @param string $file
     * @return void
     */
    public function selectFile(string $file)
    {
        $this->file = [
            'name' => $file,
            'path' => Auth::user()->storagePath . $this->directory . $file,
            'size' => Storage::size(Auth::user()->storagePath . '/' . $this->directory . '/' . $file),
            'type' => Storage::mimeType(Auth::user()->storagePath . '/' . $this->directory . '/' . $file),
        ];
    }

    public function deselectFile()
    {
        $this->file = null;
        $this->showFile = false;
    }

    public function downloadFile(?string $file = null)
    {
        if ($file) {
            $this->selectFile($file);
        }

        return Storage::download($this->file['path'], $this->file['name']);
    }

    public function getFileURL(?string $file = null)
    {
        if ($file) {
            return Storage::url($file);
            return;
            $this->selectFile($file);
        }

        return Storage::url($this->file['path']);
    }

    public function showFile(?string $file = null)
    {
        if ($file) {
            $this->selectFile($file);
        }

        $this->showFile = true;
    }



    /**
     * Render the explorer page
     *
     * @return \Illuminate\View\View
     */
    public function render(): View
    {
        return view('user.explorer');
    }
}
