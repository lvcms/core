<?php

namespace Lvcms\Core\App\Models;

use Storage;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Upload.
 */
class Upload extends Model
{
    public $table = 'core_uploads';

    protected $appends = ['url'];
    /**
     * [getUrlAttribute 根据驱动 通过path获取图片url]
     * @return [type] [description]
     */
    public function getUrlAttribute()
    {
        return Storage::disk($this->attributes['disk'])->url($this->attributes['path']);
    }
}
