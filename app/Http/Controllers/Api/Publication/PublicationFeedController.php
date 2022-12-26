<?php

namespace App\Http\Controllers\Api\Publication;

use App\Http\Controllers\Controller;
use App\Http\Resources\Publication\PublicationResource;
use Illuminate\Http\Request;

class PublicationFeedController extends Controller
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
     * Get Publications feed
     *
     * @param  string $username
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function feed()
    {
        try {
            $publications = (new PublicationResource())->feed(auth()->user(), true, 10, request()->page ?: 1);
            $publications->withPath(route('api.publication.feed'));

            return response()->json([
                'status'  => true,
                'publications' => $publications
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status'  => false,
                'message' => $e->getMessage()
            ], $e->getCode() ?: 400);
        }
    }

    /**
     * Get publication
     *
     * @param  string $uuid
     * @return \Illuminate\Http\JsonResponse
     */
    public function publicationData(string $uuid)
    {
        try {
            $publication = (new PublicationResource())->findByUuid($uuid);

            return response()->json([
                'status'  => true,
                'publication' => (new PublicationResource())->publicationArray($publication)
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status'  => false,
                'message' => $e->getMessage()
            ], $e->getCode() ?: 400);
        }
    }
}
