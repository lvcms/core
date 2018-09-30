<?php

namespace Lvcms\Core\App\Actions;

use Lvcms\Core\App\Tasks\UploadTask;
use Lvcms\Core\App\Tasks\ValidatorUploadTask;

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
