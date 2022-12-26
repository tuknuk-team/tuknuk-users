<?php

namespace App\Http\Controllers\Api\Publication;

use App\Http\Controllers\Controller;
use App\Http\Requests\Publication\PublicationCommentRequest;
use App\Http\Resources\Publication\PublicationCommentLikeResource;
use App\Http\Resources\Publication\PublicationCommentResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PublicationCommentController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    /**
     * @param  \App\Http\Resources\Publication\PublicationCommentResource $resource
     * @param  \App\Http\Requests\Publication\PublicationCommentRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(PublicationCommentResource $resource, PublicationCommentRequest $request, string $publication_uuid)
    {
        try {
            DB::beginTransaction();

            if ($comment = $resource->create($request, $publication_uuid)) {
                DB::commit();

                return response()->json([
                    'status'  => true,
                    'message' => 'Comentário publicado',
                    'comment' => (new PublicationCommentResource())->commentArray($comment)
                ]);
            }
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'status'  => false,
                'message' => $e->getMessage()
            ], $e->getCode() ?: 400);
        }
    }

    /**
     * @param  string $publication_uuid
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function historyByPublication(string $publication_uuid)
    {
        try {
            $comments = (new PublicationCommentResource())->historyByPublication($publication_uuid, true, 10, request()->page ?: 1);
            $comments->withPath(route('api.publication.comments', $publication_uuid));

            return response()->json([
                'status'  => true,
                'comments' => $comments
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status'  => false,
                'message' => $e->getMessage()
            ], $e->getCode() ?: 400);
        }
    }

    /**
     * @param  string $publication_uuid
     * @param  int $comment_id_parent
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function historySubByPublication(string $publication_uuid, int $comment_id_parent)
    {
        try {
            return response()->json([
                'status'  => true,
                'previous_comment_id_parent' => $comment_id_parent,
                'comments' => (new PublicationCommentResource())->historySubComment($publication_uuid, $comment_id_parent)
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status'  => false,
                'message' => $e->getMessage()
            ], $e->getCode() ?: 400);
        }
    }

    /**
     * @param  \App\Http\Resources\Publication\PublicationCommentLikeResource $resource
     * @param  string $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function like(PublicationCommentLikeResource $resource, string $id)
    {
        try {
            DB::beginTransaction();

            if ($resource->like(auth()->user(), $id)) {
                DB::commit();

                return response()->json([
                    'status'  => true,
                    'message' => 'Comentário curtido',
                ]);
            }
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'status'  => false,
                'message' => $e->getMessage()
            ], $e->getCode() ?: 400);
        }
    }

    /**
     * @param  \App\Http\Resources\Publication\PublicationCommentLikeResource $resource
     * @param  string $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function dislike(PublicationCommentLikeResource $resource, string $id)
    {
        try {
            DB::beginTransaction();

            if ($resource->dislike(auth()->user(), $id)) {
                DB::commit();

                return response()->json([
                    'status'  => true,
                    'message' => 'Comentário descurtido',
                ]);
            }
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'status'  => false,
                'message' => $e->getMessage()
            ], $e->getCode() ?: 400);
        }
    }
}
