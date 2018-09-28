<?php

namespace Lvcmf\Core\App\Console;

use Illuminate\Console\Command;
use Lvcmf\Core\Framework\Commands\Install;

class InstallCommand extends Command
{
    /**
     *  install class.
     * @var object
     */
    protected $install;
    /**
     * The name and signature of the console command.
     *
     * @var string
     * @translator laravelacademy.org
     */
    protected $signature = 'lvcmf:core:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'core packages install';

    public function __construct(Install $install)
    {
        parent::__construct();
        $this->install = $install;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->info($this->install->migrate());
        $this->info($this->install->publish('core:config'));
        $this->info($this->install->seed(\Lvcmf\Core\Databases\seeds\UploadTableSeeder::class));
    }
}
