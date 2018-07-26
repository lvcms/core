<?php

namespace Laracore\Core\App\Models;

use JWTAuth;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;

    public $table = 'core_users';
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

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
    /**
     * 设置密码默认自动通过 bcrypt 加密存储
     */
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
                    ->orwhere('mobile', $username)
                    ->first();
    }
    /**
     * 通过 JWTAuth 获取 token
     */
    public function attemptToken($credentials)
    {
        if ($token = JWTAuth::attempt(['email' => $credentials->username, 'password' => $credentials->password])) {
            return $token;
        } elseif ($token = JWTAuth::attempt(['name' => $credentials->username, 'password' => $credentials->password])) {
            return $token;
        } elseif ($token = JWTAuth::attempt(['mobile' => $credentials->username, 'password' => $credentials->password])) {
            return $token;
        }
        return null;
    }
}
