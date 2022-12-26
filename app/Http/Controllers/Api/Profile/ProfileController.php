<?php

namespace App\Http\Controllers\Api\Profile;

use App\Http\Controllers\Controller;
use App\Http\Resources\Publication\PublicationResource;
use App\Http\Resources\User\UserFollowResource;
use App\Http\Resources\User\UserProfileResource;
use App\Http\Resources\User\UserResource;

class ProfileController extends Controller
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
     * Get Profile Data
     *
     * @param  string $username
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function data(string $username)
    {
        try {
            $user = (new UserResource())->findByUsername($username);
            if (!$user) {
                throw new \Exception('Perfil não encontrado.', 404);
            }

            return response()->json([
                'status'  => true,
                'data' => (new UserProfileResource())->profileDetail($user)
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status'  => false,
                'message' => $e->getMessage()
            ], $e->getCode() ?? 400);
        }
    }

    /**
     * Get Profile Publications
     *
     * @param  string $username
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function publications(string $username)
    {
        try {
            $user = (new UserResource())->findByUsername($username);
            if (!$user) {
                throw new \Exception('Perfil não encontrado.', 404);
            }

            $publications = (new PublicationResource())->publicationsFromUser($user, true, 10, request()->page ?: 1);
            $publications->withPath(route('api.profile.publications', $username));

            return response()->json([
                'status'  => true,
                'publications' => $publications
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status'  => false,
                'message' => $e->getMessage()
            ], $e->getCode() ?? 400);
        }
    }

    /**
     * Get Profile Publications Liked
     *
     * @param  string $username
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function publicationsLiked(string $username)
    {
        try {
            $user = (new UserResource())->findByUsername($username);
            if (!$user) {
                throw new \Exception('Perfil não encontrado.', 404);
            }

            $publications = (new PublicationResource())->publicationsLikedFromUser($user, true, 10, request()->page ?: 1);
            $publications->withPath(route('api.profile.publicationsLiked', $username));

            return response()->json([
                'status'  => true,
                'publications' => $publications
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status'  => false,
                'message' => $e->getMessage()
            ], $e->getCode() ?? 400);
        }
    }

    /**
     * Get Profile Following users list
     *
     * @param  string $username
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function following(string $username)
    {
        try {
            $user = (new UserResource())->findByUsername($username);
            if (!$user) {
                throw new \Exception('Perfil não encontrado.', 404);
            }

            $page = request()->page ?: 1;

            $following = (new UserFollowResource())->usersFollowing($user, true, 10, $page);
            $following->withPath(route('api.profile.following', $user->username));

            return response()->json([
                'status'  => true,
                'following' => $following
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status'  => false,
                'message' => $e->getMessage()
            ], $e->getCode() ?? 400);
        }
    }

    /**
     * Get Profile Followers users list
     *
     * @param  string $username
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function followers(string $username)
    {
        try {
            $user = (new UserResource())->findByUsername($username);
            if (!$user) {
                throw new \Exception('Perfil não encontrado.', 404);
            }

            $page = request()->page ?: 1;

            $following = (new UserFollowResource())->usersFollowers($user, true, 10, $page);
            $following->withPath(route('api.profile.followers', $user->username));

            return response()->json([
                'status'  => true,
                'following' => $following
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status'  => false,
                'message' => $e->getMessage()
            ], $e->getCode() ?? 400);
        }
    }

    /**
     * Get Profile Publications by Type
     *
     * @param  string $username
     * @param  string $type
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function publicationsByType(string $username, string $type)
    {
        try {
            $user = (new UserResource())->findByUsername($username);
            if (!$user) {
                throw new \Exception('Perfil não encontrado.', 404);
            }

            return response()->json([
                'status'  => true,
                'publications' => (new PublicationResource())->publicationsFromUserByType($user, 10, $type)
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status'  => false,
                'message' => $e->getMessage()
            ], $e->getCode() ?? 400);
        }
    }

    /**
     * Follow new user
     *
     * @param  string $username
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function follow($username)
    {
        try {
            if((new UserFollowResource())->followUser(auth()->user(), $username)){
                return response()->json([
                    'status'  => true,
                    'message' => 'Você começou a seguir '.$username
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'status'  => false,
                'message' => $e->getMessage()
            ], $e->getCode() ?: 400);
        }
    }

    /**
     * Follow new user
     *
     * @param  string $username
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function unfollow($username)
    {
        try {
            if((new UserFollowResource())->unfollowUser(auth()->user(), $username)){
                return response()->json([
                    'status'  => true,
                    'message' => 'Você deixou de seguir '.$username
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'status'  => false,
                'message' => $e->getMessage()
            ], $e->getCode() ?: 400);
        }
    }
}
