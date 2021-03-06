<?php

namespace Lvcms\Core\Framework\Commands;

use Artisan;
use Illuminate\Filesystem\Filesystem;
use Lvcms\Core\Framework\Database\Seeds\DatabaseSeeder;

class Install
{
    protected $fileSystem;
    public function __construct(Filesystem $files)
    {
        $this->fileSystem = $files;
    }
    public function dumpAutoload()
    {
        exec('composer dump-autoload');
        return 'dumpAutoload';
    }
    public function call($command)
    {
        Artisan::call($command);
        return $command;
    }
    public function publish($value)
    {
        Artisan::call('vendor:publish', [
            '--tag' => $value,'--force' => true
        ]);
        return 'vendor:publish --tag='.$value.' --force';
    }
    public function seed($class)
    {
        $seeder = new DatabaseSeeder();
        $seeder->run($class);
        return 'db:seed --class='.$class;
    }
    public function setEnv($name, $value)
    {
        $envPath = base_path() . DIRECTORY_SEPARATOR . '.env';
        $contentArray = collect(file($envPath, FILE_IGNORE_NEW_LINES));
        $contentArray->transform(function ($item) use ($name,$value) {
            if (str_contains($item, $name)) {
                return $name . '=' . $value;
            }
            return $item;
        });
        $content = implode($contentArray->toArray(), "\n");
        $this->fileSystem->put($envPath, $content);
        return 'SET .env '.$name.' TO '.$value;
    }
    public function installModule($module)
    {
        Artisan::call('lvcms:'.$module.':install');
    }
    public function uninstallModule($module)
    {
        Artisan::call('lvcms:'.$module.':uninstall');
    }
    /**
     * Get a command from console instance.
     *
     * @param string $name
     */
    public function getCommand($name)
    {
        $kernel = resolve(\Illuminate\Contracts\Console\Kernel::class)->all();
        return $kernel[$name];
    }
}
