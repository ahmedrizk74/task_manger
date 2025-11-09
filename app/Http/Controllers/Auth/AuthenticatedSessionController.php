<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class AuthenticatedSessionController extends Controller
{
    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request)
    {
    $data = $request->validated();

    if (!Auth::attempt(credentials: ['email' => $data['email'], 'password' => $data['password']])) {
         return response()->json(['message' => 'Invalid credentials'], 401);
    }
             $user=Auth::user();
             $token=$user->createToken('auth_token')->plainTextToken;
              return response()->json([
                'message' => 'Login successful',
                'user'=>$user,
            'token'=>$token], 401);
    }

    
    public function destroy(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
          return response()->json([
        'message' => 'Logged out successfully'
    ], 200);

    }
}
