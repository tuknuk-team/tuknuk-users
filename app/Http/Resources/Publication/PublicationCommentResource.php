<?php

namespace App\Http\Resources\Publication;

use App\Http\Requests\Publication\PublicationCommentRequest;
use App\Http\Resources\User\UserProfileResource;
use App\Models\Publication\Publication;
use App\Models\Publication\PublicationComment;
use App\Traits\PaginationTrait;

class PublicationCommentResource
{
    use PaginationTrait;

    /**
     * @param int $id
     *
     * @return \App\Models\Publication\PublicationComment
     */
    public function findById(string $id)
    {
        return PublicationComment::where('id', $id)->first();
    }

    /**
     * @param  \App\Http\Requests\Publication\PublicationCommentRequest $request
     *
     * @return \App\Models\Publication\PublicationComment
     * @throws \Exception
     */
    public function create(PublicationCommentRequest $request, string $publication_uuid)
    {
        $validated = $request->validated();

        $publication = (new PublicationResource())->findByUuid($publication_uuid);
        if(!$publication){
            throw new \Exception('A publicação não foi encontrada.', 403);
        }

        return $publication->comments()->create([
            'user_id' => $request->user()->id,
            'comment' => $validated['comment'],
            'comment_id_parent' => (isset($validated['comment_id_parent'])) ? $validated['comment_id_parent'] : null
        ]);
    }

    /**
     * @param  \App\Models\Publication\PublicationComment $comment
     *
     * @return array
     */
    public function commentArray(PublicationComment $comment)
    {
        return [
            'id' => $comment->id,
            'publication' => $comment->publication->uuid,
            'comment' => $comment->comment,
            'data' => $comment->created_at,
            'user' => (new UserProfileResource())->profileDetail($comment->user),
            'count_parent_comments' => $comment->commentsParent()->count()
        ];
    }

    /**
     * @param  string $publication_uuid
     * @param  bool $with_paginate
     * @param  int $limit
     * @param  int|null $page
     *
     * @return object
     * @throws \Exception
     */
    public function historyByPublication(string $publication_uuid, bool $with_paginate = true, int $limit = 10, int $page = 1)
    {
        $publication = (new PublicationResource())->findByUuid($publication_uuid);
        if(!$publication){
            throw new \Exception('A publicação não foi encontrada.', 403);
        }

        $array = [];
        $publications = $publication->comments()
            ->whereNull('comment_id_parent')
            ->orderBy('created_at', 'DESC')
            ->get();

        foreach ($publications as $publication) {
            $array[] = $this->commentArray($publication);
        }

        if ($with_paginate) {
            $array = $this->paginate($array, $limit, $page);
        }

        return $array;
    }

    public function historySubComment(string $publication_uuid, int $comment_id_parent)
    {
        $publication = (new PublicationResource())->findByUuid($publication_uuid);
        if(!$publication){
            throw new \Exception('A publicação não foi encontrada.', 403);
        }

        $array = [];
        $publications = $publication->comments()
            ->where('comment_id_parent', $comment_id_parent)
            ->orderBy('created_at', 'DESC')
            ->get();

        foreach ($publications as $publication) {
            $array[] = $this->commentArray($publication);
        }

        return $array;
    }
}
