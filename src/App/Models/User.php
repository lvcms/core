<?php

namespace Laracore\Core\App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laracore\Core\App\Models\Model as LaracoreModel;

class User extends Authenticatable
{
    use Notifiable, LaracoreModel;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function getToken($values)
    {
        return [
            'status' => 200,
            'message' => '登录成功',
            'value' => $values
        ];
    }
}
