<?php

namespace App\Http\Resources\Publication;

use App\Models\Publication\PublicationLike;
use App\Models\User;

class PublicationSaveResource
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
    public function save(User $user, string $publication_uuid)
    {
        $publication = (new PublicationResource())->findByUuid($publication_uuid);
        if(!$publication){
            throw new \Exception('Publicação não encontrada.', 403);
        }

        if($publication->saves()->where('user_id', $user->id)->first()){
            throw new \Exception('Você já salvou esta publicação.', 403);
        }

        return $publication->saves()->create([
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
    public function remove(User $user, string $publication_uuid)
    {
        $publication = (new PublicationResource())->findByUuid($publication_uuid);
        if(!$publication){
            throw new \Exception('Publicação não encontrada.', 403);
        }

        $likeByUser = $publication->saves()->where('user_id', $user->id)->first();

        if(!$likeByUser){
            throw new \Exception('Você ainda não salvou esta publicação.', 403);
        }

        return $likeByUser->delete();
    }
}
