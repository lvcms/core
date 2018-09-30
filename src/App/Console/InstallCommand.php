<?php

namespace Lvcms\Core\App\Console;

use Artisan;
use Illuminate\Console\Command;
use Lvcms\Core\Framework\Commands\Install;

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
    protected $signature = 'lvcms:core:install';

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
        $this->mkdirVendor();
        $this->info($this->install->call('storage:link'));//创建 storage 软连接
        $this->info($this->install->call('migrate'));
        $this->info($this->install->publish('core:config'));
        $this->info($this->install->seed(\Lvcms\Core\Databases\seeds\UploadTableSeeder::class));
    }
    /**
     * 创建 Vendor 目录
     */
    public function mkdirVendor()
    {
        if (file_exists(public_path('vendor'))) {
            return $this->info('The "public/vendor" directory already exists.');
        } else {
            $this->laravel->make('files')->makeDirectory(public_path('vendor'), 0777, true);
            $this->info('The [public/vendor] directory has been create.');
        }
    }
}
