<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateProfileRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Models\Submission;
use App\Http\Resources\UserProfileResource;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function getProfile()
    {
        $user = User::findOrFail(auth()->id());

        $challengeStats = Submission::where('user_id', $user->id)
            ->select('challenge_id', 'status')
            ->groupBy('challenge_id', 'status')
            ->get();

        $totalChallenges = $challengeStats->unique('challenge_id')->count();
        $completedChallenges = $challengeStats->where('status', 'accepted')->unique('challenge_id')->count();

        $challengeHistory = DB::table('submissions as s1')
            ->join(DB::raw('(SELECT challenge_id, MAX(score) as max_score FROM submissions WHERE user_id = ' . $user->id . ' GROUP BY challenge_id) as s2'), function ($join) {
                $join->on('s1.challenge_id', '=', 's2.challenge_id')->on('s1.score', '=', 's2.max_score');
            })
            ->where('s1.user_id', $user->id)
            ->select('s1.challenge_id', 's1.status', 's1.score', DB::raw('MIN(s1.submitted_at) as submitted_at'))
            ->groupBy('s1.challenge_id', 's1.status', 's1.score')
            ->orderBy('s1.score', 'desc')
            ->orderBy('submitted_at', 'asc')
            ->get();

        $challengeIds = $challengeHistory->pluck('challenge_id')->toArray();

        $challenges = DB::table('challenges')->whereIn('id', $challengeIds)->select('id', 'title', 'difficulty')->get()->keyBy('id');

        $totalScore = 0;
        $challengeHistory = $challengeHistory->map(function ($submission) use ($challenges, &$totalScore) {
            $challenge = $challenges[$submission->challenge_id] ?? null;
            $totalScore += $submission->score;
            return [
                'challenge_id' => $submission->challenge_id,
                'title' => $challenge ? $challenge->title : 'Unknown',
                'difficulty' => $challenge ? $challenge->difficulty : 'Unknown',
                'best_score' => $submission->score,
                'status' => $submission->status,
                'completed_at' => $submission->submitted_at,
            ];
        });

        $userData = [
            'user' => $user,
            'total_challenges' => $totalChallenges,
            'completed_challenges' => $completedChallenges,
            'total_score' => $totalScore,
            'challenge_history' => $challengeHistory,
        ];

        return response_success('User profile retrieved successfully', new UserProfileResource($userData));
    }

    public function updateProfile(UpdateProfileRequest $request)
    {
        try {
            $user = User::findOrFail(auth()->id());
            $updated = false;

            // Handle name update
            if ($request->has('name')) {
                $user->name = $request->input('name');
                $updated = true;
            }

            // Handle avatar upload
            if ($request->hasFile('avatar')) {
                $uploadedFile = $request->file('avatar');
                
                if ($uploadedFile->isValid()) {
                    // Delete old avatar if exists
                    if ($user->avatar) {
                        try {
                            $oldAvatarPath = parse_url($user->avatar, PHP_URL_PATH);
                            if ($oldAvatarPath) {
                                $pathParts = explode('/', $oldAvatarPath);
                                $publicId = end($pathParts);
                                $publicId = pathinfo($publicId, PATHINFO_FILENAME);
                                Cloudinary::destroy('avatars/' . $publicId);
                            }
                        } catch (\Exception $e) {
                            Log::warning('Failed to delete old avatar: ' . $e->getMessage());
                        }
                    }

                    // Upload new avatar
                    try {
                        $result = Cloudinary::upload($uploadedFile->getRealPath(), [
                            'folder' => 'avatars'
                        ]);
                        $user->avatar = $result->getSecurePath();
                        $updated = true;
                        
                    } catch (\Exception $e) {
                        return response_failed('Failed to upload avatar', null, Response::HTTP_INTERNAL_SERVER_ERROR);
                    }
                } else {
                    return response_failed('Invalid avatar file', null, Response::HTTP_BAD_REQUEST);
                }
            }

            if ($updated) {
                $user->save();

                return response_success(
                    'Profile updated successfully',
                    new UserResource($user)
                );
            }

            return response_success(
                'No changes made',
                new UserResource($user)
            );

        } catch (\Exception $e) {
            return response_failed(
                'Profile update failed',
                null,
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }
}
