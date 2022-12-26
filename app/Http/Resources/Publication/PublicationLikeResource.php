<?php

namespace App\Http\Resources\Publication;

use App\Models\Publication\PublicationLike;
use App\Models\User;

class PublicationLikeResource
{
    /**
     * @param int $id
     *
     * @return \App\Models\Publication\PublicationLike
     */
    public function findById(string $id)
    {
        return PublicationLike::where('id', $id)->first();
    }

    /**
     * @param  \App\Models\User $user
     * @param  string $publication_uuid
     *
     * @return bool
     * @throws \Exception
     */
    public function like(User $user, string $publication_uuid)
    {
        $publication = (new PublicationResource())->findByUuid($publication_uuid);

        if(!$publication){
            throw new \Exception('Publicação não encontrada.', 403);
        }

        if($publication->likes()->where('user_id', $user->id)->first()){
            throw new \Exception('Você já curtiu esta publicação.', 403);
        }

        return $publication->likes()->create([
            'user_id' => $user->id
        ]);
    }

    /**
     * @param  \App\Models\User $user
     * @param  string $publication_uuid
     *
     * @return bool
     * @throws \Exception
     */
    public function dislike(User $user, string $publication_uuid)
    {
        $publication = (new PublicationResource())->findByUuid($publication_uuid);
        if(!$publication){
            throw new \Exception('Publicação não encontrada.', 403);
        }

        $likeByUser = $publication->likes()->where('user_id', $user->id)->first();

        if(!$likeByUser){
            throw new \Exception('Você ainda não curtiu esta publicação.', 403);
        }

        return $likeByUser->delete();
    }
}
