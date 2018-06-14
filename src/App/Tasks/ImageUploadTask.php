<?php

namespace Laracore\Core\App\Tasks;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class ImageUploadTask
{
    public $validate;

    public function __construct()
    {
        $this->validate = $this->validator();
    }

    public function run($request)
    {
        if ($this->validate->fails()) {
            abort(501, $this->validate->messages()->first());
        }else{
          dd($request);
        }
    }
    
    public function validator()
    {
        $rules = [
              'file' => 'required|mimes:png,gif,bmp',
          ];
        $messages = [
              'file.mimes' => '上传图片格式错误',
              'file.required' => '图片不存在',
          ];
        return Validator::make(Input::all(), $rules, $messages);
    }
}
