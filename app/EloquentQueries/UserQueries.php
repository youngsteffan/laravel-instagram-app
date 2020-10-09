<?php


namespace App\EloquentQueries;


class UserQueries
{

    /**
     * Возвращает id пользователей, на которых подписан текущий юзер (айдишники подписок пользователя)
     * @return mixed
     */
    public function getUserFollowingsIds()
    {
        return auth()->user()->following()->pluck('profiles.user_id');
    }

}
