<?php

namespace App\Http\Controllers;

use App\Http\Resources\LeaderboardOverallResource;
use App\Models\Challenge;
use App\Models\Leaderboard;
use App\Http\Resources\LeaderboardChallengeResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LeaderboardController extends Controller
{
    public function getChallengeLeaderboard(Request $request, $slug)
    {
        $challenge = Challenge::where('slug', $slug)->firstOrFail();
        $leaderboard = Leaderboard::where('challenge_id', $challenge->id)
            ->with('user')
            ->orderBy('score', 'desc')
            ->orderBy('time_spent', 'asc')
            ->orderBy('submission_time', 'asc')
            ->paginate(15);

        return response_success(
            'Challenge leaderboard retrieved successfully',
            [
                'leaderboard' => LeaderboardChallengeResource::collection($leaderboard),
                'pagination' => [
                    'total' => $leaderboard->total(),
                    'per_page' => $leaderboard->perPage(),
                    'current_page' => $leaderboard->currentPage(),
                    'last_page' => $leaderboard->lastPage(),
                    'from' => $leaderboard->firstItem(),
                    'to' => $leaderboard->lastItem(),
                    'next_page_url' => $leaderboard->nextPageUrl(),
                    'prev_page_url' => $leaderboard->previousPageUrl(),
                ]
            ]
        );
    }

    public function getOverallLeaderboard(Request $request)
    {
        $overallLeaderboard = User::select('users.id', 'users.username', 'users.name')
            ->addSelect(DB::raw('COALESCE(SUM(leaderboards.score), 0) as total_score'))
            ->addSelect(DB::raw('COUNT(DISTINCT leaderboards.challenge_id) as completed_challenges'))
            ->addSelect(DB::raw('MAX(leaderboards.submission_time) as last_submission_time'))
            ->join('leaderboards', 'users.id', '=', 'leaderboards.user_id')
            ->groupBy('users.id', 'users.username', 'users.name')
            ->having('total_score', '>', 0)
            ->orderBy('total_score', 'desc')
            ->orderBy('completed_challenges', 'desc')
            ->orderBy('last_submission_time', 'asc')
            ->paginate(15);

        return response_success(
            'Overall leaderboard retrieved successfully',
            [
                'leaderboard' => LeaderboardOverallResource::collection($overallLeaderboard),
                'pagination' => [
                    'total' => $overallLeaderboard->total(),
                    'per_page' => $overallLeaderboard->perPage(),
                    'current_page' => $overallLeaderboard->currentPage(),
                    'last_page' => $overallLeaderboard->lastPage(),
                    'from' => $overallLeaderboard->firstItem(),
                    'to' => $overallLeaderboard->lastItem(),
                    'next_page_url' => $overallLeaderboard->nextPageUrl(),
                    'prev_page_url' => $overallLeaderboard->previousPageUrl(),
                ]
            ]
        );
    }
}