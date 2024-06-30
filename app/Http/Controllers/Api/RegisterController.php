<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\StoreUserRequest;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function register(StoreUserRequest $request): JsonResponse
    {
        $data = $request->validated();

        $user = $this->userService->store($data);

        return response()->json([
            'message' => 'Usuário registrado com sucesso!',
            'user' => $user,
        ], 201);
    }

    public function login(LoginRequest $request): JsonResponse
    {
        $credentials = $request->validated();

        if (!Auth::attempt($credentials)) {
            return response()->json(['message' => 'Credenciais inválidas.'], 401);
        }

        $user = Auth::user();
        $token = $user->createToken('API Token')->plainTextToken;

        return response()->json([
            'message' => 'Login realizado com sucesso!',
            'token' => $token,
            'user' => $user,
        ]);
    }

    public function logout(): JsonResponse
    {
        $user = Auth::user();
        $user->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Logout realizado com sucesso!',
        ]);
    }
}
