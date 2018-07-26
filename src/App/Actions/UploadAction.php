<?php

namespace Laracore\Core\App\Actions;

use Laracore\Core\App\Tasks\UploadTask;
use Laracore\Core\App\Tasks\ValidatorUploadTask;

class UploadAction
{
    public function handler()
    {
        $validator = app()->make(ValidatorUploadTask::class)->handler();
        if ($validator->fails()) {
            abort(501, $validator->messages()->first());
        }else{
            return app()->make(UploadTask::class)->handler();
        }
    }

}
