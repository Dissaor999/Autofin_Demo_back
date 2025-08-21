<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Validator;
use App\Models\User;
use \stdClass;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validate = Validator::make($request->all(),[
            'name' => 'required|string|max:100',
            'email' => 'required|string|max:255',
            'password' => 'required|string|min:4'
        ]);
        if ($validate->fails()) {
            return response()->json($validate->errors());
        }
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);
        
        $token = $user->createToken('auth_token')->plainTextToken;
        return response()->json([
            'data' => $user,
            'accesToken' => $token,
            'type' => 'Bearer',
        ]);
    }

    public function login(Request $request)
    {
        if (!Auth::attempt($request->only('email','password'))) 
        {
            return response()->json(
                [
                    'message' => 'Unnauthorized'
                ],
                401
            );
        }
        $user = User::where('email', $request['email'])->firstOrFail();
        $token = $user->createToken('auth_token')->plainTextToken;
        return response()->json([
            'message' => 'Hi '.$user->name,
            'access_token' => $token,
            'token_type' => 'Bearer',
            'user' => $user,
        ]);
    }
    
    public function logout()
    {
        auth()->user()->tokens()->delete();
        return [
            'menssage' => 'Se desconecto Correctamente'
        ];
    }

    
}
