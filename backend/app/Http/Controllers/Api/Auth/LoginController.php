<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function __invoke(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:5',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Invalid field',
                'errors' => $validator->errors(),
            ], 422);
        }

        $data = $request->only('email', 'password');

        // login failed
        if (!auth()->attempt($data)) {
            return response()->json([
                'message' => 'Email or password incorrect',
            ], 401);
        } 

        $user = auth()->user()->select('id', 'name', 'email')->first();
        $user->accessToken = $user->createToken('auth')->plainTextToken;
        
        // login success
        return response()->json([
            'message' => 'Login success',
            'user' => $user,
        ]);
    }
}
