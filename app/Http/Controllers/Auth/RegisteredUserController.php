<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class RegisteredUserController extends Controller
{
    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(RegisterRequest $request)
    {
        $username = $request->username;
        if (!str_starts_with($username, '@')) {
            $username = '@' . $username;
        }

        // Handle avatar upload
        $avatarUrl = null;
        if ($request->hasFile('avatar')) {
            try {
                $cloudinaryImage = $request->file('avatar')->storeOnCloudinary('avatars');
                $avatarUrl = $cloudinaryImage->getSecurePath();
            } catch (\Exception $e) {
                \Log::error('Avatar upload failed: ' . $e->getMessage());
            }
        }

        $user = User::create([
            'username' => $username,
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'avatar' => $avatarUrl,
            'role' => $request->role ?? 'user',
        ]);

        event(new Registered($user));

        $token = $user->createToken('auth_token')->plainTextToken;

        $data = [
            'user' => new UserResource($user),
            'access_token' => [
                'token' => $token,
                'type' => 'Bearer',
            ],
        ];

        return response_success('Registrasi User Berhasil', $data, Response::HTTP_CREATED);
    }
}
