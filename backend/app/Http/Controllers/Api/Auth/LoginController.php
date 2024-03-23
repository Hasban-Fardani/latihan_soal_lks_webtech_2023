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

        // dd($request->input('email'));

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
        if (!auth()->attempt($data)) {
            return response()->json([
                'message' => 'Email or password incorrect',
            ], 401);
        } 

        $user = auth()->user();

        return response()->json([
            'messsage' => 'Login success',
            'user' => [
                'name' => $user->name,
                'email' => $user->email,
                'accessToken' => $user->createToken('auth')->plainTextToken
            ]
        ]);
    }
}
