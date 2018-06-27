<?php

namespace Laracore\Core\App\Tasks;

class UploadTask
{
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

    public function __construct(){
      
    }

    public function run($cachePath, $name, $extension, $path)
    {
        $this->cachePath = $cachePath;
        $this->name = $name;
        $this->extension = $extension;
        $this->path = $path;
        $this->initFile();
        $this->object = $this->checkFile();
        dd($this->object);
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
        return $this->upload->where('md5', $this->md5)->where('sha1', $this->sha1)->where('size', $this->size)->first();
    }
}
