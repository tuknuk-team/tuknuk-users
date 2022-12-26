<?php

namespace App\Http\Resources\Search;

use App\Http\Requests\Search\SearchUsernameRequest;
use App\Http\Resources\User\UserProfileResource;
use App\Models\User;

class SearchResource
{
    /**
     * @param  \App\Http\Requests\Search\SearchUsernameRequest $request
     *
     * @return array
     * @throws \Exception
     */
    public function searchUsername(SearchUsernameRequest $request)
    {
        $validated = $request->validated();

        $results = [];
        $users = User::where('type', 'user')->where('username', 'LIKE', '%'.$validated['username'].'%')->get();

        if($users->count() == 0){
            throw new \Exception('Nenhum usuário encontrado.', 404);
        }

        foreach($users as $user){
            $results[] = (new UserProfileResource())->profileDetail($user);
        }

        return $results;
    }
}
