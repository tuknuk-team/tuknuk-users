<?php

namespace App\Http\Resources\Settings;

use App\Http\Resources\User\UserProfileResource;
use App\Models\User;

class SettingsUsersBlockedResource
{
    /**
     * Data users blocked of user
     *
     * @param  \App\Models\User $user
     * @return array
     */
    public function data(User $user)
    {
        $usersBlockedArray = [];
        $usersBlocked = $user->usersBlocked()->get();
        foreach ($usersBlocked as $userBlocked) {
            $usersBlockedArray[] = (new UserProfileResource())->profileDetail($userBlocked->userBlocked);
        }

        return $usersBlockedArray;
    }
}
