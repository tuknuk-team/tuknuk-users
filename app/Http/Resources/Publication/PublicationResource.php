<?php

namespace App\Http\Resources\Publication;

use App\Helpers\FileUploadHelper;
use App\Http\Requests\Publication\PublicationCreateRequest;
use App\Http\Requests\Publication\PublicationSearchDiscoverRequest;
use App\Http\Resources\Discover\DiscoverMoviesResource;
use App\Http\Resources\Discover\DiscoverSeriesResource;
use App\Http\Resources\User\UserProfileResource;
use App\Models\Publication\Publication;
use App\Models\Publication\PublicationType;
use App\Models\User;
use App\Traits\PaginationTrait;

class PublicationResource
{
    use PaginationTrait;

    /**
     * @param  string $uuid
     *
     * @return \App\Models\Publication\Publication
     */
    public function findByUuid(string $uuid)
    {
        return Publication::where('uuid', $uuid)->first();
    }

    /**
     * @param  \App\Http\Requests\Publication\PublicationCreateRequest $request
     *
     * @return \App\Models\Publication\Publication
     * @throws \Exception
     */
    public function create(PublicationCreateRequest $request)
    {
        $validated = $request->validated();

        $type = (new PublicationTypeResource())->findByCode($validated['type_code']);
        if (!$type) {
            throw new \Exception('Tipo de publicação inválido.', 403);
        }

        $publication = $this->createPublication(
            $request->user(),
            $type,
            $validated['text'],
            $validated['is_private'],
            $validated['is_draft'],
            $validated['is_spoiler']
        );

        if(!$publication){
            throw new \Exception('Não foi possível criar a publicação.', 400);
        }

        # Archive
        if (isset($validated['archive']) && $validated['archive']) {
            $archive_url = (new FileUploadHelper())->storeFile($validated['archive'], 'publications');
            if(!$archive_url){
                throw new \Exception('Ocorreu um erro no upload do arquivo.', 403);
            }

            $publication->update([
                'archive_url' => $archive_url
            ]);
        }

        # Discover (optional)
        if(isset($validated['discover_type']) && $validated['discover_type']){
            $this->createPublicationDiscover(
                $publication,
                $validated['discover_data']
            );
        }

        return $publication;
    }

    /**
     * @param  \App\Models\User $user
     * @param  \App\Models\Publication\PublicationType $type
     * @param  string $text
     * @param  bool $is_private
     * @param  bool $is_draft
     * @param  bool $is_spoiler
     *
     * @return \App\Models\Publication\Publication
     * @throws \Exception
     */
    public function createPublication(User $user, PublicationType $type, string $text, bool $is_private, bool $is_draft, bool $is_spoiler)
    {
        return $user->publications()->create([
            'type_id' => $type->id,
            'text' => $text,
            'is_private' => $is_private,
            'is_draft' => $is_draft,
            'is_spoiler' => $is_spoiler
        ]);
    }

    /**
     * @param  \App\Models\Publication\Publication $publication
     * @param  array $data
     *
     * @return \App\Models\Publication\PublicationDiscover
     * @throws \Exception
     */
    public function createPublicationDiscover(Publication $publication, array $data)
    {
        return $publication->discover()->create([
            'title' => $data['title'],
            'description' => $data['description'],
            'image' => $data['image'],
            'embed' => (isset($data['embed'])) ? $data['embed'] : null,
            'link' => (isset($data['link'])) ? $data['link'] : null,
        ]);
    }

    /**
     * @param  \App\Models\User $user
     *
     * @return float
     */
    public function totalPublicationsOfUser(User $user)
    {
        return $user->publications()
            ->where('is_draft', 0)
            ->count();
    }

    /**
     * @param  \App\Models\User $user
     * @param  bool $with_paginate
     * @param  int $limit
     * @param  int $page
     *
     * @return \App\Models\Publication\Publication
     */
    public function publicationsFromUser(User $user, bool $with_paginate = true, int $limit = 10, int $page = 1)
    {
        $array = [];
        $publications = Publication::where('user_id', $user->id)
            ->isPublished()
            ->with('likes', 'comments', 'comments.user.profile','comments.statistics', 'statistics', 'type', 'user')
            ->orderBy('publications.created_at', 'DESC')
            ->select('publications.*')
            ->get();

        foreach ($publications as $publication) {
            $array[] = $this->publicationArray($publication);
        }

        if ($with_paginate) {
            $array = $this->paginate($array, $limit, $page);
        }

        return $array;
    }

    /**
     * @param  \App\Models\User $user
     * @param  bool $with_paginate
     * @param  int $limit
     * @param  int $page
     *
     * @return \App\Models\Publication\Publication
     */
    public function publicationsLikedFromUser(User $user, bool $with_paginate = true, int $limit = 10, int $page = 1)
    {
        $array = [];
        $publications = Publication::join('publications_likes', 'publications.id', '=', 'publications_likes.publication_id')
            ->where('publications.user_id', $user->id)
            ->with('publications.likes', 'publications.comments', 'publications.statistics', 'publications.type')
            ->orderBy('publications.created_at', 'DESC')
            ->get();

        foreach ($publications as $publication) {
            $array[] = $this->publicationArray($publication);
        }

        if ($with_paginate) {
            $array = $this->paginate($array, $limit, $page);
        }

        return $array;
    }

    /**
     * @param  \App\Models\User $user
     * @param  int $limit
     * @param  string $type_code
     *
     * @return \App\Models\Publication\Publication
     * @throws \Exception
     */
    public function publicationsFromUserByType(User $user, int $limit = 10, string $type_code)
    {
        $type = (new PublicationTypeResource())->findByCode($type_code);

        if (!$type) {
            throw new \Exception('Tipo de publicação não encontrado.', 404);
        }

        return $user->publications()
            ->where('type_id', $type->id)
            ->with('likes', 'comments', 'comments.user.profile','comments.statistics', 'statistics', 'type', 'user')
            ->orderBy('created_at', 'DESC')
            ->paginate($limit);
    }

    /**
     * @param  \App\Models\User $user
     * @param  bool $with_paginate
     * @param  int $limit
     * @param  int|null $page
     *
     * @return object
     */
    public function feed(User $user, bool $with_paginate = true, int $limit = 10, int $page = 1)
    {
        $array = [];
        $publications = Publication::forFeed($user->id)
            ->isPublished()
            ->with('likes','statistics', 'type', 'user')
            ->distinct('uuid')
            ->orderBy('publications.created_at', 'DESC')
            ->select('publications.*')
            ->get();

        foreach ($publications as $publication) {
            $array[] = $this->publicationArray($publication);
        }

        if ($with_paginate) {
            $array = $this->paginate($array, $limit, $page);
        }

        return $array;
    }

    /**
     * @param  \App\Models\Publication\Publication $publication
     *
     * @return array
     */
    public function publicationArray(Publication $publication)
    {
        return [
            'uuid' => $publication->uuid,
            'content' => [
                'text' => $publication->text,
                'type' => $publication->type->code,
                'archive' => $publication->archive_url
            ],
            'status' => [
                'is_draft' => $publication->is_draft,
                'is_private' => $publication->is_private,
                'is_spoiler' => $publication->is_spoiler,
            ],
            'discover' => $publication->discover,
            'date' => $publication->created_at,
            'statistics' => $publication->statistics,
            'comments' => $publication->comments()->with('statistics','user.profile')->get(),
            'likes' => $publication->likes,
            'liked' => (auth()->user() && $publication->likes()->where('user_id', auth()->user()->id)->first())? true : false,
            'saved' => (auth()->user() && $publication->saves()->where('user_id', auth()->user()->id)->first())? true : false,
            'user' => (new UserProfileResource())->profileDetail($publication->user),
        ];
    }

    public function searchDiscover(PublicationSearchDiscoverRequest $request)
    {
        $validated = $request->validated();
        switch ($validated['type']) {
            case 'movie':
                return (new DiscoverMoviesResource())->search((isset($validated['query']) && $validated['query'])? $validated['query'] : '');
            case 'serie':
                return (new DiscoverSeriesResource())->search((isset($validated['query']) && $validated['query'])? $validated['query'] : '');
        }
    }
}
