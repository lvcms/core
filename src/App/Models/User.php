<?php

namespace Laracore\Core\App\Models;

use Auth;
use JWTAuth;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laracore\Core\App\Models\Model as LaracoreModel;

class User extends Authenticatable implements JWTSubject
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

    public function attemptToken($credentials) {
        if ($token = JWTAuth::attempt(['email' => $credentials->username, 'password' => $credentials->password])) {
            return $token;
        }elseif($token = JWTAuth::attempt(['name' => $credentials->username, 'password' => $credentials->password])){
            return $token;
        }elseif($token = JWTAuth::attempt(['mobile' => $credentials->username, 'password' => $credentials->password])){
            return $token;
        }
        return null;
    }

    public function login($credentials)
    {
        if ($token = $this->attemptToken($credentials)) {
          $user = Auth::user();
          return [
              'status' => 200,
              'message' => '登录成功',
              'value' => [
                  'token' => $token,
                  'redirect' => '/admin',
                  'user' => [
                      'id' => $user->id,
                      'name' => $user->name,
                      'email' => $user->email,
                  ]
              ]
          ];
        }else{
          return [
              'status' => 200,
              'message' => '登录失败',
              'value' => $request
          ];
        }
    }
}
