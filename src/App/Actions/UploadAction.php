<?php

namespace Lvcmf\Core\App\Actions;

use Lvcmf\Core\App\Tasks\UploadTask;
use Lvcmf\Core\App\Tasks\ValidatorUploadTask;

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
