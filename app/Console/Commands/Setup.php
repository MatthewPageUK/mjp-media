<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

/**
 * Sets up the MMM application for first use.
 *
 * Seeds the admin user if none exist.
 *
 */
class Setup extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mmm:setup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Setup the MMM application for first use.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Setting up the MMM application...');

        if (User::admins()->count() > 0) {
            $this->error('An admin user already exists. Skipping setup.');
            return;
        }

        $this->info('Running seeder');
        $seeder = new \Database\Seeders\DatabaseSeeder();
        $seeder->run();

        $this->info('Setup complete!');

    }
}
