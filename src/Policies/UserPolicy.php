<?php

namespace Binthec\CmsBase\Policies;

use Binthec\CmsBase\Models\User;
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
     * @param User $willChangeUser
     * @return bool
     */
    public function update(User $user, User $willChangeUser)
    {
        return $user->id === $willChangeUser->id;
    }

    /**
     * アップデートの際に、自分を「含む」、自分以下の権限の場合のみ許可するポリシー
     * オーナーなら、role >= 10 のこと
     *
     * @param User $user ←ログインしてるユーザ
     * @param User $willChangeUser ←今から変更を加えるユーザ
     * @return bool
     */
    public function edit(User $user, User $willChangeUser)
    {

//        dd($user);

        return $user->role > $willChangeUser->role;
    }
}
