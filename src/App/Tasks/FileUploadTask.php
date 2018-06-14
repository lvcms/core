<?php

namespace Laracore\Core\App\Tasks;

class FileUploadTask
{
    public function run($request)
    {
        dd($request->package);
    }
}
