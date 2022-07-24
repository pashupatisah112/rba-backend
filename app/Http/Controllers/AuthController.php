<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function user()
    {
        $user = User::where('id', Auth::id())->with('role:id,role')->first();
        return response()->json($user);
    }
    public function login(Request $request)
    {
        $attr = $request->only('email', 'password');
        if (Auth::attempt($attr)) {
            $user = Auth::user();
            $token = $user->createToken('user-token')->plainTextToken;
            $res = User::where('id', Auth::id())->with('role:id,role')->first();
            $res['token'] = $token;
            return response($res, 201);
        } else {
            return response()->json(['status' => 'failed', 'msg' => 'Credentials did not match.']);
        }
    }
    public function logout()
    {
        Auth::user()->tokens()->delete();
    }
}
