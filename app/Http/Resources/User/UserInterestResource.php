<?php

namespace App\Http\Resources\User;

use App\Models\User;
use App\Models\User\UserInterest;

class UserInterestResource
{
    /**
     * getUserSuggestions
     *
     * @param  \App\Models\User $user
     * @param  int $limit
     *
     * @return array
     */
    public function getUserSuggestions(User $user, $limit = 5)
    {
        $interestToSearch = [];
        $userInterests = $user->interests()->select('interest_id')->get()->toArray();
        foreach ($userInterests as $userInterest) {
            $interestToSearch[] = $userInterest['interest_id'];
        }

        $suggestions = UserInterest::where('user_id', '!=', $user->id)
            ->whereIn('interest_id', $interestToSearch)
            ->groupBy('user_id')
            ->limit($limit)
            ->distinct()
            ->get();

        $arraySuggestions = [];
        if ($suggestions) {
            foreach ($suggestions as $suggestion) {
                $arraySuggestions[] = [
                    'username' => $suggestion->user->username,
                    'name' => $suggestion->user->name,
                    'avatar' => $suggestion->user->profile->avatar,
                ];
            }
        }

        return $arraySuggestions;
    }
}
