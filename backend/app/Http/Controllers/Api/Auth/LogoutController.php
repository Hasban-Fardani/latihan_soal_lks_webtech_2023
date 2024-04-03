<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LogoutController extends Controller
{
    public function __invoke(Request $request)
    {
        if (!auth('sanctum')->check()) {
            return response()->json([
                'message' => 'Unauthenticated.'
            ])->setStatusCode(401);
        }

        auth('sanctum')->user()->tokens()->delete();

        return response()->json([
            'message' => 'Logout success'
        ], 200);   
    }
}
