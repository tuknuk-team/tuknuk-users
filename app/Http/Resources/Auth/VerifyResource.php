<?php

namespace App\Http\Resources\Auth;

use App\Http\Requests\Auth\VerifyRequest;
use App\Http\Resources\User\UserResource;
use App\Models\User;

class VerifyResource
{
    /**
     * @param \App\Http\Requests\Auth\VerifyRequest $request
     * @return bool
     * @throws \Exception
     */
    public function verifyResource(VerifyRequest $request)
    {
        $validated = $request->validated();

        $code = (new UserResource())->verifyCode($validated['code'], $validated['email']);

        if (!$code) {
            throw new \Exception('E-mail não pode ser validado', 404);
        }

        // 'email_verified_at' => date('Y-m-d H:i:s')

        throw new \Exception('Ocorreu um erro. Tente novamente!');
    }
}
