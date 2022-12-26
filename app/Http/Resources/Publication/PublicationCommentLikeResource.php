<?php

namespace App\Http\Resources\Publication;

use App\Models\Publication\PublicationCommentLike;
use App\Models\User;

class PublicationCommentLikeResource
{
    /**
     * @param int $id
     *
     * @return \App\Models\Publication\PublicationCommentLike
     */
    public function findById(string $id)
    {
        return PublicationCommentLike::where('id', $id)->first();
    }

    /**
     * @param  \App\Models\User $user
     * @param  string $comment_id
     *
     * @return bool
     * @throws \Exception
     */
    public function like(User $user, string $comment_id)
    {
        $comment = (new PublicationCommentResource())->findById($comment_id);

        if(!$comment){
            throw new \Exception('Comentário não encontrado.', 403);
        }

        if($comment->likes()->where('user_id', $user->id)->first()){
            throw new \Exception('Você já curtiu esta publicação.', 403);
        }

        return $comment->likes()->create([
            'user_id' => $user->id
        ]);
    }

    /**
     * @param  \App\Models\User $user
     * @param  string $comment_id
     *
     * @return bool
     * @throws \Exception
     */
    public function dislike(User $user, string $publication_uuid)
    {
        $publication = (new PublicationCommentResource())->findById($publication_uuid);
        if(!$publication){
            throw new \Exception('Comentário não encontrado.', 403);
        }

        $likeByUser = $publication->likes()->where('user_id', $user->id)->first();

        if(!$likeByUser){
            throw new \Exception('Você ainda não curtiu este comentário.', 403);
        }

        return $likeByUser->delete();
    }
}
