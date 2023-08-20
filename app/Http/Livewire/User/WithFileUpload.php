<?php

namespace App\Http\Livewire\User;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

trait WithFileUpload
{
    /**
     * The newly uploaded file
     *
     */
    public $newFile;

    /**
     * The name of the newly uploaded file
     *
     * @var string
     */
    public $newFileName;

    /**
     * Show the file upload modal
     *
     * @var boolean
     */
    public $showFileUpload = false;


    public function getNewFileRules()
    {
        return [
            'required',
            'file',
            'max:' . floor($this->getMaxFileSize() / 1024),
            'mimetypes:' . implode(',', config('app.allowed_mime_types')),
        ];
    }

    public function getMaxFileSize()
    {
        return min(
            config('app.max_file_size'),
            Auth::user()->capacityRemaining,
        );
    }

    /**
     * Upload the file - validate the temporary
     * file and then store it in the user's
     * storage directory.
     *
     * @var void
     */
    public function uploadFile(): void
    {
        $this->validate([
            'newFile' => $this->getNewFileRules(),
            'newFileName' => [
                'required',
                'max:255',
                'regex:/^[\.a-z0-9-]+$/',
                Rule::notIn(
                    collect($this->files)->pluck('name')->toArray()
                ),
            ],
        ], [
            'newFile.required' => 'Please select a file to upload.',
            'newFile.max' => 'File size must be less than ' . Str::humanFileSize($this->getMaxFileSize()) . '.',
            'newFile.mimetypes' => 'File type not allowed.',
            'newFileName.required' => 'Please enter a file name.',
            'newFileName.max' => 'File name must be less than 255 characters.',
            'newFileName.not_in' => 'File name already exists.',
        ], [
            'newFile' => 'File',
            'newFileName' => 'File name',
        ]);

        $this->newFile->storeAs(
            Auth::user()->storagePath . $this->directory,
            $this->newFileName
        );

        $this->cancelFileUpload();

        $this->setFiles();
    }


    public function updatedNewFile($value)
    {
        $this->validate([
            'newFile' => $this->getNewFileRules(),
        ], [
            'newFile.required' => 'Please select a file to upload.',
            'newFile.max' => 'File size must be less than ' . Str::humanFileSize($this->getMaxFileSize()) . '.',
            'newFile.mimetypes' => 'File type not allowed.',
        ], [
            'newFile' => 'File',
        ]);
        $this->newFileName = Str::fileSlug($this->newFile->getClientOriginalName());
    }

    public function updatedNewFileName($value)
    {
        $this->newFileName = Str::fileSlug($value);
    }


    public function showFileUpload()
    {
        $this->newFile = null;
        $this->newFileName = null;
        $this->showFileUpload = true;
    }

    public function cancelFileUpload()
    {
        $this->newFile = null;
        $this->newFileName = null;
        $this->showFileUpload = false;
        $this->resetValidation();
    }

    public function getNewFileTemporaryUrl()
    {
        try {
            $url = $this->newFile->temporaryUrl();
        } catch (\Exception $e) {
            $url = null;
        }

        return $url;
    }
}
