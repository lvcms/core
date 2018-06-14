<?php

namespace Laracore\Core\App\Actions;

use Illuminate\Http\Request;
use Laracore\Core\App\Tasks\ImageUploadTask;
use Laracore\Core\App\Tasks\FileUploadTask;

class UploadAction
{
    private $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }
    public function run()
    {
        switch ($this->request->type) {
          case 'image':
            return app()->call(ImageUploadTask::class, [$this->request], 'run');
            break;
          case 'file':
            return app()->call(FileUploadTask::class, [$this->request], 'run');
            break;
        }
    }
}
