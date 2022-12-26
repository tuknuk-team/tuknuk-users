<?php

namespace App\Http\Resources\User;

use App\Models\User;
use App\Traits\PaginationTrait;

class UserFollowResource
{
    use PaginationTrait;

    /**
     * @param  \App\Models\User $user
     * @param  string $username
     *
     * @return bool
     * @throws \Exception
     */
    public function followUser(User $user, $username)
    {
        $userToFollow = (new UserResource())->findByUsername($username);
        if (!$userToFollow) {
            throw new \Exception('Usuário para seguir não encontrado.', 404);
        }

        if($userToFollow->id == $user->id){
            throw new \Exception('Você não pode seguir você mesmo.', 403);
        }

        if($user->following()->where('user_follow_id', $userToFollow->id)->first()){
            throw new \Exception('Você já esta seguindo '.$username.'.', 403);
        }

        return $user->following()
            ->create([
                'user_follow_id' => $userToFollow->id,
                'approved' => true
            ]);
    }

    /**
     * @param  \App\Models\User $user
     * @param  string $username
     *
     * @return bool
     * @throws \Exception
     */
    public function unfollowUser(User $user, $username)
    {
        $userToUnfollow = (new UserResource())->findByUsername($username);
        if (!$userToUnfollow) {
            throw new \Exception('Usuário para deixar de seguir não encontrado.', 404);
        }

        if($userToUnfollow->id == $user->id){
            throw new \Exception('Você não pode deixar de seguir você mesmo.', 403);
        }

        if(!$user->following()->where('user_follow_id', $userToUnfollow->id)->first()){
            throw new \Exception('Você não esta seguindo '.$username.'.', 403);
        }

        return $user->following()
            ->where('user_follow_id', $userToUnfollow->id)
            ->delete();
    }

    /**
     * @param  \App\Models\User $user
     *
     * @return int
     */
    public function totalFollowing(User $user)
    {
        return $user->following()->count();
    }

    /**
     * @param  \App\Models\User $user
     *
     * @return int
     */
    public function totalFollowers(User $user)
    {
        return $user->followers()->count();
    }

    /**
     * @param  \App\Models\User $user $user
     * @param  bool $with_paginate
     * @param  int $limit
     * @param  int|null $page
     *
     * @return object
     */
    public function usersFollowing(User $user, bool $with_paginate = true, int $limit = 10, int $page = 1)
    {
        $array = [];
        $usersFollowing = $user->following()->with('userFollow')->get();
        foreach ($usersFollowing as $userFollowing) {
            $array[] = (new UserProfileResource())->profileDetail($userFollowing->userFollow);
        }

        if ($with_paginate) {
            $array = $this->paginate($array, $limit, $page);
        }

        return $array;
    }

    /**
     * @param  \App\Models\User $user $user
     * @param  bool $with_paginate
     * @param  int $limit
     * @param  int $page
     *
     * @return object
     */
    public function usersFollowers(User $user, bool $with_paginate = true, int $limit = 10, int $page = 1)
    {
        $array = [];
        $usersFollowing = $user->followers()->with('user')->get();
        foreach ($usersFollowing as $userFollowing) {
            $array[] = (new UserProfileResource())->profileDetail($userFollowing->user);
        }

        if ($with_paginate) {
            $array = $this->paginate($array, $limit, $page);
        }

        return $array;
    }
}
