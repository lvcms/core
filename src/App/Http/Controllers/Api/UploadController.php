<?php

namespace Lvcmf\Core\App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Lvcmf\Core\App\Actions\UploadAction;

class UploadController extends Controller
{
    /**
     * 交给 UploadAction 处理
     */
    public function index()
    {
      return app()->make(UploadAction::class)->handler();
    }
}
