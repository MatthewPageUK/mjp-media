<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Storage;

/**
 * Service for managing the users storage.
 *
 */
class UserStorage
{
    const BASE_DIRECTORY = 'public/users';

    /**
     * Get the base directory for the users storage.
     * This directory will be located in the
     * storage/app directory.
     *
     * @return string
     */
    public function getBaseDirectory(): string
    {
        return self::BASE_DIRECTORY;
    }

    /**
     * Get the total space used by the supplied user
     * or all users if none provided.
     *
     * @param User|null $user
     * @return int
     */
    public function getUsedSpace(?User $user = null): int
    {
        $files = $user ? $user->disk->allFiles() : Storage::allFiles(self::BASE_DIRECTORY);
        $size = 0;
        foreach ($files as $file)
        {
            $size += $user ? $user->disk->size($file) : Storage::size($file);
        }

        return $size;
    }

    /**
     * Get the total number of files for the supplied user
     * or all users if none provided.
     *
     * @param User|null $user
     * @return int
     */
    public function getTotalFiles(?User $user = null): int
    {
        return sizeof($user ?
            $user->disk->allFiles() :
            Storage::allFiles(self::BASE_DIRECTORY)
        );
    }

    /**
     * Get the amount of unassigned space
     *
     * @return int
     */
    public function getUnassignedSpace()
    {
        return $this->getTotalSpace() - $this->getAssignedSpace();
    }

    /**
     * Get the amount of assigned space
     *
     * @return int
     */
    public function getAssignedSpace()
    {
        return User::sum('capacity') * 1024 * 1024;
    }

    /**
     * Get the total assigned space
     *
     * @return int
     */
    public function getTotalSpace()
    {
        return 6 * 1024 * 1024 * 1024;
    }

}