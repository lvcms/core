<?php

namespace Lvcmf\Core\Framework\Commands;

use DB;
use Artisan;
use Illuminate\Support\Facades\Schema;

class Uninstall
{
    public function dropTable($name)
    {
        Schema::dropIfExists($name);
        DB::table('migrations')->where('migration', 'like', '%'.$name.'_table%')->delete();
        return 'dropIfExists '. $name .' Table';
    }
    public function dropConfig($package)
    {
        DB::table('core_configs')->where('package',$package)->delete();
        return 'dropIfExists ' . $package . ' Config';
    }
}
