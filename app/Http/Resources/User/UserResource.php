<?php

namespace App\Http\Resources\User;

use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;

class UserResource
{
    /**
     * @param string $email
     *
     * @return \App\Models\User
     */
    public function findByEmail(string $email)
    {
        return User::where('email', $email)->first();
    }

    /**
     * @param string $username
     *
     * @return \App\Models\User
     */
    public function findByUsername(string $username)
    {
        return User::where('username', $username)->first();
    }

    /**
     * @param int $id
     *
     * @return \App\Models\User
     */
    public function findById(string $id)
    {
        return User::where('id', $id)->first();
    }

    /**
     * Register new user
     *
     * @param  \App\Http\Requests\Auth\RegisterRequest $request
     *
     * @return \App\Models\User
     * @throws \Exception
     */
    public function register(RegisterRequest $request)
    {
        $validated = $request->validated();

        $sponsor = ($validated['sponsor_username']) ? $this->findByUsername($request->sponsor_username) : null;

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'genre_id' => (isset($validated['genre_id']) && $validated['genre_id'])? $validated['genre_id'] : null,
            'password' => bcrypt($validated['password']),
            'username' => $validated['username'],
            'sponsor_id' => ($sponsor) ? $sponsor->id : null
        ]);

        if (!$user) {
            throw new \Exception('Não foi possível se registrar. Tente novamente!');
        }

        return $user;
    }
}
