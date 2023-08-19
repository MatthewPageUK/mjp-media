<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

/**
 * Sets up the application for first use with
 * demo data and users.
 *
 * Seeds the admin user if none exist.
 * Seeds demo users and download example files.
 *
 */
class SetupDemo extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mmm:setup-demo';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Setup the application for first use with demo data and users.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Setting up the application demo data...');

        if (User::admins()->count() > 0) {
            $this->error('An admin user already exists. Skipping setup.');
            return;
        }

        $this->info('Running seeder');
        $seeder = new \Database\Seeders\DatabaseSeeder();
        $seeder->run();

        // Create users

        // Download some images - https://loremflickr.com/640/360/fish?random=487643{{ $demo->id }}

        // file_put_contents(public_path('datafiles\APPL').'/'.$resume, fopen(REQUEST('cand_resume_url'), 'r'));

        $this->info('Setup complete!');

    }
}
