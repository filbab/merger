<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\AuthService;
use Symfony\Component\HttpFoundation\JsonResponse;

class AuthController extends Controller
{
    public function __construct(
        private AuthService $authService
    ) {}

    public function login(Request $request): JsonResponse
    {
        $request->validate([
            'login' => 'required|string',
            'password' => 'required|string',
        ]);

        try {
            $token = $this->authService->login($request->login, $request->password);
            return response()->json([
                'status' => 'success',
                'token' => $token,
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => 'failure'], 401);
        }
    }
}
