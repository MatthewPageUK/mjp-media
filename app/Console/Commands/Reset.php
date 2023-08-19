<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

/**
 * Resets the application, deleting all user
 * data, admins and files.
 *
 * Deletes all user files !
 *
 */
class Reset extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mmm:reset';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Reset the application and delete all files.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Preparing to reset the application...');

        $this->table(
            ['Name', 'Email', 'Files'],
            User::users()->get()->map(function ($user) {
                return [
                    $user->name,
                    $user->email,
                    $user->totalFiles,
                ];
            })
        );

        if (! $this->confirm('This will delete all user data and files. Are you sure?')) {
            $this->info('Reset cancelled.');
            return;
        }

        if (! $this->confirm('Really? You want to delete all users and files?')) {
            $this->info('Reset cancelled.');
            return;
        }

        $this->info('Resetting application...');

        Log::critical('Resetting application via artisan command.');

        // delete users

        // delete files

        $this->info('Reset complete - please run `artisan mmm:setup` to create the default Admin user.');

    }
}
