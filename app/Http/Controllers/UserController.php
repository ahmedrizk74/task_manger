<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\StoreUserRequest;
use App\Mail\WelcomeMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Laravel\Sanctum\HasApiTokens;

class UserController extends Controller
{
    //
  public function register(StoreUserRequest $request)
{
    $user = User::create($request->validated());

    Mail::to($user->email)->send(new WelcomeMail($user));

    return response()->json([
        'message' => 'User registered successfully',
        'user' => $user
    ], 201);
}
  public function login(LoginRequest $request)
{
    $data = $request->validated();

    // نحاول تسجيل الدخول
    if (!Auth::attempt(['email' => $data['email'], 'password' => $data['password']])) {
        return response()->json(['message' => 'Invalid credentials'], 401);
    }

    // لو نجح تسجيل الدخول، نجيب المستخدم الحالي
    $user = Auth::user();

    // نعمل توكن للمستخدم
    $token = $user->createToken('auth_token')->plainTextToken;

    return response()->json([
        'message' => 'Login successful',
        'user' => $user,
        'token' => $token,
    ], 200);

}
public function logout(Request $request)
{
    // حذف التوكن الحالي فقط
    $request->user()->currentAccessToken()->delete();

    return response()->json([
        'message' => 'Logged out successfully'
    ], 200);
}

}
