<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminChallengeController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\ChallengeController;
use App\Http\Controllers\LeaderboardController;
use App\Http\Controllers\SubmissionController;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/register', [RegisteredUserController::class, 'store']);
Route::post('/login', [AuthenticatedSessionController::class, 'store']);
Route::post('/forgot-password', [PasswordResetLinkController::class, 'store']);
Route::post('/reset-password', [NewPasswordController::class, 'store']);
Route::middleware('optional.auth')->group(function () {
    Route::get('challenges', [ChallengeController::class, 'index']);
});
Route::get('/leaderboard', [LeaderboardController::class, 'getOverallLeaderboard']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/challenges/{slug}/verify-access', [ChallengeController::class, 'verifyAccessCode']);
    Route::get('/challenges/{slug}', [ChallengeController::class, 'show']);
    Route::post('/submissions', [SubmissionController::class, 'store']);
    Route::get('/challenges/{slug}/submissions', [SubmissionController::class, 'getUserSubmissions']);
    Route::get('/submissions/{id}', [SubmissionController::class, 'getSubmissionDetail']);
    Route::get('/challenges/{slug}/leaderboard', [LeaderboardController::class, 'getChallengeLeaderboard']);
    Route::get('/user/profile', [UserController::class, 'getProfile']);
    Route::post('/user/profile/update', [UserController::class, 'updateProfile']);
    Route::get('/classes', [ClassController::class, 'index'])->name('classes.index');
});

Route::middleware(['auth:sanctum', 'admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'getStats']);
    Route::get('/users', [AdminController::class, 'getUsers']);
    Route::prefix('challenges')->group(function () {
    Route::get('/', [AdminChallengeController::class, 'index']);
    Route::post('/', [AdminChallengeController::class, 'store']);
    Route::get('/{slug}', [AdminChallengeController::class, 'show']);
    Route::put('/{slug}', [AdminChallengeController::class, 'update']);
    Route::delete('/{slug}', [AdminChallengeController::class, 'destroy']);
});
});

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});