<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;


class UserController extends Controller
{
   public function register(Request $request) {
       $request->validate([
          'name' => ['required', 'string'],
          'email' => ['required', 'email', 'string', 'unique:users,email'],
          'password' => ['required', Rules\Password::min('8')]
       ]);

       $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
       ]);

       $user->save();
       return response()->json(['message' => 'User Has Been Registered Successfully'], 200);
   }

   public function login(Request $request) {
    $request->validate([
        'email' => ['required', 'email'],
        'password' => ['required']
    ]);

    $credentials = request(['email', 'password']);

    if (!Auth::check($credentials)) {
        return response()->json(['message' => 'Unauthorized'], 401);
    }

    $user = Auth::user();
    $tokenResult = $user->createToken('Personal Access Token');
    $token = $tokenResult->token;
    $token->expires_at = Carbon::now()->addWeeks(1);
    $token->save();

    return response()->json([
        'data' => [
            'user' => $user,
            'access_token' => $tokenResult->accessToken,
            'token_type' => 'Bearer',
            'expires_at' => Carbon::parse($token->expires_at)->toDateTimeString()
        ]
    ]);
}


}

// L10tpubiDzM8edSxFY2VvgicZyKPTAKUYdD8CeIu
