<?php

namespace Laracore\Core\App\Tasks;

class UploadTask
{
    public function run($fileRealPath, $fileName, $extension, $package)
    {
        dd($fileRealPath,$fileName,$extension,$package);
    }
}
