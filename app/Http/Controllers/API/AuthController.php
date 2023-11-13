<?php

namespace App\Http\Controllers\API;

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
         'name' => ['required'],
         'email' => ['required', 'email', 'unique:users'],
         'password' => ['required']
       ]);

       $user = User::create([
          'name' => $request->name,
          'email' => $request->email,
          'password' => Hash::make($request->password)
       ]);

       $token = $user->createToken('authToken')->plainTextToken;

       return response()->json([
          'message' => 'Registration Successful',
          'token' => $token,
          'user' => $user,
       ], 200);
   }

   public function login(Request $request) {
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);

        $user = User::where('email', $request->email)->firstOrFail();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'message' => 'Invalid Credentials',

            ], 401);
        }

        $token = $user->createToken('authToken')->plainTextToken;

        return response()->json([
           'message' => 'Login Successful',
           'token' => $token,
           'user' => $user,
        ], 200);
   }

}
