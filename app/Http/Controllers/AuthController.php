<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;


class AuthController extends Controller
{
   public function register(Request $request) {
       $request->validate([
          'name' => ['required', 'string'],
          'email' => ['required', 'email', 'string'],
          'password' => ['required', 'confirmed', Rules\Password::min('8')]
       ]);

       $user = User::create([
            'name' => $request->name,
            'password' => Hash::make($request->password)
       ]);

       $user->save();
       return response()->json(['message' => 'User has been registered Successfully']);
   }

   public function login(Request $request) {
       $request->validate([
            'name' => ['required', 'string'],
            'password' => ['required', 'confirmed', Rules\Password::min('8')]
       ]);

       $credentials = request(['name', 'password']);

       if (!Auth::attempt($credentials)) {
           return response(['message' => 'Unauthorized'], 401);
       }

       $user = $request->user();
       $tokenResult = $user->createToken('Personal Access Token');
       $token = $tokenResult->token;
       $token->expires_at = Carbon::now()->addWeeks(1);
       $token->save();

       return response()->json(['data' => [
           'user' => Auth::user(),
           'access_token' => $tokenResult->accessToken,
           'token_type' => 'Bearer',
           'expires_at' => Carbon::parse($tokenResult->token->expires_at)->toDateTimeString()
       ]]);
   }
}
