<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Storage;

/**
 * Service for managing the virtual store.
 *
 */
class VirtualStorage
{


    /**
     * Construct the service and populate colours.
     *
     */
    public function __construct()
    {

    }

    /**
     * Get the total used space
     *
     * @return int
     */
    public function getUsedSpace()
    {
        $used = 0;
        foreach (Storage::allFiles('public/users') as $file)
        {
            $used += Storage::size($file); // / 1024 / 1024;
        }

        return $used;
    }

    /**
     * Get a users used space
     *
     * @param User $user
     * @return int
     */
    public function getUserSpaceUsed(User $user)
    {
        $used = 0;
        foreach (Storage::allFiles($user->storagePath) as $file)
        {
            $used += Storage::size($file); // / 1024 / 1024;
        }

        return $used;
    }

    /**
     * Get the total number of files
     *
     * @return int
     */
    public function getTotalFiles()
    {
        return sizeof(Storage::allFiles('public/users'));
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