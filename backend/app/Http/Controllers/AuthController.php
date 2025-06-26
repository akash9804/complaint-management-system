<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (!$token = auth()->attempt($credentials))
        {
            return response()->json(['error' => 'Unauthorised'], 401);
        }

        return $this->responseWithToken($token);
    }

    public function refresh(Request $request)
    {
        try {
            $newToken = JWTAuth::parseToken()->refresh();
        } catch (\Tymon\JWTAuth\Exceptions\JWTException $e) {
            return response()->json(['error' => 'Unauthorised'], 401);
        }

        return $this->responseWithToken($newToken);
    }

    public function me(Request $request)
    {
        $user = Auth::user();
        return response()->json($user);

    }

    public function logout(Request $request)
    {
        try {
            JWTAuth::invalidate(JWTAuth::getToken());
        } catch (\Tymon\JWTAuth\Exceptions\JWTException $e) {
            return response()->json(['error' => 'Could not log out'], 500);
        }

        return response()->json(['message' => 'Successfully logged out']);
    }

    protected function responseWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => JWTAuth::factory()->getTTL() * 60, 
            // 'user' => Auth::user()
        ]);

    }
}
