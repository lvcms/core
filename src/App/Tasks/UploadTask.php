<?php

namespace Laracore\Core\App\Tasks;

use Storage;
use Laracore\Core\App\Models\Upload;

class UploadTask
{
    private $uploadModel;
    private $uid = 1;
    private $fileInfo;
    private $fileData;
    private $cachePath;
    private $name;
    private $extension;
    private $path;
    private $md5;
    private $sha1;
    private $size;
    private $disk;
    private $object;

    public function __construct(Upload $uploadPro)
    {
        $this->uploadModel = $uploadPro;
    }

    public function run($cachePath, $name, $extension, $path)
    {
        $this->cachePath = $cachePath;
        $this->name = $name;
        $this->extension = $extension;
        $this->path = $path;
        $this->initFile();
        $this->object = $this->checkFile();
        //检查文件如果文件存在数据库直接返回
        if ($this->object = $this->checkFile()) {
            return $this->success();
        }else{
            // 保存文件
            if ($this->putFile()) {
                // 文件信息写入数据库
                $this->object = $this->createFileInfo();
                return $this->success();
            }else{
                return $this->error();
            }
        }
    }
    /**
     * 初始化文件信息
     */
    private function initFile()
    {
        $this->fileData = file_get_contents($this->cachePath);
        $this->md5= md5($this->fileData);
        $this->sha1 = sha1($this->fileData);
        $this->size = strlen($this->fileData);
        $this->path = $this->path .DIRECTORY_SEPARATOR.$this->md5.'.'.$this->extension; //路径
        $this->disk = config('filesystems.default');//此处后期开发上传文件驱动选择 接口 创建监控事件
    }
    /**
     * 检测文件数据库是否存在
     */
    private function checkFile()
    {
        return $this->uploadModel->where('md5', $this->md5)->where('sha1', $this->sha1)->where('size', $this->size)->first();
    }
    /**
     * 文件保存
     */
    private function putFile()
    {
        return Storage::put($this->path, $this->fileData); //保存文件
    }
    /**
     * 写入数据库文件信息
     */
    private function createFileInfo()
    {
        $this->uploadModel->uid = $this->uid;
        $this->uploadModel->name = $this->name;
        $this->uploadModel->path = $this->path;
        $this->uploadModel->extension = $this->extension;
        $this->uploadModel->size = $this->size;
        $this->uploadModel->md5 = $this->md5;
        $this->uploadModel->sha1 = $this->sha1;
        $this->uploadModel->disk = $this->disk;
        $this->uploadModel->save();
        return $this->uploadModel;
    }
    /**
     * 上传成功
     */
    private function success()
    {
        return [
            'message' => '上传成功!',
            'type'      => 'success',
            'value' => $this->object,
        ];
    }
    /**
     * 上传失败
     */
    private function error()
    {
        return [
            'message' => '文件上传失败!不要问我为什么我也不知道!要不你问下程序猿？',
            'type'      => 'error',
        ];
    }
}
