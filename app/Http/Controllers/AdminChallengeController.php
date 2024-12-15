<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreChallengeRequest;
use App\Http\Requests\UpdateChallengeRequest;
use App\Http\Resources\ChallengeResource;
use App\Http\Helpers\SlugGenerator;
use App\Models\Challenge;
use App\Models\TestCase;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Response;

class AdminChallengeController extends Controller
{
    public function index()
    {
        $challenges = Challenge::with('testCases')->get();
        return response_success(
            message: 'Challenges retrieved successfully',
            data: ChallengeResource::collection($challenges)
        );
    }

    public function store(StoreChallengeRequest $request)
    {
        try {
            DB::beginTransaction();

            $challenge = Challenge::create([
                'title' => $request->title,
                'slug' => SlugGenerator::generateUniqueSlug($request->title, Challenge::class),
                'description' => $request->description,
                'difficulty' => $request->difficulty,
                'category' => $request->category,
                'access_type' => $request->access_type,
                'access_code' => $request->access_code,
                'required_challenge_id' => $request->required_challenge_id,
                'function_name' => $request->function_name,
                'initial_xml' => $request->initial_xml,
                'hints' => $request->hints,
                'constraints' => $request->constraints
            ]);

            foreach ($request->test_cases as $testCase) {
                TestCase::create([
                    'challenge_id' => $challenge->id,
                    'input' => $testCase['input'],
                    'expected_output' => $testCase['expected_output'],
                    'is_sample' => $testCase['is_sample']
                ]);
            }

            DB::commit();
            
            return response_success(
                message: 'Challenge created successfully',
                data: new ChallengeResource($challenge->load('testCases')),
                status: Response::HTTP_CREATED
            );

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Failed to create challenge', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'request' => $request->all()
            ]);

            $errorMessage = config('app.debug') 
                ? 'Failed to create challenge: ' . $e->getMessage()
                : 'Failed to create challenge. Please check the data and try again.';

            return response_failed(
                message: $errorMessage,
                data: config('app.debug') ? [
                    'error' => $e->getMessage(),
                    'file' => $e->getFile(),
                    'line' => $e->getLine(),
                ] : [],
                status: Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }

    public function show($slug)
    {
        $challenge = Challenge::where('slug', $slug)
            ->with('testCases')
            ->firstOrFail();
            
        return response_success(
            message: 'Challenge retrieved successfully',
            data: new ChallengeResource($challenge)
        );
    }

    public function update(UpdateChallengeRequest $request, $slug)
    {
        $challenge = Challenge::where('slug', $slug)->firstOrFail();

        try {
            DB::beginTransaction();

            $updateData = $request->validated();
            if (isset($updateData['title'])) {
                $updateData['slug'] = SlugGenerator::generateUniqueSlug($updateData['title'], Challenge::class);
            }

            $challenge->update($updateData);

            if (isset($updateData['test_cases'])) {
                $challenge->testCases()->delete();
                
                foreach ($updateData['test_cases'] as $testCase) {
                    TestCase::create([
                        'challenge_id' => $challenge->id,
                        'input' => $testCase['input'],
                        'expected_output' => $testCase['expected_output'],
                        'is_sample' => $testCase['is_sample']
                    ]);
                }
            }

            DB::commit();
            
            return response_success(
                message: 'Challenge updated successfully',
                data: new ChallengeResource($challenge->fresh()->load('testCases'))
            );

        } catch (\Exception $e) {
            DB::rollBack();
            return response_failed(
                message: 'Failed to update challenge',
                status: Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }

    public function destroy($slug)
    {
        $challenge = Challenge::where('slug', $slug)->firstOrFail();

        try {
            DB::beginTransaction();
            $challenge->delete();
            DB::commit();
            
            return response_success(
                message: 'Challenge deleted successfully',
                status: Response::HTTP_OK
            );

        } catch (\Exception $e) {
            DB::rollBack();
            return response_failed(
                message: 'Failed to delete challenge',
                status: Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }
}