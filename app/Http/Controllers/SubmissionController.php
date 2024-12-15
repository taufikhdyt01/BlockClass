<?php

namespace App\Http\Controllers;

use App\Http\Requests\SubmissionRequest;
use App\Models\Challenge;
use App\Models\Leaderboard;
use App\Models\Submission;
use App\Models\TestResult;
use App\Http\Resources\SubmissionDetailResource;
use App\Http\Resources\SubmissionListResource;
use Illuminate\Support\Facades\DB;

class SubmissionController extends Controller
{
    public function store(SubmissionRequest $request)
    {
        DB::beginTransaction();
        try {
            $submission = Submission::create([
                'user_id' => auth()->id(),
                'challenge_id' => $request->challenge_id,
                'xml' => $request->xml,
                'status' => $request->status,
                'score' => $request->score,
                'time_spent' => $request->time_spent,
                'submitted_at' => now(),
            ]);

            foreach ($request->test_results as $testResult) {
                TestResult::create([
                    'submission_id' => $submission->id,
                    'test_case_id' => $testResult['test_case_id'],
                    'passed' => $testResult['passed'],
                    'output' => $testResult['output'],
                    'console_output' => $testResult['console_output'],
                ]);
            }

            // Leaderboard logic
            $this->updateLeaderboard($submission);

            DB::commit();

            $submission->load('testResults');

            return response_success(
                'Submission saved successfully',
                new SubmissionDetailResource($submission)
            );
        } catch (\Exception $e) {
            DB::rollBack();
            return response_failed('Failed to save submission: ' . $e->getMessage());
        }
    }

    public function getUserSubmissions($slug)
    {
        $challenge = Challenge::where('slug', $slug)->firstOrFail();
        $submissions = Submission::where('user_id', auth()->id())
            ->where('challenge_id', $challenge->id)
            ->orderBy('submitted_at', 'desc')
            ->get();

        return response_success(
            'User submissions retrieved successfully',
            SubmissionListResource::collection($submissions)
        );
    }

    public function getSubmissionDetail($id)
    {
        $submission = Submission::with(['testResults', 'challenge'])
            ->findOrFail($id);

        return response_success(
            'Submission detail retrieved successfully',
            new SubmissionDetailResource($submission)
        );
    }

    private function updateLeaderboard(Submission $submission)
    {
        $existingLeaderboardEntry = Leaderboard::where('user_id', $submission->user_id)
            ->where('challenge_id', $submission->challenge_id)
            ->first();

        if (!$existingLeaderboardEntry) {
            // Jika belum ada entry, langsung tambahkan
            Leaderboard::create([
                'user_id' => $submission->user_id,
                'challenge_id' => $submission->challenge_id,
                'score' => $submission->score,
                'time_spent' => $submission->time_spent,
                'submission_time' => $submission->submitted_at,
            ]);
        } else {
            // Jika sudah ada entry, lakukan pengecekan
            if ($submission->score > $existingLeaderboardEntry->score) {
                // Jika skor baru lebih tinggi, update entry
                $existingLeaderboardEntry->update([
                    'score' => $submission->score,
                    'submission_time' => $submission->submitted_at,
                ]);
            } elseif ($submission->score == $existingLeaderboardEntry->score &&
                      $submission->submitted_at < $existingLeaderboardEntry->submission_time) {
                // Jika skor sama dan waktu submission lebih awal, update entry
                $existingLeaderboardEntry->update([
                    'submission_time' => $submission->submitted_at,
                ]);
            }
            // Jika skor lebih rendah atau sama dengan waktu yang lebih baru, tidak perlu diupdate
        }
    }
}
