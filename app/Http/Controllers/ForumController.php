<?php

namespace App\Http\Controllers;

use App\Models\Forum;
use App\Http\Resources\ForumResource;
use Illuminate\Http\Response;

class ForumController extends Controller
{
    public function show($id)
    {
        try {
            $forum = Forum::with([
                'posts' => function ($query) {
                    $query->orderBy('created_at', 'desc');
                },
                'posts.user',
                'posts.comments' => function ($query) {
                    $query->orderBy('created_at', 'asc');
                },
                'posts.comments.user'
            ])->findOrFail($id);

            $forumResource = new ForumResource($forum);

            return response_success(
                message: 'Forum berhasil ditemukan',
                data: $forumResource,
                status: Response::HTTP_OK
            );

        } catch (\Exception $e) {
            return response_failed(
                message: 'Forum tidak ditemukan',
                status: Response::HTTP_NOT_FOUND
            );
        }
    }
}