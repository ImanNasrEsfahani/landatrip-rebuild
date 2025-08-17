<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

class GenerateReactRoutes extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:react-routes';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate the route information for your React components';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->warn('User Panel React Routes generating started...');
        $this->call('generate:react-user-panel-routes');

        $this->warn('Teacher Panel React Routes generating started...');
        $this->call('generate:react-teacher-panel-routes');

        $this->warn('Admin Panel React Routes generating started...');
        $this->call('generate:react-admin-panel-routes');

        $this->warn('Agent Panel React Routes generating started...');
        $this->call('generate:react-agent-panel-routes');

        $this->warn('Manager Panel React Routes generating started...');
        $this->call('generate:react-manager-panel-routes');

        $this->warn('Public React Routes generating started...');
        $this->call('generate:react-public-routes');

    }
}
