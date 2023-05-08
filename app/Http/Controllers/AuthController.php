<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends ApiController
{
    public function index(Request $request): JsonResponse
    {
        return $this->respondSuccess('Success', ['user'=> new UserResource(request()->user())]);
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
