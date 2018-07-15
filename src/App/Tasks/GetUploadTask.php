<?php

namespace Laracore\Core\App\Tasks;

use Storage;
use Laracore\Core\App\Models\Upload;

class GetUploadTask
{

    public function __construct(Upload $uploadPro)
    {
        $this->uploadModel = $uploadPro;
    }

    public function run($key,$value)
    {
        return $this->uploadModel->where($key, $value)->first();
    }
}
