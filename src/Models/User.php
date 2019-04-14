<?php

namespace Binthec\CmsBase\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;

    /**
     * 権限
     */
    const SYSTEM_ADMIN = 1;
    const OWNER = 10;
    const OPERATOR = 100;

    public static $roles = [
        self::SYSTEM_ADMIN => 'システム管理者',
        self::OWNER => 'オーナー',
        self::OPERATOR => 'オペレータ',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'role', 'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * 権限がオーナー以上であるかの判定
     *
     * @return bool
     */
    public function isHigherOwner()
    {
        return $this->role <= self::OWNER;
    }

    /**
     * ユーザ名のIDをkey、nameを値にした配列を返すメソッド
     *
     * @return \Illuminate\Support\Collection
     */
    public static function getUserNames()
    {
        return User::all()->pluck('name', 'id');
    }

}
