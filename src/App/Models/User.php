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
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }
    /**
     * [findForUser 根据用户名或者邮箱、手机找到用户信息]
     */
    public function findForUser($username)
    {
        return $this->where('name', $username)
                    ->orwhere('email', $username)
                    // ->orwhere('mobile', $username)
                    ->first();
    }

    public function getToken($values)
    {
        // $user = $this->findForUser($values->username);
        // if (Auth::attempt(['email' => $values->username, 'password' => $password], $remember)) {
        //     // The user is being remembered...
        // }
        $token = auth()->attempt(['email' => $values->username, 'password' => $values->username]);
        dd($token);
        dd($user);
        return [
            'status' => 200,
            'message' => '登录成功',
            'value' => $values
        ];
    }
}
