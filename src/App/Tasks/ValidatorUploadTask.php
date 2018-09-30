<?php

namespace Lvcms\Core\App\Tasks;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
/**
 * 验证上传文件
 */
class ValidatorUploadTask
{
    public function handler()
    {
        switch (Input::get('fileType')) {
          case 'image':
            return $this->validator([
                    'file' => 'required|mimes:'.config('core.upload.format.image'),
                ],
                [
                    'file.mimes' => '上传图片格式错误',
                    'file.required' => '图片不存在',
            ]);
            break;
          case 'file':
            return $this->validator([
                    'file' => 'required|mimes:'.config('core.upload.format.file'),
                ],
                [
                    'file.mimes' => '上传文件格式错误',
                    'file.required' => '文件不存在',
            ]);
            break;
        }
    }
    public function validator($rules, $messages)
    {
        return Validator::make(Input::all(), $rules, $messages);
    }
}
