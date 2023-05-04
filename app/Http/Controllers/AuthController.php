<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class AuthController extends ApiController
{
    /**
     * @param RegisterRequest $request
     * @return JsonResponse
     */
    public function register(RegisterRequest $request): JsonResponse
    {
        $data = $request->validated();

        $user = User::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'password' => $data['password'],
            'role_id' => $data['role_id'],
        ]);

        $token = $user->createToken('authToken')->plainTextToken;

        $response = [
            'token' => $token,
            'user' => new UserResource($user)
        ];

        return $this->respondCreated('User Created',$response);
    }

    public function login(LoginRequest $request): JsonResponse
    {
        if(!Auth::attempt($request->only(['email', 'password']))){
            return response()->json([
                'message' => 'Email & Password does not match with our record.',
            ], 401);
        }

        $user = User::query()->where('email', $request->email)->with('role')->first();

        return response()->json([
            'result' => [
                'message' => 'User Logged In Successfully',
                'token' => $user->createToken("authToken")->plainTextToken,
                'user' => new UserResource($user)
            ]
        ]);
    }
}
