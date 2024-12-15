<?php

namespace App\Http\Controllers;

use App\Http\Resources\ChallengeDetailResource;
use App\Http\Resources\ChallengeListResource;
use App\Models\Challenge;
use App\Models\UserChallengeAccess;
use Illuminate\Http\Request;

class ChallengeController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->guard('sanctum')->user(); // Bisa null untuk user yang belum login

        $query = Challenge::query()->when($user, function ($query) use ($user) {
            return $query->with([
                'userAccesses' => function ($q) use ($user) {
                    $q->where('user_id', $user->id);
                },
            ]);
        });

        // Search by title or description
        if ($request->has('search')) {
            $searchTerm = $request->search;
            $query->where(function ($q) use ($searchTerm) {
                $q->where('title', 'like', "%{$searchTerm}%")->orWhere('description', 'like', "%{$searchTerm}%");
            });
        }

        // Filter by difficulty
        if ($request->has('difficulty')) {
            $query->where('difficulty', $request->difficulty);
        }

        // Filter by category
        if ($request->has('category')) {
            $query->where('category', $request->category);
        }

        $challenges = $query->paginate(12);

        // Transform challenges untuk menentukan accessibility
        $challenges->getCollection()->transform(function ($challenge) use ($user) {
            return $challenge->setCurrentUser($user);
        });

        return response_success('Challenges retrieved successfully', [
            'challenges' => ChallengeListResource::collection($challenges),
            'pagination' => [
                'total' => $challenges->total(),
                'per_page' => $challenges->perPage(),
                'current_page' => $challenges->currentPage(),
                'last_page' => $challenges->lastPage(),
                'from' => $challenges->firstItem(),
                'to' => $challenges->lastItem(),
                'next_page_url' => $challenges->nextPageUrl(),
                'prev_page_url' => $challenges->previousPageUrl(),
            ],
        ]);
    }

    public function show($slug)
    {
        $challenge = Challenge::with('testCases')->where('slug', $slug)->firstOrFail();
        $user = auth()->user();

        // Cek akses sebelum menampilkan detail tantangan
        if (!$challenge->isAccessibleBy($user)) {
            return response_failed('You do not have access to this challenge', [], 403);
        }

        return response_success('Challenge details retrieved successfully', new ChallengeDetailResource($challenge));
    }

    public function verifyAccessCode(Request $request, $slug)
    {
        // Pastikan user sudah login untuk verifikasi kode
        if (!auth()->user()) {
            return response_failed('You must be logged in to verify access code', [], 401);
        }

        $challenge = Challenge::where('slug', $slug)->firstOrFail();

        $request->validate([
            'access_code' => 'required|string',
        ]);

        if ($challenge->access_type !== 'private') {
            return response_failed('Challenge does not require access code', [], 400);
        }

        if ($challenge->access_code === $request->access_code) {
            UserChallengeAccess::updateOrCreate(
                [
                    'user_id' => auth()->id(),
                    'challenge_id' => $challenge->id,
                ],
                [
                    'granted_at' => now(),
                ],
            );

            return response_success('Access granted to challenge');
        }

        return response_failed('Invalid access code', [], 403);
    }
}
