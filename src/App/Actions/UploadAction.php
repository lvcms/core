<?php

namespace Laracore\Core\App\Actions;

use Illuminate\Http\Request;
use Laracore\Core\App\Tasks\UploadTask;
use Laracore\Core\App\Tasks\ValidatorUploadTask;

class UploadAction
{
    private $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }
    public function run()
    {
        $validator = app()->call(ValidatorUploadTask::class, [$this->request], 'run');
        if ($validator->fails()) {
            abort(501, $validator->messages()->first());
        }else{
            return app()->call(UploadTask::class, [
              $this->request->file->getRealPath(),
              $this->request->file->getClientOriginalName(),
              $this->request->file->getClientOriginalExtension(),
              $this->request->package
            ], 'run');
        }
    }

}
