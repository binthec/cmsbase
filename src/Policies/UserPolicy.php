<?php

namespace Binthec\CmsBase\Policies;

use App\User;
use Illuminate\Auth\Access\Gate;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
//    public function __construct()
//    {
//        //
//    }

    /**
     * before
     *
     * @param $user
     * @return bool|null
     */
    public function before($user)
    {
        //オーナー以上であれば、ユーザ全操作が可能。それ以外の場合はnullを返し、ポリシーに従う
        return $user->isHigherOwner() ? true : null;
    }

    /**
     * アップデートの際に、ユーザIDとログインしているユーザのIDが同じかを判断する
     *
     * @param User $user
     * @return bool
     */
    public function update(User $user, User $willChangeUser)
    {
        return $user->id === $willChangeUser->id;
    }
}
