<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\User;
use App\Models\Challenge;
use App\Models\Submission;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function getStats()
    {
        // Hitung total users
        $totalUsers = User::count();
        $newUsersThisWeek = User::where('created_at', '>=', Carbon::now()->subWeek())->count();

        // Hitung total challenges
        $totalChallenges = Challenge::count();
        $newChallenges = Challenge::where('created_at', '>=', Carbon::now()->subWeek())->count();

        // Hitung total submissions yang berhasil (accepted)
        $totalAcceptedSubmissions = Submission::where('status', 'accepted')->count();
        $weeklyAcceptedSubmissions = Submission::where('status', 'accepted')
            ->where('submitted_at', '>=', Carbon::now()->subWeek())
            ->count();

        // Hitung completion rate
        $totalSubmissions = Submission::count();
        $completionRate = $totalSubmissions > 0 
            ? round(($totalAcceptedSubmissions / $totalSubmissions) * 100) 
            : 0;
        
        // Hitung completion rate minggu lalu untuk perbandingan
        $lastWeekSubmissions = Submission::where('submitted_at', '>=', Carbon::now()->subWeeks(2))
            ->where('submitted_at', '<', Carbon::now()->subWeek())
            ->count();
        $lastWeekAccepted = Submission::where('status', 'accepted')
            ->where('submitted_at', '>=', Carbon::now()->subWeeks(2))
            ->where('submitted_at', '<', Carbon::now()->subWeek())
            ->count();
        $lastWeekRate = $lastWeekSubmissions > 0 
            ? round(($lastWeekAccepted / $lastWeekSubmissions) * 100) 
            : 0;
        $rateChange = $completionRate - $lastWeekRate;

        // Get recent activities
        $recentActivities = $this->getRecentActivities();

        // Get recent submissions
        $recentSubmissions = $this->getRecentSubmissions();

        return response_success('Dashboard data retrieved successfully', [
            'stats' => [
                'total_users' => [
                    'value' => $totalUsers,
                    'change' => $newUsersThisWeek . ' user baru minggu ini'
                ],
                'total_challenges' => [
                    'value' => $totalChallenges,
                    'change' => $newChallenges . ' tantangan baru'
                ],
                'completed_challenges' => [
                    'value' => $totalAcceptedSubmissions,
                    'change' => 'Minggu ini: ' . $weeklyAcceptedSubmissions
                ],
                'completion_rate' => [
                    'value' => $completionRate . '%',
                    'change' => ($rateChange >= 0 ? 'Naik ' : 'Turun ') . abs($rateChange) . '% dari minggu lalu'
                ]
            ],
            'recent_activities' => $recentActivities,
            'recent_submissions' => $recentSubmissions
        ]);
    }

    private function getRecentActivities()
    {
        // Gabungkan aktivitas dari berbagai sumber dan urutkan berdasarkan waktu
        $registrations = User::select(
            'username as user',
            DB::raw("'Mendaftar' as action"),
            DB::raw("'sebagai user baru' as target"),
            'created_at as timestamp'
        )->latest()->limit(5);

        $submissions = Submission::select(
            'users.username as user',
            DB::raw("CASE WHEN status = 'accepted' THEN 'Menyelesaikan' ELSE 'Mencoba' END as action"),
            'challenges.title as target',
            'submitted_at as timestamp'
        )
        ->join('users', 'submissions.user_id', '=', 'users.id')
        ->join('challenges', 'submissions.challenge_id', '=', 'challenges.id')
        ->latest('submitted_at')
        ->limit(5);

        $activities = $registrations->union($submissions)
            ->orderBy('timestamp', 'desc')
            ->limit(10)
            ->get()
            ->map(function ($activity) {
                return [
                    'user' => $activity->user,
                    'action' => $activity->action,
                    'target' => $activity->target,
                    'timestamp' => Carbon::parse($activity->timestamp)->diffForHumans()
                ];
            });

        return $activities;
    }

    private function getRecentSubmissions()
    {
        return Submission::select(
            'submissions.id',
            'users.username as user',
            'challenges.title as challenge',
            'submissions.status',
            'submissions.score',
            'submissions.submitted_at'
        )
        ->join('users', 'submissions.user_id', '=', 'users.id')
        ->join('challenges', 'submissions.challenge_id', '=', 'challenges.id')
        ->latest('submitted_at')
        ->limit(10)
        ->get()
        ->map(function ($submission) {
            return [
                'user' => $submission->user,
                'challenge' => $submission->challenge,
                'status' => $submission->status,
                'score' => $submission->score,
            ];
        });
    }

    public function getUsers()
    {
        $users = User::all();

        return response_success(
            'Users retrieved successfully',
            UserResource::collection($users)
        );
    }
}
